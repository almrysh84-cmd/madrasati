<?php

namespace App\Repository;

use App\Models\Section;
use App\Models\Student;
use App\Models\Fee_invoice;
use App\Models\ReceiptStudent;
use App\Models\ProcessingFee;
use App\Models\PaymentStudent;
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
     * تجهيز بيانات الترويسة الموحدة لجميع ملفات PDF
     * اسم المدرسة، المديرية، المحافظة، المركز، الشعار (base64)، التواريخ
     */
    private function getHeaderData()
    {
        return [
            'school_name' => $this->getSetting('school_name', 'مدرستي'),
            'directorate' => $this->getSetting('directorate', ''),
            'governorate' => $this->getSetting('governorate', ''),
            'center' => $this->getSetting('center', ''),
            'logo_path' => $this->getLogoPath(),
            'date_gregorian' => Carbon::now()->format('Y-m-d'),
            'date_hijri' => $this->gregorianToHijri(Carbon::now()),
            'developer' => 'أحمد المريش',
        ];
    }

    /**
     * تحويل صورة الشعار إلى base64 data URI لضمان ظهورها داخل ملفات PDF
     */
    private function getLogoPath()
    {
        $paths = [
            public_path('assets/images/logo-dark.png'),
            public_path('assets/images/1.jpg'),
        ];

        foreach ($paths as $path) {
            if (file_exists($path)) {
                $data = file_get_contents($path);
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $mime = $type === 'jpg' || $type === 'jpeg' ? 'image/jpeg' : 'image/png';
                return 'data:' . $mime . ';base64,' . base64_encode($data);
            }
        }

        return '';
    }

    /**
     * كشف أسماء الفصل - قائمة طلاب القسم
     */
    public function classRoster($section_id)
    {
        $section = Section::with(['Grades', 'My_classs'])->findOrFail($section_id);
        $students = Student::where('section_id', $section_id)
            ->with(['gender', 'Nationality'])
            ->orderBy('id')
            ->get();

        $data = array_merge($this->getHeaderData(), [
            'section' => $section,
            'students' => $students,
        ]);

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
        $student = Student::with(['grade', 'classroom', 'section', 'gender', 'Nationality'])
            ->findOrFail($student_id);

        $degrees = Degree::where('student_id', $student_id)
            ->with(['quizze' => function ($q) {
                $q->with('subject');
            }])
            ->get();

        $data = array_merge($this->getHeaderData(), [
            'student' => $student,
            'degrees' => $degrees,
            'total_score' => $degrees->sum('score'),
            'average' => $degrees->count() > 0 ? round($degrees->avg('score'), 2) : 0,
        ]);

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

        $data = array_merge($this->getHeaderData(), [
            'invoice' => $invoice,
        ]);

        $pdf = Pdf::loadView('pages.Pdf.fee_invoice', $data);
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOption('isHtml5ParserEnabled', true);
        $pdf->setOption('isRemoteEnabled', true);

        return $pdf->stream('fee_invoice_' . $invoice_id . '.pdf');
    }

    /**
     * إيصال الدفع (سند قبض)
     */
    public function receipt($receipt_id)
    {
        $receipt = ReceiptStudent::with(['student'])->findOrFail($receipt_id);

        $data = array_merge($this->getHeaderData(), [
            'receipt' => $receipt,
        ]);

        $pdf = Pdf::loadView('pages.Pdf.receipt', $data);
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOption('isHtml5ParserEnabled', true);
        $pdf->setOption('isRemoteEnabled', true);

        return $pdf->stream('receipt_' . $receipt_id . '.pdf');
    }

    /**
     * سند صرف (ProcessingFee)
     */
    public function processingFee($processing_fee_id)
    {
        $processingFee = ProcessingFee::with(['student'])->findOrFail($processing_fee_id);

        $data = array_merge($this->getHeaderData(), [
            'processingFee' => $processingFee,
        ]);

        $pdf = Pdf::loadView('pages.Pdf.processing_fee', $data);
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOption('isHtml5ParserEnabled', true);
        $pdf->setOption('isRemoteEnabled', true);

        return $pdf->stream('processing_fee_' . $processing_fee_id . '.pdf');
    }

    /**
     * سند دفعة (PaymentStudent)
     */
    public function payment($payment_id)
    {
        $payment = PaymentStudent::with(['student'])->findOrFail($payment_id);

        $data = array_merge($this->getHeaderData(), [
            'payment' => $payment,
        ]);

        $pdf = Pdf::loadView('pages.Pdf.payment', $data);
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOption('isHtml5ParserEnabled', true);
        $pdf->setOption('isRemoteEnabled', true);

        return $pdf->stream('payment_' . $payment_id . '.pdf');
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

        // P0-PDF fix: cal_days_in_month() requires PHP's 'calendar' extension which
        // is NOT installed in the Docker image. Use Carbon instead — always available.
        try {
            $daysInMonth = \Carbon\Carbon::createFromDate($year, $month, 1)->daysInMonth;
        } catch (\Throwable $e) {
            // Fallback: manual calculation
            $daysInMonth = (int) date('t', mktime(0, 0, 0, (int)$month, 1, (int)$year));
        }

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

        $data = array_merge($this->getHeaderData(), [
            'matrix' => $matrix,
            'month' => $month,
            'year' => $year,
            'daysInMonth' => $daysInMonth,
            'section' => $section_id ? Section::find($section_id) : null,
        ]);

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
     * مع آلية احتياطية في حال عدم توفر ثوابت Intl
     */
    private function gregorianToHijri($date)
    {
        if (!($date instanceof Carbon)) {
            $date = Carbon::parse($date);
        }

        if (!extension_loaded('intl')) {
            return $this->gregorianToHijriFallback($date);
        }

        // محاولة 1: IntlCalendar::TRADITIONAL_BASE
        try {
            if (defined('IntlCalendar::TRADITIONAL_BASE')) {
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
        } catch (\Throwable $e) {
            // المتابعة إلى المحاولة التالية
        }

        // محاولة 2: IntlDateFormatter::GREGORIAN
        try {
            $formatter = new \IntlDateFormatter(
                'ar-SA@calendar=islamic',
                \IntlDateFormatter::FULL,
                \IntlDateFormatter::NONE,
                'Asia/Riyadh',
                \IntlDateFormatter::GREGORIAN,
                'dd/MM/yyyy'
            );
            return $formatter->format($date->timestamp);
        } catch (\Throwable $e) {
            // المتابعة إلى الاحتياطي الحسابي
        }

        // محاولة 3: الحساب الخوارزمي
        return $this->gregorianToHijriFallback($date);
    }

    /**
     * تحويل هجري احتياطي عبر الخوارزمية (كود Kotlin التاريخي)
     */
    private function gregorianToHijriFallback(Carbon $date)
    {
        $y = (int) $date->format('Y');
        $m = (int) $date->format('m');
        $d = (int) $date->format('d');

        $jd = gregoriantojd($m, $d, $y);

        // تحويل من التقويم اليولياني إلى الهجري
        $l = $jd - 1948440 + 10632;
        $n = (int) (($l - 1) / 10631);
        $l = $l - 10631 * $n + 354;

        $j = (int) ((10985 - $l) / 5316) * (int) ((50 * $l) / 17719)
            + (int) ($l / 5670) * (int) ((43 * $l) / 15238);

        $l = $l - (int) ((30 - $j) / 15) * (int) ((17719 * $j) / 50)
            - (int) ($j / 16) * (int) ((15238 * $j) / 43)
            + 29;

        $hMonth = (int) ((24 * $l) / 709);
        $hDay = $l - (int) ((709 * $hMonth) / 24);
        $hYear = 30 * $n + $j - 30;

        return sprintf('%02d/%02d/%04d', $hDay, $hMonth, $hYear) . ' هـ';
    }
}
