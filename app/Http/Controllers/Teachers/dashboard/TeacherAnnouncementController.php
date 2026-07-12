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
            Announcement::create([
                'title'           => $request->title,
                'body'            => $request->body,
                'target_audience' => $request->target_audience,
                'publish_at'      => $request->publish_at,
                'is_published'    => true,
                'created_by'      => auth()->user()->id,
                'creator_type'    => 'teacher',
            ]);

            toastr()->success('تم نشر الإعلان بنجاح — سيظهر للطلاب فوراً');
            return redirect()->route('teacher.announcements.index');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'حدث خطأ أثناء نشر الإعلان: ' . $e->getMessage()]);
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
