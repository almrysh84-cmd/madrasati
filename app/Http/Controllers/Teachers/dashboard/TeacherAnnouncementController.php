<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherAnnouncementController extends Controller
{
    /**
     * عرض قائمة الإعلانات التي أنشأها المعلم + الإعلانات العامة له
     */
    public function index()
    {
        $teacherId = auth()->user()->id;

        // إعلانات المعلم الخاصة + الإعلانات الموجهة له من الإدارة
        $myAnnouncements = Announcement::where('creator_type', 'teacher')
            ->where('created_by', $teacherId)
            ->orderBy('created_at', 'desc')
            ->get();

        $adminAnnouncements = Announcement::with('creator')
            ->published()
            ->forAudience('teachers')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.Teachers.dashboard.announcements.index',
            compact('myAnnouncements', 'adminAnnouncements'));
    }

    /**
     * عرض نموذج إنشاء إعلان جديد
     */
    public function create()
    {
        return view('pages.Teachers.dashboard.announcements.create');
    }

    /**
     * حفظ إعلان جديد من المعلم
     * المعلم يمكنه فقط استهداف: طلابه، أو جميع الطلاب في المدرسة
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
            'target_audience' => 'required|in:students,all',
            'publish_at' => 'nullable|date|after_or_equal:now',
        ], [
            'title.required' => 'العنوان مطلوب',
            'body.required'  => 'نص الإعلان مطلوب',
            'target_audience.required' => 'يرجى تحديد الجمهور المستهدف',
            'target_audience.in' => 'المعلم يمكنه استهداف الطلاب فقط',
        ]);

        try {
            // تحديد حالة النشر: إذا حدد المعلم تاريخ نشر في المستقبل،
            // نتركه غير منشور حتى يحين الوقت. خلاف ذلك نشر فوري.
            $isPublished = true;
            $publishAt = null;
            if ($request->filled('publish_at')) {
                $publishAt = $request->publish_at;
                $isPublished = (strtotime($publishAt) <= time());
            }

            Announcement::create([
                'title'           => $request->title,
                'body'            => $request->body,
                'target_audience' => $request->target_audience,
                'publish_at'      => $publishAt,
                'is_published'    => $isPublished,
                'created_by'      => auth()->user()->id,
                'creator_type'    => 'teacher',
            ]);

            // ===== إرسال إشعار في قاعدة البيانات لكل الطلاب المعنيين =====
            try {
                $this->notifyStudents($request->target_audience, $request->title, $request->body);
            } catch (\Throwable $ne) {
                \Log::warning('Failed to send announcement notification: ' . $ne->getMessage());
            }

            $msg = $isPublished
                ? 'تم نشر الإعلان بنجاح — سيظهر للطلاب فوراً'
                : 'تم حفظ الإعلان — سيُنشر تلقائياً في الوقت المحدد';
            toastr()->success($msg);
            return redirect()->route('teacher.announcements.index');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'حدث خطأ أثناء نشر الإعلان: ' . $e->getMessage()]);
        }
    }

    /**
     * إرسال إشعار لكل الطلاب المعنيين بالإعلان (حسب target_audience)
     */
    private function notifyStudents($targetAudience, $title, $body)
    {
        $teacher = auth()->user();

        if ($targetAudience === 'all') {
            // كل الطلاب في المدرسة
            $students = \App\Models\Student::all();
        } else {
            // فقط طلاب أقسام المعلم
            $sectionIds = $teacher->Sections()->pluck('sections.id');
            $students = \App\Models\Student::whereIn('section_id', $sectionIds)->get();
        }

        foreach ($students as $student) {
            $student->notify(new \App\Notifications\AnnouncementPublishedNotification(
                $title,
                $targetAudience === 'all' ? 'لجميع الطلاب' : 'لطلاب صفك',
                $teacher->getTranslation('name', 'ar')
            ));
        }
    }

    /**
     * حذف إعلان (فقط الإعلانات التي أنشأها المعلم نفسه)
     */
    public function destroy($id)
    {
        $teacherId = auth()->user()->id;
        $announcement = Announcement::where('creator_type', 'teacher')
            ->where('created_by', $teacherId)
            ->findOrFail($id);

        $announcement->delete();
        toastr()->success('تم حذف الإعلان');
        return redirect()->back();
    }
}
