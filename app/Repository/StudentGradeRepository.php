<?php

namespace App\Repository;

use App\Models\Section;
use App\Models\Student;
use App\Models\StudentGrade;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;

class StudentGradeRepository implements StudentGradeRepositoryInterface
{

    /**
     * عرض صفحة إدخال التقديرات
     * المواد المتاحة = مواد المعلم فقط
     */
    public function index()
    {
        $subjects = Subject::where('teacher_id', auth()->user()->id)->get();

        // أقسام المعلم
        $sectionIds = DB::table('teacher_section')
            ->where('teacher_id', auth()->user()->id)
            ->pluck('section_id');
        $sections = Section::whereIn('id', $sectionIds)->get();

        return view('pages.Teachers.dashboard.Grades.index', compact('subjects', 'sections'));
    }

    /**
     * جلب الطلاب حسب المادة والقسم المحدد (يُستخدم للعرض في نموذج الإدخال)
     */
    public function getStudents($subject_id, $section_id)
    {
        $students = Student::where('section_id', $section_id)->get();

        // التحقق أن المادة تخص المعلم
        $subject = Subject::where('id', $subject_id)
            ->where('teacher_id', auth()->user()->id)
            ->first();

        if (!$subject) {
            return response()->json(['error' => 'مادة غير مصرح بها'], 403);
        }

        // جلب التقديرات الموجودة مسبقاً لكل طالب
        $students->load(['grade', 'classroom', 'section']);

        $result = [];
        foreach ($students as $student) {
            $grade = StudentGrade::where('student_id', $student->id)
                ->where('subject_id', $subject_id)
                ->latest()
                ->first();
            $result[] = [
                'id' => $student->id,
                'name' => $student->name,
                'score' => $grade ? $grade->score : null,
                'grade_text' => $grade ? $grade->grade_text : null,
                'term' => $grade ? $grade->term : null,
                'note' => $grade ? $grade->note : null,
            ];
        }

        return response()->json([
            'students' => $result,
            'subject' => $subject,
        ]);
    }

    /**
     * حفظ التقديرات
     */
    public function store($request)
    {
        DB::beginTransaction();
        try {
            // التحقق أن المادة تخص المعلم
            $subject = Subject::where('id', $request->subject_id)
                ->where('teacher_id', auth()->user()->id)
                ->first();

            if (!$subject) {
                toastr()->error('مادة غير مصرح بها');
                return redirect()->back();
            }

            // أقسام المعلم
            $teacherSectionIds = DB::table('teacher_section')
                ->where('teacher_id', auth()->user()->id)
                ->pluck('section_id')
                ->toArray();

            $date = date('Y-m-d');
            $evaluationType = $request->evaluation_type ?? 'score';
            $term = $request->term;

            foreach ($request->student_ids as $studentId) {
                $student = Student::find($studentId);
                if (!$student) {
                    continue;
                }

                // التحقق أن الطالب في قسم يخص المعلم
                if (!in_array($student->section_id, $teacherSectionIds)) {
                    continue;
                }

                $score = $request->scores[$studentId] ?? null;
                $gradeText = $request->grade_texts[$studentId] ?? null;
                $note = $request->notes[$studentId] ?? null;

                // تخطي إذا لم يُدخل أي قيمة
                if ($score === null && $gradeText === null) {
                    continue;
                }

                // تحويل التقدير النصي إلى درجة رقمية تلقائياً
                if ($evaluationType === 'text' && $gradeText) {
                    $score = $this->textGradeToScore($gradeText);
                }

                StudentGrade::updateOrCreate(
                    [
                        'student_id' => $studentId,
                        'subject_id' => $request->subject_id,
                        'term' => $term,
                    ],
                    [
                        'student_id' => $studentId,
                        'subject_id' => $request->subject_id,
                        'teacher_id' => auth()->user()->id,
                        'grade_id' => $student->Grade_id,
                        'classroom_id' => $student->Classroom_id,
                        'section_id' => $student->section_id,
                        'evaluation_type' => $evaluationType,
                        'score' => $score,
                        'grade_text' => $gradeText,
                        'term' => $term,
                        'note' => $note,
                        'date' => $date,
                    ]
                );
            }

            DB::commit();
            toastr()->success('تم حفظ التقديرات بنجاح');
            return redirect()->route('grades.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * تحويل التقدير النصي إلى درجة رقمية
     */
    private function textGradeToScore($gradeText)
    {
        $map = [
            'ممتاز' => 100,
            'جيد جدا' => 85,
            'جيد جداً' => 85,
            'جيد' => 75,
            'مقبول' => 65,
            'ضعيف' => 50,
            'راسب' => 40,
        ];

        return $map[$gradeText] ?? null;
    }

    /**
     * عرض تقرير التقديرات
     */
    public function report()
    {
        $subjects = Subject::where('teacher_id', auth()->user()->id)->get();

        $teacherSectionIds = DB::table('teacher_section')
            ->where('teacher_id', auth()->user()->id)
            ->pluck('section_id');
        $sections = Section::whereIn('id', $teacherSectionIds)->get();

        return view('pages.Teachers.dashboard.Grades.report', compact('subjects', 'sections'));
    }

    /**
     * البحث في تقرير التقديرات
     */
    public function search($request)
    {
        $subjects = Subject::where('teacher_id', auth()->user()->id)->get();

        $teacherSectionIds = DB::table('teacher_section')
            ->where('teacher_id', auth()->user()->id)
            ->pluck('section_id')
            ->toArray();
        $sections = Section::whereIn('id', $teacherSectionIds)->get();

        $query = StudentGrade::where('teacher_id', auth()->user()->id)
            ->whereIn('section_id', $teacherSectionIds);

        if ($request->subject_id && $request->subject_id != 0) {
            // التحقق أن المادة تخص المعلم
            $subject = Subject::where('id', $request->subject_id)
                ->where('teacher_id', auth()->user()->id)
                ->first();
            if ($subject) {
                $query->where('subject_id', $request->subject_id);
            }
        }

        if ($request->section_id && $request->section_id != 0) {
            if (in_array($request->section_id, $teacherSectionIds)) {
                $query->where('section_id', $request->section_id);
            }
        }

        if ($request->term && $request->term != '') {
            $query->where('term', $request->term);
        }

        $grades = $query->with(['student', 'subject', 'grade', 'section'])->get();

        return view('pages.Teachers.dashboard.Grades.report', compact('subjects', 'sections', 'grades'));
    }
}
