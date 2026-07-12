<?php

namespace App\Repository;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\My_Parent;
use App\Models\Section;
use App\Models\Grade;
use App\Models\Classroom;
use App\Models\Attendance;
use App\Models\Fee_invoice;
use App\Models\ReceiptStudent;
use App\Models\Quizze;
use App\Models\Degree;
use App\Models\Subject;
use App\Models\Library;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

/**
 * مستودع لوحة التحكم الإحصائية
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class DashboardRepository implements DashboardRepositoryInterface
{
    // مدة التخزين المؤقت للإحصائيات (5 دقائق) - Feature 6
    const CACHE_TTL = 300;

    /**
     * استرجاع آمن من الذاكرة المؤقتة مع fallback عند فشل Redis
     * إذا فشل التخزين المؤقت (مثلاً Redis غير متاح)، يتم تنفيذ callback مباشرة
     *
     * @param string   $key      مفتاح التخزين
     * @param int      $ttl      وقت الانتهاء بالثواني
     * @param callable $callback الدالة المنفذة عند عدم وجود القيمة
     * @return mixed
     */
    private function safeRemember(string $key, int $ttl, callable $callback)
    {
        try {
            return Cache::remember($key, $ttl, $callback);
        } catch (\Exception $e) {
            Log::warning('Dashboard cache failed, executing directly: ' . $e->getMessage());
            return $callback();
        }
    }

    /**
     * عرض لوحة التحكم مع البيانات الإحصائية
     */
    public function index()
    {
        // إحصائيات عامة - مع التخزين المؤقت (Feature 6)
        $stats = $this->safeRemember('dashboard:stats', self::CACHE_TTL, function () {
            return [
                'students_count'     => Student::count(),
                'teachers_count'     => Teacher::count(),
                'parents_count'      => My_Parent::count(),
                'sections_count'     => Section::count(),
                'grades_count'       => Grade::count(),
                'classrooms_count'   => Classroom::count(),
                'quizzes_count'      => Quizze::count(),
                'subjects_count'     => Subject::count(),
                'fee_invoices_count' => Fee_invoice::count(),
                'receipts_count'     => ReceiptStudent::count(),
                'library_count'      => Library::count(),
            ];
        });

        // توزيع الطلاب حسب المرحلة الدراسية - مع التخزين المؤقت (Feature 6)
        $studentsByGrade = $this->safeRemember('dashboard:students_by_grade', self::CACHE_TTL, function () {
            return Student::select('Grade_id', DB::raw('count(*) as total'))
            ->with('grade')
            ->groupBy('Grade_id')
            ->get()
            ->map(function ($item) {
                return [
                    'name'  => $item->grade ? $item->grade->getTranslation('Name', 'ar') : 'غير محدد',
                    'count' => $item->total,
                ];
            });
        });

        // توزيع الطلاب حسب النوع (جنس) - مع التخزين المؤقت (Feature 6)
        $studentsByGender = $this->safeRemember('dashboard:students_by_gender', self::CACHE_TTL, function () {
            return Student::select('gender_id', DB::raw('count(*) as total'))
            ->with('gender')
            ->groupBy('gender_id')
            ->get()
            ->map(function ($item) {
                return [
                    'name'  => $item->gender ? $item->gender->getTranslation('Name', 'ar') : 'غير محدد',
                    'count' => $item->total,
                ];
            });
        });

        // نسبة الحضور والغياب لهذا الشهر
        $currentMonth = date('m');
        $currentYear  = date('Y');
        $presentCount = Attendance::where('attendence_status', 1)
            ->whereMonth('attendence_date', $currentMonth)
            ->whereYear('attendence_date', $currentYear)
            ->count();
        $absentCount = Attendance::where('attendence_status', 0)
            ->whereMonth('attendence_date', $currentMonth)
            ->whereYear('attendence_date', $currentYear)
            ->count();

        // إجمالي الرسوم المحصلة مقابل غير المحصلة - مع التخزين المؤقت (Feature 6)
        $feesOverview = $this->safeRemember('dashboard:fees_overview', self::CACHE_TTL, function () {
            $totalInvoiced = Fee_invoice::sum('amount');
            $totalCollected = ReceiptStudent::sum('Debit');
            $totalPending = max($totalInvoiced - $totalCollected, 0);
            return compact('totalInvoiced', 'totalCollected', 'totalPending');
        });
        $totalInvoiced = $feesOverview['totalInvoiced'];
        $totalCollected = $feesOverview['totalCollected'];
        $totalPending = $feesOverview['totalPending'];

        // آخر 7 أيام حضور - مع التخزين المؤقت قصير المدة (Feature 6)
        // P1-3 fix: replaced 14 separate COUNT queries with a single grouped query.
        $last7Days = $this->safeRemember('dashboard:attendance_7days', 120, function () {
            $startDate = date('Y-m-d', strtotime('-6 days'));
            $endDate = date('Y-m-d');

            $rows = Attendance::selectRaw('attendence_date, attendence_status, COUNT(*) as cnt')
                ->whereBetween('attendence_date', [$startDate, $endDate])
                ->groupBy('attendence_date', 'attendence_status')
                ->get();

            $map = [];
            foreach ($rows as $r) {
                $map[$r->attendence_date][$r->attendence_status] = $r->cnt;
            }

            $days = [];
            for ($i = 6; $i >= 0; $i--) {
                $date = date('Y-m-d', strtotime("-$i days"));
                $days[] = [
                    'date'    => $date,
                    'present' => $map[$date][1] ?? 0,
                    'absent'  => $map[$date][0] ?? 0,
                ];
            }
            return $days;
        });

        return view('dashboard', compact(
            'stats',
            'studentsByGrade',
            'studentsByGender',
            'presentCount',
            'absentCount',
            'totalInvoiced',
            'totalCollected',
            'totalPending',
            'last7Days'
        ));
    }

    /**
     * بيانات الرسوم البيانية (JSON) - للاستخدام عبر AJAX
     */
    public function chartData(Request $request)
    {
        $type = $request->get('type', 'overview');

        switch ($type) {
            case 'students_by_grade':
                return $this->studentsByGradeData();
            case 'students_by_gender':
                return $this->studentsByGenderData();
            case 'attendance_7days':
                return $this->attendance7DaysData();
            case 'fees_overview':
                return $this->feesOverviewData();
            default:
                return $this->overviewData();
        }
    }

    private function studentsByGradeData()
    {
        $data = Student::select('Grade_id', DB::raw('count(*) as total'))
            ->with('grade')
            ->groupBy('Grade_id')
            ->get();

        return response()->json([
            'labels' => $data->map(fn($i) => $i->grade ? $i->grade->getTranslation('Name', 'ar') : 'غير محدد'),
            'values' => $data->pluck('total'),
        ]);
    }

    private function studentsByGenderData()
    {
        $data = Student::select('gender_id', DB::raw('count(*) as total'))
            ->with('gender')
            ->groupBy('gender_id')
            ->get();

        return response()->json([
            'labels' => $data->map(fn($i) => $i->gender ? $i->gender->getTranslation('Name', 'ar') : 'غير محدد'),
            'values' => $data->pluck('total'),
        ]);
    }

    private function attendance7DaysData()
    {
        // P1-3 fix: single grouped query instead of 14 COUNT queries.
        $startDate = date('Y-m-d', strtotime('-6 days'));
        $endDate = date('Y-m-d');

        $rows = Attendance::selectRaw('attendence_date, attendence_status, COUNT(*) as cnt')
            ->whereBetween('attendence_date', [$startDate, $endDate])
            ->groupBy('attendence_date', 'attendence_status')
            ->get();

        $map = [];
        foreach ($rows as $r) {
            $map[$r->attendence_date][$r->attendence_status] = $r->cnt;
        }

        $labels = [];
        $present = [];
        $absent  = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $labels[] = $date;
            $present[] = $map[$date][1] ?? 0;
            $absent[]  = $map[$date][0] ?? 0;
        }
        return response()->json([
            'labels'  => $labels,
            'present' => $present,
            'absent'  => $absent,
        ]);
    }

    private function feesOverviewData()
    {
        $totalInvoiced  = (float) Fee_invoice::sum('amount');
        $totalCollected = (float) ReceiptStudent::sum('Debit');
        $totalPending   = max($totalInvoiced - $totalCollected, 0);
        return response()->json([
            'labels' => ['المحصّل', 'المتبقي'],
            'values' => [$totalCollected, $totalPending],
        ]);
    }

    private function overviewData()
    {
        return response()->json([
            'students'    => Student::count(),
            'teachers'    => Teacher::count(),
            'parents'     => My_Parent::count(),
            'sections'    => Section::count(),
            'quizzes'     => Quizze::count(),
            'fee_invoices'=> Fee_invoice::count(),
        ]);
    }
}
