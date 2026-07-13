<?php

namespace App\Http\Controllers\Parents\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Student;
use App\Models\Teacher;
use App\Notifications\NewMessageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessagesController extends Controller
{
    /**
     * عرض قائمة المعلمين الذين يُدرّسون أبناء ولي الأمر
     * (مجمَّعة حسب الطالب + المعلم)
     */
    public function index()
    {
        $parentId = auth()->user()->id;

        // كل أبناء ولي الأمر
        $children = Student::where('parent_id', $parentId)
            ->with(['grade', 'classroom', 'section'])
            ->get();

        // كل المعلمين المرتبطين بأبنائه (عبر subjects أو sections)
        $childIds = $children->pluck('id');
        $childSectionIds = $children->pluck('section_id');

        // المعلمون عبر subjects
        $teacherIdsFromSubjects = DB::table('subjects')
            ->whereIn('subjects.classroom_id', $children->pluck('Classroom_id'))
            ->pluck('teacher_id')
            ->unique();

        // المعلمون عبر sections (teacher_section pivot)
        $teacherIdsFromSections = DB::table('teacher_section')
            ->whereIn('section_id', $childSectionIds)
            ->pluck('teacher_id')
            ->unique();

        $allTeacherIds = $teacherIdsFromSubjects->merge($teacherIdsFromSections)->unique();

        $teachers = Teacher::whereIn('id', $allTeacherIds)->get();

        // عدد الرسائل غير المقروءة من كل معلم
        $unreadCounts = Message::where('receiver_type', 'parent')
            ->where('receiver_id', $parentId)
            ->whereNull('read_at')
            ->select('sender_id', DB::raw('count(*) as cnt'))
            ->groupBy('sender_id')
            ->pluck('cnt', 'sender_id');

        return view('pages.parents.messages.index', compact('children', 'teachers', 'unreadCounts'));
    }

    /**
     * عرض محادثة مع معلم محدد
     */
    public function show(Request $request, $teacherId)
    {
        $parentId = auth()->user()->id;
        $teacher = Teacher::findOrFail($teacherId);

        // تحديد الطالب (اختياري — إذا حدد ولي الأمر ابناً)
        $studentId = $request->get('student_id');
        $student = $studentId ? Student::findOrFail($studentId) : null;

        // جلب كل الرسائل بين ولي الأمر وهذا المعلم
        $messages = Message::where(function ($q) use ($parentId, $teacherId) {
            $q->where('sender_type', 'parent')->where('sender_id', $parentId)
              ->where('receiver_type', 'teacher')->where('receiver_id', $teacherId);
        })->orWhere(function ($q) use ($parentId, $teacherId) {
            $q->where('sender_type', 'teacher')->where('sender_id', $teacherId)
              ->where('receiver_type', 'parent')->where('receiver_id', $parentId);
        })->orderBy('created_at', 'asc')->get();

        // تحديد كل رسائل المعلم المُرسَلة لولي الأمر كمقروءة
        Message::where('sender_type', 'teacher')
            ->where('sender_id', $teacherId)
            ->where('receiver_type', 'parent')
            ->where('receiver_id', $parentId)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        // قائمة أبناء ولي الأمر (لاختيار السياق)
        $children = Student::where('parent_id', $parentId)->get();

        return view('pages.parents.messages.show', compact('teacher', 'messages', 'children', 'student'));
    }

    /**
     * إرسال رسالة لمعلم
     */
    public function store(Request $request, $teacherId)
    {
        $request->validate([
            'body'        => 'required|string|max:2000',
            'student_id'  => 'nullable|exists:students,id',
        ], [
            'body.required' => 'يرجى كتابة نص الرسالة',
        ]);

        $parentId = auth()->user()->id;
        $teacher = Teacher::findOrFail($teacherId);

        $message = Message::create([
            'sender_type'   => 'parent',
            'sender_id'     => $parentId,
            'receiver_type' => 'teacher',
            'receiver_id'   => $teacherId,
            'student_id'    => $request->student_id,
            'body'          => $request->body,
        ]);

        // إرسال إشعار للمعلم
        $studentName = $request->student_id
            ? Student::find($request->student_id)->getTranslation('name', 'ar')
            : null;
        $parentName = auth()->user()->getTranslation('Name_Father', 'ar');
        $conversationUrl = '/en/teacher/messages/' . $parentId;

        $teacher->notify(new NewMessageNotification(
            $parentName,
            $request->body,
            $studentName,
            $conversationUrl
        ));

        toastr()->success('تم إرسال الرسالة');
        return redirect()->back();
    }
}
