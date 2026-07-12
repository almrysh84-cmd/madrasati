<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Section;
use App\Models\Student;
use App\Models\Subject;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{

    public function index()
    {
        $ids = DB::table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck('section_id');
        // Eager-load relations to avoid N+1 queries when rendering the table
        $students = Student::with(['gender', 'grade', 'classroom', 'section'])
            ->whereIn('section_id', $ids)
            ->get();
        // جلب مواد المعلم
        $subjects = Subject::where('teacher_id', auth()->user()->id)->get();
        return view('pages.Teachers.dashboard.students.index', compact('students', 'subjects'));
    }

    public function sections()
    {
        $ids = DB::table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck('section_id');
        $sections = Section::whereIn('id', $ids)->get();
        return view('pages.Teachers.dashboard.sections.index', compact('sections'));
    }

    public function attendance(Request $request)
    {

        try {

            $attenddate = date('Y-m-d');
            $subjectId = $request->subject_id;

            // التحقق أن المادة تخص المعلم
            $subject = Subject::where('id', $subjectId)
                ->where('teacher_id', auth()->user()->id)
                ->first();

            if (!$subject) {
                toastr()->error('مادة غير مصرح بها');
                return redirect()->back();
            }

            foreach ($request->attendences as $studentid => $attendence) {
                if ($attendence == 'presence') {
                    $attendence_status = true;
                } else if ($attendence == 'absent') {
                    $attendence_status = false;
                }

                Attendance::updateorCreate(
                    [
                        'student_id' => $studentid,
                        'attendence_date' => $attenddate,
                        'subject_id' => $subjectId
                    ],
                    [
                    'student_id' => $studentid,
                    'grade_id' => $request->grade_id,
                    'classroom_id' => $request->classroom_id,
                    'section_id' => $request->section_id,
                    'subject_id' => $subjectId,
                    'teacher_id' => auth()->user()->id,
                    'attendence_date' => $attenddate,
                    'attendence_status' => $attendence_status
                ]);
            }
            toastr()->success(trans('messages.success'));
            return redirect()->back();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function attendanceReport()
    {

        $ids = DB::table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck('section_id');
        $students = Student::whereIn('section_id', $ids)->get();
        $subjects = Subject::where('teacher_id', auth()->user()->id)->get();
        return view('pages.Teachers.dashboard.students.attendance_report', compact('students', 'subjects'));
    }

    public function attendanceSearch(Request $request)
    {

        $request->validate([
            'from'  => 'required|date|date_format:Y-m-d',
            'to' => 'required|date|date_format:Y-m-d|after_or_equal:from'
        ], [
            'to.after_or_equal' => 'تاريخ النهاية لابد ان اكبر من تاريخ البداية او يساويه',
            'from.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
            'to.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
        ]);


        $ids = DB::table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck('section_id');
        $students = Student::whereIn('section_id', $ids)->get();
        $subjects = Subject::where('teacher_id', auth()->user()->id)->get();

        // بناء الاستعلام مع تحديد صلاحيات المعلم
        $query = Attendance::where('teacher_id', auth()->user()->id)
            ->whereBetween('attendence_date', [$request->from, $request->to]);

        // فلترة حسب المادة إن تم تحديدها
        if ($request->subject_id && $request->subject_id != 0) {
            $query->where('subject_id', $request->subject_id);
        }

        if ($request->student_id == 0) {
            $Students = $query->get();
            return view('pages.Teachers.dashboard.students.attendance_report', compact('Students', 'students', 'subjects'));
        } else {
            $Students = $query->where('student_id', $request->student_id)->get();
            return view('pages.Teachers.dashboard.students.attendance_report', compact('Students', 'students', 'subjects'));
        }
    }

}
