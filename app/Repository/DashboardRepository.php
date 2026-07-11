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

/**
 * مستودع لوحة التحكم الإحصائية
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class DashboardRepository implements DashboardRepositoryInterface
{
    /**
     * عرض لوحة التحكم مع البيانات الإحصائية
     */
    public function index()
    {
        // إحصائيات عامة
        $stats = [
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

        // توزيع الطلاب حسب المرحلة الدراسية
        $studentsByGrade = Student::select('Grade_id', DB::raw('count(*) as total'))
            ->with('grade')
            ->groupBy('Grade_id')
            ->get()
            ->map(function ($item) {
                return [
                    'name'  => $item->grade ? $item->grade->getTranslation('Name', 'ar') : 'غير محدد',
                    'count' => $item->total,
                ];
            });

        // توزيع الطلاب حسب النوع (جنس)
        $studentsByGender = Student::select('gender_id', DB::raw('count(*) as total'))
            ->with('gender')
            ->groupBy('gender_id')
            ->get()
            ->map(function ($item) {
                return [
                    'name'  => $item->gender ? $item->gender->getTranslation('Name', 'ar') : 'غير محدد',
                    'count' => $item->total,
                ];
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

        // إجمالي الرسوم المحصلة مقابل غير المحصلة
        $totalInvoiced = Fee_invoice::sum('amount');
        $totalCollected = ReceiptStudent::sum('Debit');
        $totalPending = max($totalInvoiced - $totalCollected, 0);

        // آخر 7 أيام حضور
        $last7Days = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $last7Days[] = [
                'date'    => $date,
                'present' => Attendance::where('attendence_date', $date)->where('attendence_status', 1)->count(),
                'absent'  => Attendance::where('attendence_date', $date)->where('attendence_status', 0)->count(),
            ];
        }

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
        $labels = [];
        $present = [];
        $absent  = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $labels[] = $date;
            $present[] = Attendance::where('attendence_date', $date)->where('attendence_status', 1)->count();
            $absent[]  = Attendance::where('attendence_date', $date)->where('attendence_status', 0)->count();
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
