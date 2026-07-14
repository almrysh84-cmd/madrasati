<?php

namespace App\Http\Controllers\Students\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Homework;
use App\Models\Quizze;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Degree;
use App\Models\Attendance;
use App\Notifications\NewMessageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentSubjectsController extends Controller
{
    /**
     * عرض قائمة المواد الدراسية — يختار الطالب الترم أولاً
     */
    public function index(Request $request)
    {
        $student = auth()->user();
        $term = $request->get('term', 1); // افتراضي: الترم الأول

        // جلب المواد المرتبطة بصف الطالب + الترم المحدد
        $subjects = Subject::with(['teacher', 'grade', 'classroom'])
            ->where('grade_id', $student->Grade_id)
            ->where('classroom_id', $student->Classroom_id)
            ->where('term', $term)
            ->orderBy('id')
            ->get();

        // إضافة إحصائيات لكل مادة
        foreach ($subjects as $subject) {
            $subject->homeworks_count = Homework::where('subject_id', $subject->id)
                ->where('grade_id', $student->Grade_id)
                ->where('classroom_id', $student->Classroom_id)
                ->where('section_id', $student->section_id)
                ->count();

            $subject->quizzes_count = Quizze::where('subject_id', $subject->id)
                ->where('grade_id', $student->Grade_id)
                ->where('classroom_id', $student->Classroom_id)
                ->where('section_id', $student->section_id)
                ->count();

            $degrees = Degree::where('student_id', $student->id)
                ->whereHas('quizze', function($q) use ($subject) {
                    $q->where('subject_id', $subject->id);
                })
                ->get();
            $subject->total_score = $degrees->sum('score');
            $subject->exams_taken = $degrees->count();
        }

        return view('pages.Students.dashboard.subjects_index', compact('subjects', 'term'));
    }

    /**
     * عرض تفاصيل مادة محددة
     */
    public function show($subjectId)
    {
        $student = auth()->user();

        $subject = Subject::with(['teacher', 'grade', 'classroom'])
            ->findOrFail($subjectId);

        if ($subject->grade_id != $student->Grade_id
            || $subject->classroom_id != $student->Classroom_id) {
            abort(403, 'هذه المادة غير متاحة لصفك');
        }

        $homeworks = Homework::with(['teacher'])
            ->where('subject_id', $subjectId)
            ->where('grade_id', $student->Grade_id)
            ->where('classroom_id', $student->Classroom_id)
            ->where('section_id', $student->section_id)
            ->orderBy('due_date', 'desc')
            ->get();

        $quizzes = Quizze::where('subject_id', $subjectId)
            ->where('grade_id', $student->Grade_id)
            ->where('classroom_id', $student->Classroom_id)
            ->where('section_id', $student->section_id)
            ->orderBy('id', 'desc')
            ->get();

        $degrees = Degree::where('student_id', $student->id)
            ->whereHas('quizze', function($q) use ($subjectId) {
                $q->where('subject_id', $subjectId);
            })
            ->with('quizze')
            ->orderBy('id', 'desc')
            ->get();

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

        $messages = \App\Models\Message::where(function ($q) use ($student, $teacher) {
            $q->where('sender_type', 'student')->where('sender_id', $student->id)
              ->where('receiver_type', 'teacher')->where('receiver_id', $teacher->id);
        })->orWhere(function ($q) use ($student, $teacher) {
            $q->where('sender_type', 'teacher')->where('sender_id', $teacher->id)
              ->where('receiver_type', 'student')->where('receiver_id', $student->id);
        })->orderBy('created_at', 'asc')->get();

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

        \App\Models\Message::create([
            'sender_type'   => 'student',
            'sender_id'     => $student->id,
            'receiver_type' => 'teacher',
            'receiver_id'   => $teacher->id,
            'student_id'    => $student->id,
            'body'          => $request->body,
        ]);

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
