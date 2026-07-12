<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Services\WhatsAppService;

/**
 * إشعار واتساب - يُرسل عبر Twilio WhatsApp API (Feature 7)
 *
 * يعمل كقناة إشعار مخصصة يمكن استخدامها مع نظام إشعارات Laravel
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class WhatsAppNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $message;
    protected $type;

    /**
     * Create a new notification instance.
     *
     * @param string $message  نص رسالة واتساب
     * @param string $type     نوع الإشعار (absence, grade, fee, event)
     */
    public function __construct(string $message, string $type = 'general')
    {
        $this->message = $message;
        $this->type = $type;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['whatsapp'];
    }

    /**
     * إرسال الإشعار عبر قناة واتساب المخصصة
     *
     * @param mixed  $notifiable
     * @param WhatsAppService $whatsapp
     * @return void
     */
    public function toWhatsapp(object $notifiable, WhatsAppService $whatsapp): void
    {
        $phone = $this->getNotifiablePhone($notifiable);

        if ($phone) {
            $whatsapp->send($phone, $this->message);
        }
    }

    /**
     * الحصول على رقم هاتف المستخدم المستهدف
     *
     * @param mixed $notifiable
     * @return string|null
     */
    protected function getNotifiablePhone($notifiable): ?string
    {
        // محاولة الحصول على رقم الهاتف من النموذج
        if (method_exists($notifiable, 'routeNotificationForWhatsapp')) {
            return $notifiable->routeNotificationForWhatsapp();
        }

        // أرقام الهاتف الشائعة في النماذج
        $phoneFields = ['phone', 'Phone', 'phone_number', 'parent_phone', 'Father_Phone', 'mother_phone'];
        foreach ($phoneFields as $field) {
            if (isset($notifiable->{$field}) && $notifiable->{$field}) {
                return $notifiable->{$field};
            }
        }

        return null;
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'type'    => $this->type,
            'message' => $this->message,
            'channel' => 'whatsapp',
        ];
    }
}
