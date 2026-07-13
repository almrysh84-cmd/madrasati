<?php

namespace App\Http\Controllers\Students\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Homework;
use App\Models\Quizze;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Degree;
use App\Models\Attendance;
use App\Notifications\NewMessageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentSubjectsController extends Controller
{
    /**
     * عرض قائمة المواد الدراسية للطالب المسجّل دخوله
     * المواد تُجلب بناءً على صف وقسم الطالب
     */
    public function index()
    {
        $student = auth()->user();

        // جلب المواد المرتبطة بصف الطالب مع معلمها
        $subjects = Subject::with(['teacher', 'grade', 'classroom'])
            ->where('grade_id', $student->Grade_id)
            ->where('classroom_id', $student->Classroom_id)
            ->orderBy('id')
            ->get();

        // إضافة إحصائيات لكل مادة
        foreach ($subjects as $subject) {
            // عدد الواجبات
            $subject->homeworks_count = Homework::where('subject_id', $subject->id)
                ->where('grade_id', $student->Grade_id)
                ->where('classroom_id', $student->Classroom_id)
                ->where('section_id', $student->section_id)
                ->count();

            // عدد الاختبارات
            $subject->quizzes_count = Quizze::where('subject_id', $subject->id)
                ->where('grade_id', $student->Grade_id)
                ->where('classroom_id', $student->Classroom_id)
                ->where('section_id', $student->section_id)
                ->count();

            // درجة الطالب في هذه المادة
            $degrees = Degree::where('student_id', $student->id)
                ->whereHas('quizze', function($q) use ($subject) {
                    $q->where('subject_id', $subject->id);
                })
                ->get();
            $subject->total_score = $degrees->sum('score');
            $subject->exams_taken = $degrees->count();
        }

        return view('pages.Students.dashboard.subjects_index', compact('subjects'));
    }

    /**
     * عرض تفاصيل مادة محددة: واجبات + اختبارات + درجات + معلومات المعلم
     */
    public function show($subjectId)
    {
        $student = auth()->user();

        $subject = Subject::with(['teacher', 'grade', 'classroom'])
            ->findOrFail($subjectId);

        // التأكد من أن المادة تخص صف الطالب
        if ($subject->grade_id != $student->Grade_id
            || $subject->classroom_id != $student->Classroom_id) {
            abort(403, 'هذه المادة غير متاحة لصفك');
        }

        // الواجبات الخاصة بهذه المادة في صف الطالب
        $homeworks = Homework::with(['teacher'])
            ->where('subject_id', $subjectId)
            ->where('grade_id', $student->Grade_id)
            ->where('classroom_id', $student->Classroom_id)
            ->where('section_id', $student->section_id)
            ->orderBy('due_date', 'desc')
            ->get();

        // الاختبارات الخاصة بهذه المادة
        $quizzes = Quizze::where('subject_id', $subjectId)
            ->where('grade_id', $student->Grade_id)
            ->where('classroom_id', $student->Classroom_id)
            ->where('section_id', $student->section_id)
            ->orderBy('id', 'desc')
            ->get();

        // درجات الطالب في هذه المادة
        $degrees = Degree::where('student_id', $student->id)
            ->whereHas('quizze', function($q) use ($subjectId) {
                $q->where('subject_id', $subjectId);
            })
            ->with('quizze')
            ->orderBy('id', 'desc')
            ->get();

        // سجل الحضور في هذه المادة
        $attendanceRecords = Attendance::where('student_id', $student->id)
            ->where('subject_id', $subjectId)
            ->orderBy('attendence_date', 'desc')
            ->take(20)
            ->get();
        $presentCount = $attendanceRecords->where('attendence_status', 1)->count();
        $absentCount = $attendanceRecords->where('attendence_status', 0)->count();

        return view('pages.Students.dashboard.subjects_show', compact(
            'subject', 'homeworks', 'quizzes', 'degrees',
            'attendanceRecords', 'presentCount', 'absentCount'
        ));
    }

    /**
     * عرض محادثة الطالب مع معلم مادة محددة
     */
    public function messages($subjectId)
    {
        $student = auth()->user();
        $subject = Subject::with('teacher')->findOrFail($subjectId);

        if (!$subject->teacher) {
            return redirect()->back()->with('error', 'لا يوجد معلم مرتبط بهذه المادة');
        }

        $teacher = $subject->teacher;

        // جلب كل الرسائل بين الطالب وهذا المعلم (في سياق هذه المادة)
        $messages = \App\Models\Message::where(function ($q) use ($student, $teacher) {
            $q->where('sender_type', 'student')->where('sender_id', $student->id)
              ->where('receiver_type', 'teacher')->where('receiver_id', $teacher->id);
        })->orWhere(function ($q) use ($student, $teacher) {
            $q->where('sender_type', 'teacher')->where('sender_id', $teacher->id)
              ->where('receiver_type', 'student')->where('receiver_id', $student->id);
        })->orderBy('created_at', 'asc')->get();

        // تحديد رسائل المعلم كمقروءة
        \App\Models\Message::where('sender_type', 'teacher')
            ->where('sender_id', $teacher->id)
            ->where('receiver_type', 'student')
            ->where('receiver_id', $student->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return view('pages.Students.dashboard.subject_messages', compact('subject', 'teacher', 'messages'));
    }

    /**
     * إرسال رسالة لمعلم المادة
     */
    public function sendMessage(Request $request, $subjectId)
    {
        $request->validate([
            'body' => 'required|string|max:2000',
        ], [
            'body.required' => 'يرجى كتابة نص الرسالة',
        ]);

        $student = auth()->user();
        $subject = Subject::with('teacher')->findOrFail($subjectId);

        if (!$subject->teacher) {
            return redirect()->back()->withErrors(['error' => 'لا يوجد معلم مرتبط بهذه المادة']);
        }

        $teacher = $subject->teacher;

        // التحقق أن student_id موجود في جدول messages
        // ملاحظة: جدول messages يستخدم sender_type/receiver_type كنصوص
        // 'student' = نموذج Student
        \App\Models\Message::create([
            'sender_type'   => 'student',
            'sender_id'     => $student->id,
            'receiver_type' => 'teacher',
            'receiver_id'   => $teacher->id,
            'student_id'    => $student->id,
            'body'          => $request->body,
        ]);

        // إرسال إشعار للمعلم
        $studentName = $student->getTranslation('name', 'ar');
        $subjectName = $subject->getTranslation('name', 'ar');
        $conversationUrl = '/en/teacher/student_messages/' . $student->id;

        $teacher->notify(new \App\Notifications\NewStudentMessageNotification(
            $studentName,
            $subjectName,
            $request->body,
            $conversationUrl
        ));

        toastr()->success('تم إرسال رسالتك للمعلم');
        return redirect()->back();
    }
}
