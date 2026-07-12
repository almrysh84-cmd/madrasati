<?php

namespace App\Repository;

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\PromotionLog;
use App\Models\Section;
use App\Models\Student;
use App\Models\StudentGrade;
use App\Notifications\PromotionNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AutoPromotionRepository implements AutoPromotionRepositoryInterface
{
    /**
     * عرض صفحة إعدادات محرك الترقية التلقائية
     * يعرض المعايير الحالية (من ملف الإعدادات / متغيرات البيئة) وإحصائيات
     */
    public function index()
    {
        $criteria = [
            'min_average'         => config('promotion.min_average', env('PROMOTION_MIN_AVERAGE', 50)),
            'max_failed_subjects' => config('promotion.max_failed_subjects', env('PROMOTION_MAX_FAILED_SUBJECTS', 0)),
            'auto_notify_parents' => config('promotion.auto_notify_parents', env('PROMOTION_AUTO_NOTIFY_PARENTS', true)),
        ];

        $grades = Grade::all();
        $pendingCount = PromotionLog::where('status', 'pending')->count();
        $approvedCount = PromotionLog::where('status', 'approved')->count();
        $rejectedCount = PromotionLog::where('status', 'rejected')->count();

        return view('pages.AutoPromotion.index', compact('criteria', 'grades', 'pendingCount', 'approvedCount', 'rejectedCount'));
    }

    /**
     * عرض سجلات الترقية التلقائية
     */
    public function logs()
    {
        $logs = PromotionLog::with(['student', 'fromGrade', 'toGrade', 'fromClassroom', 'toClassroom', 'reviewer'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.AutoPromotion.logs', compact('logs'));
    }

    /**
     * البحث عن الطلاب المرشحين للترقية التلقائية
     * يحسب متوسط درجات كل طالب ويحدد المواد الراسبة
     * يطبق معايير الترقية (المتوسط الأدنى + عدد المواد الراسبة المسموح)
     */
    public function findCandidates($request)
    {
        $minAverage = (float) ($request->min_average ?? env('PROMOTION_MIN_AVERAGE', 50));
        $maxFailedSubjects = (int) ($request->max_failed_subjects ?? env('PROMOTION_MAX_FAILED_SUBJECTS', 0));
        $academicYear = $request->academic_year ?? date('Y') . '/' . (date('Y') + 1);

        // جلب الطلاب حسب المرحلة/الصف/القسم المحدد
        $query = Student::with(['grade', 'classroom', 'section']);

        if ($request->filled('grade_id')) {
            $query->where('Grade_id', $request->grade_id);
        }
        if ($request->filled('classroom_id')) {
            $query->where('Classroom_id', $request->classroom_id);
        }
        if ($request->filled('section_id')) {
            $query->where('section_id', $request->section_id);
        }

        $students = $query->where('academic_year', $academicYear)->get();

        $candidates = [];
        $nonCandidates = [];

        foreach ($students as $student) {
            // حساب متوسط درجات الطالب من جدول student_grades (نوع score فقط)
            $grades = StudentGrade::where('student_id', $student->id)
                ->where('evaluation_type', 'score')
                ->whereNotNull('score')
                ->get();

            if ($grades->isEmpty()) {
                $nonCandidates[] = [
                    'student' => $student,
                    'average' => 0,
                    'failed_count' => 0,
                    'reason' => 'لا توجد تقديرات مسجلة',
                ];
                continue;
            }

            // افتراض أن الدرجة من 100
            $totalScore = $grades->sum('score');
            $subjectsCount = $grades->count();
            $average = $subjectsCount > 0 ? ($totalScore / $subjectsCount) : 0;

            // عدد المواد الراسبة (الدرجة أقل من المتوسط الأدنى)
            $failedCount = $grades->filter(function ($g) use ($minAverage) {
                return $g->score < $minAverage;
            })->count();

            $eligible = ($average >= $minAverage) && ($failedCount <= $maxFailedSubjects);

            $data = [
                'student' => $student,
                'average' => round($average, 2),
                'failed_count' => $failedCount,
                'eligible' => $eligible,
                'reason' => $eligible ? 'مؤهل للترقية' : ($average < $minAverage ? 'المتوسط أقل من الحد الأدنى' : 'تجاوز عدد المواد الراسبة'),
            ];

            if ($eligible) {
                $candidates[] = $data;
            } else {
                $nonCandidates[] = $data;
            }
        }

        return response()->json([
            'status' => true,
            'criteria' => [
                'min_average' => $minAverage,
                'max_failed_subjects' => $maxFailedSubjects,
                'academic_year' => $academicYear,
            ],
            'candidates' => $candidates,
            'non_candidates' => $nonCandidates,
            'total_students' => $students->count(),
            'eligible_count' => count($candidates),
        ]);
    }

    /**
     * تنفيذ عملية الترقية التلقائية
     * ينشئ سجلات ترقية بحالة pending بانتظار مراجعة المشرف
     */
    public function trigger($request)
    {
        DB::beginTransaction();
        try {
            $minAverage = (float) ($request->min_average ?? env('PROMOTION_MIN_AVERAGE', 50));
            $maxFailedSubjects = (int) ($request->max_failed_subjects ?? env('PROMOTION_MAX_FAILED_SUBJECTS', 0));
            $academicYear = $request->academic_year ?? date('Y') . '/' . (date('Y') + 1);
            $academicYearNew = $request->academic_year_new ?? (date('Y') + 1) . '/' . (date('Y') + 2);

            // المرحلة/الصف/القسم المستهدف
            $query = Student::query();
            if ($request->filled('grade_id')) {
                $query->where('Grade_id', $request->grade_id);
            }
            if ($request->filled('classroom_id')) {
                $query->where('Classroom_id', $request->classroom_id);
            }
            if ($request->filled('section_id')) {
                $query->where('section_id', $request->section_id);
            }
            $query->where('academic_year', $academicYear);

            $students = $query->get();
            $createdCount = 0;
            $skippedCount = 0;

            // تحديد المرحلة التالية (to_grade)
            $toGradeId = $request->to_grade_id;
            $toClassroomId = $request->to_classroom_id;
            $toSectionId = $request->to_section_id;

            foreach ($students as $student) {
                // التحقق من عدم وجود سجل ترقية معلق سابق
                $existingLog = PromotionLog::where('student_id', $student->id)
                    ->where('academic_year', $academicYear)
                    ->whereIn('status', ['pending', 'approved'])
                    ->first();

                if ($existingLog) {
                    $skippedCount++;
                    continue;
                }

                // حساب المتوسط والمواد الراسبة
                $grades = StudentGrade::where('student_id', $student->id)
                    ->where('evaluation_type', 'score')
                    ->whereNotNull('score')
                    ->get();

                $average = 0;
                $failedCount = 0;

                if ($grades->isNotEmpty()) {
                    $average = $grades->sum('score') / $grades->count();
                    $failedCount = $grades->filter(function ($g) use ($minAverage) {
                        return $g->score < $minAverage;
                    })->count();
                }

                // التحقق من استيفاء المعايير
                if ($average < $minAverage || $failedCount > $maxFailedSubjects) {
                    $skippedCount++;
                    continue;
                }

                // إنشاء سجل الترقية
                PromotionLog::create([
                    'student_id'             => $student->id,
                    'from_grade'             => $student->Grade_id,
                    'to_grade'               => $toGradeId,
                    'from_classroom'         => $student->Classroom_id,
                    'to_classroom'           => $toClassroomId,
                    'from_section'           => $student->section_id,
                    'to_section'             => $toSectionId,
                    'academic_year'          => $academicYear,
                    'academic_year_new'      => $academicYearNew,
                    'overall_average'        => round($average, 2),
                    'failed_subjects_count'  => $failedCount,
                    'status'                 => 'pending',
                    'triggered_by'           => auth()->user()->id,
                ]);
                $createdCount++;
            }

            DB::commit();
            toastr()->success("تم إنشاء {$createdCount} طلب ترقية بانتظار المراجعة" . ($skippedCount > 0 ? "، تم تجاهل {$skippedCount} طالب غير مؤهل" : ''));
            return redirect()->route('auto_promotion.review');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Auto Promotion trigger error: ' . $e->getMessage());
            return redirect()->back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

    /**
     * مراجعة وموافقة على ترقية طالب واحد
     */
    public function approve($id)
    {
        try {
            $log = PromotionLog::findOrFail($id);

            if ($log->status !== 'pending') {
                toastr()->error('لا يمكن الموافقة على طلب تمت مراجعته مسبقاً');
                return redirect()->back();
            }

            $log->update([
                'status'       => 'approved',
                'reviewed_by'  => auth()->user()->id,
                'reviewed_at'  => now(),
            ]);

            // إشعار ولي الأمر بالترقية
            if (env('PROMOTION_AUTO_NOTIFY_PARENTS', true) && $log->student && $log->student->myparent) {
                $log->student->myparent->notify(new PromotionNotification($log, 'approved'));
            }

            toastr()->success('تمت الموافقة على ترقية الطالب بنجاح');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * مراجعة ورفض ترقية طالب واحد
     */
    public function reject($request)
    {
        try {
            $log = PromotionLog::findOrFail($request->id);

            if ($log->status !== 'pending') {
                toastr()->error('لا يمكن رفض طلب تمت مراجعته مسبقاً');
                return redirect()->back();
            }

            $log->update([
                'status'       => 'rejected',
                'reviewed_by'  => auth()->user()->id,
                'reviewed_at'  => now(),
                'review_note'  => $request->review_note,
            ]);

            // إشعار ولي الأمر بالرفض
            if (env('PROMOTION_AUTO_NOTIFY_PARENTS', true) && $log->student && $log->student->myparent) {
                $log->student->myparent->notify(new PromotionNotification($log, 'rejected'));
            }

            toastr()->error('تم رفض ترقية الطالب');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * الموافقة الجماعية على جميع الترقيات المعلقة
     */
    public function approveAll()
    {
        DB::beginTransaction();
        try {
            $pendingLogs = PromotionLog::where('status', 'pending')->get();
            $count = 0;

            foreach ($pendingLogs as $log) {
                $log->update([
                    'status'       => 'approved',
                    'reviewed_by'  => auth()->user()->id,
                    'reviewed_at'  => now(),
                ]);

                if (env('PROMOTION_AUTO_NOTIFY_PARENTS', true) && $log->student && $log->student->myparent) {
                    $log->student->myparent->notify(new PromotionNotification($log, 'approved'));
                }
                $count++;
            }

            DB::commit();
            toastr()->success("تمت الموافقة على {$count} طلب ترقية");
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * تطبيق الترقيات الموافق عليها فعلياً
     * تحديث سجلات الطلاب (المرحلة/الصف/القسم/السنة الدراسية)
     * وإنشاء سجلات في جدول promotions للتاريخ
     */
    public function executeApproved()
    {
        DB::beginTransaction();
        try {
            $approvedLogs = PromotionLog::where('status', 'approved')->get();

            if ($approvedLogs->isEmpty()) {
                toastr()->warning('لا توجد ترقيات موافق عليها لتنفيذها');
                return redirect()->back();
            }

            $count = 0;
            foreach ($approvedLogs as $log) {
                // تحديث سجل الطالب
                Student::where('id', $log->student_id)->update([
                    'Grade_id'     => $log->to_grade,
                    'Classroom_id' => $log->to_classroom,
                    'section_id'   => $log->to_section,
                    'academic_year'=> $log->academic_year_new,
                ]);

                $count++;
            }

            DB::commit();
            toastr()->success("تم تنفيذ ترقية {$count} طالب بنجاح");
            return redirect()->route('auto_promotion.logs');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * عكس ترقية واحدة (إرجاع الطالب للمرحلة السابقة)
     */
    public function reverse($id)
    {
        try {
            $log = PromotionLog::findOrFail($id);

            if ($log->status !== 'approved') {
                toastr()->error('يمكن عكس الترقيات الموافق عليها فقط');
                return redirect()->back();
            }

            // إرجاع الطالب للمرحلة السابقة
            Student::where('id', $log->student_id)->update([
                'Grade_id'     => $log->from_grade,
                'Classroom_id' => $log->from_classroom,
                'section_id'   => $log->from_section,
                'academic_year'=> $log->academic_year,
            ]);

            $log->update([
                'status'      => 'rejected',
                'review_note' => 'تم عكس الترقية',
                'reviewed_by' => auth()->user()->id,
                'reviewed_at' => now(),
            ]);

            toastr()->success('تم عكس الترقية بنجاح');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
