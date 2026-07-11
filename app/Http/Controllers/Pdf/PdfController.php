<?php

namespace App\Http\Controllers\Pdf;

use App\Http\Controllers\Controller;
use App\Repository\PdfRepositoryInterface;
use Illuminate\Http\Request;

/**
 * متحكم طباعة التقارير PDF
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class PdfController extends Controller
{
    protected $pdfRepository;

    public function __construct(PdfRepositoryInterface $pdfRepository)
    {
        $this->pdfRepository = $pdfRepository;
    }

    /**
     * كشف أسماء الفصل
     */
    public function classRoster($section_id)
    {
        return $this->pdfRepository->classRoster($section_id);
    }

    /**
     * النتائج النهائية للطالب
     */
    public function finalResults($student_id)
    {
        return $this->pdfRepository->finalResults($student_id);
    }

    /**
     * فاتورة الرسوم
     */
    public function feeInvoice($invoice_id)
    {
        return $this->pdfRepository->feeInvoice($invoice_id);
    }

    /**
     * إيصال الدفع
     */
    public function receipt($receipt_id)
    {
        return $this->pdfRepository->receipt($receipt_id);
    }

    /**
     * مصفوفة الحضور الشهري
     */
    public function attendanceMatrix(Request $request)
    {
        return $this->pdfRepository->attendanceMatrix($request);
    }
}
