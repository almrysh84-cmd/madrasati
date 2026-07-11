<?php

namespace App\Repository;

use App\Models\Section;
use App\Models\Student;
use App\Models\Fee_invoice;
use App\Models\ReceiptStudent;
use App\Models\Attendance;
use App\Models\Degree;
use App\Models\Quizze;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * مستودع طباعة التقارير PDF
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class PdfRepository implements PdfRepositoryInterface
{
    /**
     * كشف أسماء الفصل - قائمة طلاب القسم
     */
    public function classRoster($section_id)
    {
        $section = Section::with(['Grades', 'My_classs'])->findOrFail($section_id);
        $students = Student::where('section_id', $section_id)
            ->with(['gender', 'nationalitie'])
            ->orderBy('id')
            ->get();

        $data = [
            'section' => $section,
            'students' => $students,
            'date_gregorian' => Carbon::now()->format('Y-m-d'),
            'date_hijri' => $this->gregorianToHijri(Carbon::now()),
            'school_name' => $this->getSetting('school_name', 'مدرستي'),
            'developer' => 'أحمد المريش',
        ];

        $pdf = Pdf::loadView('pages.Pdf.class_roster', $data);
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOption('isHtml5ParserEnabled', true);
        $pdf->setOption('isRemoteEnabled', true);

        return $pdf->stream('class_roster_' . $section_id . '.pdf');
    }

    /**
     * النتائج النهائية للطالب
     */
    public function finalResults($student_id)
    {
        $student = Student::with(['grade', 'classroom', 'section', 'gender', 'nationalitie'])
            ->findOrFail($student_id);

        $degrees = Degree::where('student_id', $student_id)
            ->with(['quizze' => function ($q) {
                $q->with('subject');
            }])
            ->get();

        $data = [
            'student' => $student,
            'degrees' => $degrees,
            'date_gregorian' => Carbon::now()->format('Y-m-d'),
            'date_hijri' => $this->gregorianToHijri(Carbon::now()),
            'school_name' => $this->getSetting('school_name', 'مدرستي'),
            'developer' => 'أحمد المريش',
            'total_score' => $degrees->sum('score'),
            'average' => $degrees->count() > 0 ? round($degrees->avg('score'), 2) : 0,
        ];

        $pdf = Pdf::loadView('pages.Pdf.final_results', $data);
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOption('isHtml5ParserEnabled', true);
        $pdf->setOption('isRemoteEnabled', true);

        return $pdf->stream('final_results_' . $student_id . '.pdf');
    }

    /**
     * فاتورة الرسوم
     */
    public function feeInvoice($invoice_id)
    {
        $invoice = Fee_invoice::with(['student', 'fees', 'grade', 'classroom'])
            ->findOrFail($invoice_id);

        $data = [
            'invoice' => $invoice,
            'date_gregorian' => Carbon::now()->format('Y-m-d'),
            'date_hijri' => $this->gregorianToHijri(Carbon::now()),
            'school_name' => $this->getSetting('school_name', 'مدرستي'),
            'developer' => 'أحمد المريش',
        ];

        $pdf = Pdf::loadView('pages.Pdf.fee_invoice', $data);
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOption('isHtml5ParserEnabled', true);
        $pdf->setOption('isRemoteEnabled', true);

        return $pdf->stream('fee_invoice_' . $invoice_id . '.pdf');
    }

    /**
     * إيصال الدفع
     */
    public function receipt($receipt_id)
    {
        $receipt = ReceiptStudent::with(['student'])->findOrFail($receipt_id);

        $data = [
            'receipt' => $receipt,
            'date_gregorian' => Carbon::now()->format('Y-m-d'),
            'date_hijri' => $this->gregorianToHijri(Carbon::now()),
            'school_name' => $this->getSetting('school_name', 'مدرستي'),
            'developer' => 'أحمد المريش',
        ];

        $pdf = Pdf::loadView('pages.Pdf.receipt', $data);
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOption('isHtml5ParserEnabled', true);
        $pdf->setOption('isRemoteEnabled', true);

        return $pdf->stream('receipt_' . $receipt_id . '.pdf');
    }

    /**
     * مصفوفة الحضور الشهري
     */
    public function attendanceMatrix($request)
    {
        $month = $request->get('month', date('m'));
        $year = $request->get('year', date('Y'));
        $section_id = $request->get('section_id');

        $query = Attendance::with(['students', 'grade', 'section']);

        if ($section_id) {
            $query->where('section_id', $section_id);
        }

        $query->whereMonth('attendence_date', $month)
              ->whereYear('attendence_date', $year);

        $attendances = $query->get();

        // بناء مصفوفة الطلاب × الأيام
        $students = Student::when($section_id, function ($q) use ($section_id) {
            $q->where('section_id', $section_id);
        })->orderBy('id')->get();

        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        $matrix = [];
        foreach ($students as $student) {
            $row = ['student' => $student, 'days' => []];
            for ($day = 1; $day <= $daysInMonth; $day++) {
                $date = sprintf('%04d-%02d-%02d', $year, $month, $day);
                $att = $attendances->where('student_id', $student->id)
                    ->where('attendence_date', $date)
                    ->first();
                $row['days'][$day] = $att ? ($att->attendence_status ? '✓' : '✗') : '-';
            }
            $matrix[] = $row;
        }

        $data = [
            'matrix' => $matrix,
            'month' => $month,
            'year' => $year,
            'daysInMonth' => $daysInMonth,
            'section' => $section_id ? Section::find($section_id) : null,
            'date_gregorian' => Carbon::now()->format('Y-m-d'),
            'date_hijri' => $this->gregorianToHijri(Carbon::now()),
            'school_name' => $this->getSetting('school_name', 'مدرستي'),
            'developer' => 'أحمد المريش',
        ];

        $pdf = Pdf::loadView('pages.Pdf.attendance_matrix', $data);
        $pdf->setPaper('A4', 'landscape');
        $pdf->setOption('isHtml5ParserEnabled', true);
        $pdf->setOption('isRemoteEnabled', true);

        return $pdf->stream('attendance_matrix_' . $month . '_' . $year . '.pdf');
    }

    /**
     * الحصول على إعداد من جدول الإعدادات
     */
    private function getSetting($key, $default = '')
    {
        $setting = \App\Models\Setting::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * تحويل التاريخ الميلادي إلى هجري
     */
    private function gregorianToHijri($date)
    {
        if (!extension_loaded('intl')) {
            return $date->format('Y-m-d');
        }

        $formatter = new \IntlDateFormatter(
            'ar-SA@calendar=islamic',
            \IntlDateFormatter::FULL,
            \IntlDateFormatter::NONE,
            'Asia/Riyadh',
            \IntlCalendar::TRADITIONAL_BASE,
            'dd/MM/yyyy'
        );

        return $formatter->format($date->timestamp);
    }
}
