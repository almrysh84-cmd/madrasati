<?php

namespace App\Repository;

/**
 * واجهة مستودع طباعة التقارير PDF
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
interface PdfRepositoryInterface
{
    // كشف أسماء الفصل (Class Roster)
    public function classRoster($section_id);

    // النتائج النهائية للطالب
    public function finalResults($student_id);

    // فاتورة الرسوم
    public function feeInvoice($invoice_id);

    // إيصال الدفع (سند قبض)
    public function receipt($receipt_id);

    // سند صرف
    public function processingFee($processing_fee_id);

    // سند دفعة
    public function payment($payment_id);

    // مصفوفة الحضور الشهري
    public function attendanceMatrix($request);
}
