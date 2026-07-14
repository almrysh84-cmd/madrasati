<?php

namespace App\Services;

use App\Models\Fee_invoice;
use App\Models\ReceiptStudent;
use App\Models\Student;
use App\Models\StudentAccount;
use App\Models\FundAccount;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\PaymentIntent;

/**
 * خدمة المدفوعات الإلكترونية واليدوية.
 *
 * تدعم:
 * - الدفع الإلكتروني عبر Stripe (بطاقات، Apple Pay)
 * - الدفع اليدوي (نقدي، تحويل بنكي) مع رفع إيصال
 * - إنشاء فواتير تلقائي
 * - تذكير بالرسوم المتأخرة
 */
class PaymentService
{
    public function __construct()
    {
        if (config('services.stripe.secret')) {
            Stripe::setApiKey(config('services.stripe.secret'));
        }
    }

    /**
     * إنشاء PaymentIntent لـ Stripe
     */
    public function createStripePayment(float $amount, int $invoiceId, string $description = ''): array
    {
        try {
            $intent = PaymentIntent::create([
                'amount'   => (int)($amount * 100), // Stripe يتعامل بالسنتات
                'currency' => 'sar', // أو 'usd' حسب العملة
                'metadata' => [
                    'invoice_id' => $invoiceId,
                    'type'       => 'school_fee',
                ],
                'description' => $description ?: "دفعة رسوم دراسية - فاتورة #$invoiceId",
            ]);

            return [
                'success'        => true,
                'client_secret'  => $intent->client_secret,
                'payment_intent' => $intent->id,
            ];
        } catch (\Exception $e) {
            Log::error('Stripe PaymentIntent error: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * تسجيل دفعة يدوية (نقدي/تحويل بنكي)
     */
    public function recordManualPayment(int $invoiceId, float $amount, string $method, ?string $receiptNumber = null): array
    {
        DB::beginTransaction();
        try {
            $invoice = Fee_invoice::findOrFail($invoiceId);

            // إنشاء سند قبض
            $receipt = ReceiptStudent::create([
                'date'         => date('Y-m-d'),
                'student_id'   => $invoice->student_id,
                'Debit'        => $amount,
                'credit'       => 0.00,
                'description'  => "دفعة يدوية - {$method}" . ($receiptNumber ? " - إيصال: {$receiptNumber}" : ''),
            ]);

            // تحديث حساب الطالب
            StudentAccount::create([
                'date'           => date('Y-m-d'),
                'type'           => 'receipt',
                'receipt_id'     => $receipt->id,
                'student_id'     => $invoice->student_id,
                'Debit'          => 0.00,
                'credit'         => $amount,
                'description'    => "سند قبض - {$method}",
            ]);

            // تحديث صندوق المدرسة
            FundAccount::create([
                'date'           => date('Y-m-d'),
                'receipt_id'     => $receipt->id,
                'Debit'          => $amount,
                'credit'         => 0.00,
                'description'    => "إيراد رسوم دراسية - {$method}",
            ]);

            DB::commit();

            return [
                'success'  => true,
                'receipt'  => $receipt,
                'message'  => 'تم تسجيل الدفعة بنجاح',
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Manual payment error: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'حدث خطأ أثناء تسجيل الدفعة',
            ];
        }
    }

    /**
     * تأكيد دفعة Stripe (webhook)
     */
    public function confirmStripePayment(string $paymentIntentId): bool
    {
        try {
            $intent = PaymentIntent::retrieve($paymentIntentId);

            if ($intent->status === 'succeeded') {
                $invoiceId = $intent->metadata->invoice_id ?? null;
                if ($invoiceId) {
                    $result = $this->recordManualPayment(
                        $invoiceId,
                        $intent->amount / 100,
                        'بطاقة بنكية (Stripe)'
                    );
                    return $result['success'];
                }
            }
            return false;
        } catch (\Exception $e) {
            Log::error('Stripe confirm error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * الرسوم المتأخرة لطالب محدد
     */
    public function getPendingFees(int $studentId): array
    {
        $invoices = Fee_invoice::where('student_id', $studentId)->get();
        $receipts = ReceiptStudent::where('student_id', $studentId)->sum('Debit');

        $totalInvoiced = $invoices->sum('amount');
        $totalPaid = $receipts;
        $pending = max($totalInvoiced - $totalPaid, 0);

        return [
            'total_invoiced' => $totalInvoiced,
            'total_paid'     => $totalPaid,
            'pending'        => $pending,
            'invoices'       => $invoices,
        ];
    }

    /**
     * كل الرسوم المتأخرة (للمدرسة كلها)
     */
    public function getAllPendingFees(): array
    {
        $totalInvoiced = Fee_invoice::sum('amount');
        $totalCollected = ReceiptStudent::sum('Debit');
        $pending = max($totalInvoiced - $totalCollected, 0);

        return [
            'total_invoiced'  => $totalInvoiced,
            'total_collected' => $totalCollected,
            'pending'         => $pending,
            'collection_rate' => $totalInvoiced > 0 ? round(($totalCollected / $totalInvoiced) * 100, 2) : 0,
        ];
    }

    /**
     * إنشاء فواتير تلقائي لكل طلاب صف محدد
     */
    public function generateInvoicesForClass(int $classroomId, float $amount, string $description): int
    {
        $students = Student::where('Classroom_id', $classroomId)->get();
        $created = 0;

        DB::beginTransaction();
        try {
            foreach ($students as $student) {
                // التحقق من عدم وجود فاتورة مكررة
                $exists = Fee_invoice::where('student_id', $student->id)
                    ->where('description', $description)
                    ->exists();

                if (!$exists) {
                    Fee_invoice::create([
                        'invoice_date'  => date('Y-m-d'),
                        'student_id'    => $student->id,
                        'Grade_id'      => $student->Grade_id,
                        'Classroom_id'  => $student->Classroom_id,
                        'fee_id'        => 1, // fee type
                        'amount'        => $amount,
                        'description'   => $description,
                    ]);
                    $created++;
                }
            }

            DB::commit();
            return $created;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Invoice generation error: ' . $e->getMessage());
            return 0;
        }
    }
}
