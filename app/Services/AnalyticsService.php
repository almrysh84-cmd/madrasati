<?php

namespace App\Services;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Grade;
use App\Models\Attendance;
use App\Models\Degree;
use App\Models\Fee_invoice;
use App\Models\ReceiptStudent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

/**
 * خدمة التحليلات والتقارير المتقدمة.
 *
 * تُجمّع البيانات من جداول متعددة وتُرجع إحصائيات
 * جاهزة للعرض في المخططات (Chart.js) أو التصدير.
 */
class AnalyticsService
{
    /**
     * لوحة التحكم الرئيسية — إحصائيات سريعة
     */
    public function dashboardStats(): array
    {
        return Cache::remember('analytics:dashboard', 300, function () {
            return [
                'students_count'     => Student::count(),
                'teachers_count'     => Teacher::count(),
                'parents_count'      => \App\Models\My_Parent::count(),
                'sections_count'     => \App\Models\Section::count(),
                'quizzes_count'      => \App\Models\Quizze::count(),
                'fee_invoices_total' => Fee_invoice::sum('amount'),
                'receipts_total'     => ReceiptStudent::sum('Debit'),
                'pending_fees'       => max(Fee_invoice::sum('amount') - ReceiptStudent::sum('Debit'), 0),
            ];
        });
    }

    /**
     * توزيع الطلاب حسب المرحلة
     */
    public function studentsByGrade(): array
    {
        return Cache::remember('analytics:students_by_grade', 300, function () {
            $data = Student::select('Grade_id', DB::raw('count(*) as total'))
                ->with('grade')
                ->groupBy('Grade_id')
                ->get();

            return [
                'labels' => $data->map(fn($i) => $i->grade ? $i->grade->getTranslation('Name', 'ar') : 'غير محدد'),
                'values' => $data->pluck('total'),
            ];
        });
    }

    /**
     * متوسط درجات كل مادة
     */
    public function subjectAverages(int $gradeId = null, int $term = null): array
    {
        $cacheKey = 'analytics:subject_avg:' . ($gradeId ?? 'all') . ':' . ($term ?? 'all');

        return Cache::remember($cacheKey, 300, function () use ($gradeId, $term) {
            $query = DB::table('degrees')
                ->join('quizzes', 'degrees.quizze_id', '=', 'quizzes.id')
                ->join('subjects', 'quizzes.subject_id', '=', 'subjects.id')
                ->select('subjects.name', DB::raw('AVG(degrees.score) as avg_score'))
                ->groupBy('subjects.id', 'subjects.name');

            if ($gradeId) {
                $query->where('quizzes.grade_id', $gradeId);
            }
            if ($term) {
                $query->where('subjects.term', $term);
            }

            $data = $query->get();

            return [
                'labels' => $data->map(function ($i) {
                    $name = json_decode($i->name, true);
                    return $name['ar'] ?? $i->name;
                }),
                'values' => $data->map(fn($i) => round($i->avg_score, 2)),
            ];
        });
    }

    /**
     * تحليلات الحضور (آخر 30 يوماً)
     */
    public function attendanceTrend(int $days = 30): array
    {
        return Cache::remember('analytics:attendance_trend:' . $days, 300, function () use ($days) {
            $startDate = now()->subDays($days)->toDateString();

            $data = Attendance::selectRaw('DATE(attendence_date) as date,
                SUM(CASE WHEN attendence_status = 1 THEN 1 ELSE 0 END) as present,
                SUM(CASE WHEN attendence_status = 0 THEN 1 ELSE 0 END) as absent')
                ->where('attendence_date', '>=', $startDate)
                ->groupBy('date')
                ->orderBy('date')
                ->get();

            return [
                'labels'  => $data->pluck('date'),
                'present' => $data->pluck('present'),
                'absent'  => $data->pluck('absent'),
            ];
        });
    }

    /**
     * أفضل 10 طلاب (حسب مجموع الدرجات)
     */
    public function topStudents(int $limit = 10): array
    {
        return Cache::remember('analytics:top_students:' . $limit, 300, function () use ($limit) {
            return Student::with('grade')
                ->select('students.id', 'students.name', 'students.Grade_id',
                    DB::raw('(SELECT SUM(score) FROM degrees WHERE degrees.student_id = students.id) as total_score'))
                ->havingRaw('total_score IS NOT NULL')
                ->orderByDesc('total_score')
                ->limit($limit)
                ->get()
                ->map(function ($s) {
                    $name = is_string($s->name) ? json_decode($s->name, true) : $s->name;
                    return [
                        'name'   => $name['ar'] ?? $s->name,
                        'grade'  => $s->grade ? $s->grade->getTranslation('Name', 'ar') : '-',
                        'score'  => $s->total_score ?? 0,
                    ];
                })
                ->toArray();
        });
    }

    /**
     * تقرير مالي شامل
     */
    public function financialReport(): array
    {
        return Cache::remember('analytics:financial', 300, function () {
            $totalInvoiced = Fee_invoice::sum('amount');
            $totalCollected = ReceiptStudent::sum('Debit');
            $collectionRate = $totalInvoiced > 0 ? ($totalCollected / $totalInvoiced) * 100 : 0;

            // تحصيل حسب الصف
            $byGrade = DB::table('fee_invoices')
                ->join('grades', 'fee_invoices.Grade_id', '=', 'grades.id')
                ->select('grades.Name',
                    DB::raw('SUM(fee_invoices.amount) as invoiced'),
                    DB::raw('(SELECT SUM(receipt_students.Debit) FROM receipt_students
                             WHERE receipt_students.student_id IN (
                                 SELECT id FROM students WHERE students.Grade_id = grades.id
                             )) as collected'))
                ->groupBy('grades.id', 'grades.Name')
                ->get();

            return [
                'total_invoiced'    => $totalInvoiced,
                'total_collected'   => $totalCollected,
                'total_pending'     => max($totalInvoiced - $totalCollected, 0),
                'collection_rate'   => round($collectionRate, 2),
                'by_grade'          => $byGrade->map(function ($g) {
                    $name = json_decode($g->Name, true);
                    return [
                        'grade'     => $name['ar'] ?? $g->Name,
                        'invoiced'  => $g->invoiced,
                        'collected' => $g->collected ?? 0,
                        'pending'   => max($g->invoiced - ($g->collected ?? 0), 0),
                    ];
                }),
            ];
        });
    }

    /**
     * مسح كل الكاش
     */
    public function clearCache(): void
    {
        Cache::flush();
    }
}
