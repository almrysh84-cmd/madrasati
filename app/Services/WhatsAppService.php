<?php

namespace App\Services;

use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;

/**
 * خدمة واتساب - تكامل مع Twilio WhatsApp API (Feature 7)
 *
 * توفر واجهة لإرسال رسائل واتساب للأولياء الأمور والطلاب:
 * - إشعار غياب الطالب
 * - إشعار درجة جديدة
 * - إشعار رسوم مستحقة
 * - إرسال جماعي لأحداث المدرسة
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class WhatsAppService
{
    protected $client;
    protected $fromNumber;
    protected $enabled;

    /**
     * Create a new service instance.
     */
    public function __construct()
    {
        $this->enabled = config('services.twilio.enabled', false);
        $this->fromNumber = config('services.twilio.whatsapp_from', 'whatsapp:+14155238886');

        if ($this->enabled) {
            try {
                $this->client = new Client(
                    config('services.twilio.sid'),
                    config('services.twilio.token')
                );
            } catch (\Exception $e) {
                Log::error('WhatsAppService: Twilio client init failed: ' . $e->getMessage());
                $this->enabled = false;
            }
        }
    }

    /**
     * تحديد ما إذا كانت خدمة واتساب مفعّلة
     *
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled && $this->client !== null;
    }

    /**
     * تنسيق رقم الهاتف بصيغة واتساب الدولية
     * يقبل أرقام مثل: 01012345678 أو +201012345678 أو 201012345678
     *
     * @param string $phone
     * @return string
     */
    public function formatPhone(string $phone): string
    {
        // إزالة المسافات والشرطات
        $phone = preg_replace('/[\s\-()]/', '', $phone);

        // إزالة الصفر الأول إذا بدأ بـ 0 (رقم محلي مصري)
        if (strpos($phone, '0') === 0 && strpos($phone, '00') !== 0) {
            $phone = '20' . substr($phone, 1);
        }

        // إضافة + إذا لم تكن موجودة
        if (strpos($phone, '+') !== 0) {
            $phone = '+' . $phone;
        }

        return 'whatsapp:' . $phone;
    }

    /**
     * إرسال رسالة واتساب واحدة
     *
     * @param string $to      رقم المستقبل
     * @param string $message نص الرسالة
     * @return array
     */
    public function send(string $to, string $message): array
    {
        if (!$this->isEnabled()) {
            Log::info('WhatsAppService: Disabled - message not sent to ' . $to);
            return [
                'success' => false,
                'message' => 'خدمة واتساب غير مفعّلة',
                'sid'     => null,
            ];
        }

        try {
            $formattedTo = $this->formatPhone($to);

            $result = $this->client->messages->create($formattedTo, [
                'from' => $this->fromNumber,
                'body' => $message,
            ]);

            Log::info('WhatsAppService: Message sent to ' . $to . ' SID: ' . $result->sid);

            return [
                'success' => true,
                'message' => 'تم إرسال الرسالة بنجاح',
                'sid'     => $result->sid,
            ];
        } catch (\Exception $e) {
            Log::error('WhatsAppService: Send failed to ' . $to . ': ' . $e->getMessage());

            return [
                'success' => false,
                'message' => 'فشل إرسال الرسالة: ' . $e->getMessage(),
                'sid'     => null,
            ];
        }
    }

    /**
     * إرسال إشعار غياب الطالب لولي الأمر
     *
     * @param string $parentPhone   رقم هاتف ولي الأمر
     * @param string $studentName   اسم الطالب
     * @param string $date          تاريخ الغياب
     * @return array
     */
    public function sendAbsenceNotification(string $parentPhone, string $studentName, string $date): array
    {
        $message = "مرحباً،\n\n";
        $message .= "نود إعلامكم بأن الطالب/ة: *{$studentName}*\n";
        $message .= "لم يحضر اليوم بتاريخ: *{$date}*\n\n";
        $message .= "نرجو التواصل مع إدارة المدرسة.\n\n";
        $message .= "— مدرستي";

        return $this->send($parentPhone, $message);
    }

    /**
     * إرسال إشعار درجة جديدة لولي الأمر
     *
     * @param string $parentPhone   رقم هاتف ولي الأمر
     * @param string $studentName   اسم الطالب
     * @param string $subjectName   اسم المادة
     * @param string $grade         الدرجة
     * @return array
     */
    public function sendGradeNotification(string $parentPhone, string $studentName, string $subjectName, string $grade): array
    {
        $message = "مرحباً،\n\n";
        $message .= "تم تسجيل درجة جديدة للطالب/ة: *{$studentName}*\n";
        $message .= "المادة: *{$subjectName}*\n";
        $message .= "الدرجة: *{$grade}*\n\n";
        $message .= "يمكنكم متابعة الدرجات عبر نظام مدرستي.\n\n";
        $message .= "— مدرستي";

        return $this->send($parentPhone, $message);
    }

    /**
     * إرسال إشعار رسوم مستحقة لولي الأمر
     *
     * @param string $parentPhone    رقم هاتف ولي الأمر
     * @param string $studentName    اسم الطالب
     * @param float  $amount         المبلغ المستحق
     * @param string $dueDate        تاريخ الاستحقاق
     * @return array
     */
    public function sendFeeDueNotification(string $parentPhone, string $studentName, float $amount, string $dueDate): array
    {
        $message = "مرحباً،\n\n";
        $message .= "تذكير: يوجد رسوم مستحقة للطالب/ة: *{$studentName}*\n";
        $message .= "المبلغ: *{$amount} ج.م*\n";
        $message .= "تاريخ الاستحقاق: *{$dueDate}*\n\n";
        $message .= "نرجو السداد في الموعد المحدد.\n\n";
        $message .= "— مدرستي";

        return $this->send($parentPhone, $message);
    }

    /**
     * إرسال رسالة جماعية لعدة مستلمين
     *
     * @param array  $recipients  مصفوفة أرقام الهاتف
     * @param string $message     نص الرسالة
     * @return array  نتائج الإرسال لكل رقم
     */
    public function sendBulk(array $recipients, string $message): array
    {
        $results = [];
        $successCount = 0;
        $failCount = 0;

        foreach ($recipients as $phone) {
            $result = $this->send($phone, $message);
            $results[] = [
                'phone'   => $phone,
                'success' => $result['success'],
                'message' => $result['message'],
                'sid'     => $result['sid'],
            ];

            if ($result['success']) {
                $successCount++;
            } else {
                $failCount++;
            }
        }

        return [
            'results'       => $results,
            'total'         => count($recipients),
            'success_count' => $successCount,
            'fail_count'    => $failCount,
        ];
    }

    /**
     * إرسال إشعار حدث مدرسي جماعي
     *
     * @param array  $recipients  مصفوفة أرقام الهاتف
     * @param string $eventTitle  عنوان الحدث
     * @param string $eventBody   تفاصيل الحدث
     * @param string $eventDate   تاريخ الحدث
     * @return array
     */
    public function sendSchoolEvent(array $recipients, string $eventTitle, string $eventBody, string $eventDate): array
    {
        $message = "إعلان مدرسي\n\n";
        $message .= "*{$eventTitle}*\n\n";
        $message .= "{$eventBody}\n\n";
        $message .= "التاريخ: *{$eventDate}*\n\n";
        $message .= "— مدرستي";

        return $this->sendBulk($recipients, $message);
    }
}
