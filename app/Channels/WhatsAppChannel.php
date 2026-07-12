<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use App\Services\WhatsAppService;
use Illuminate\Support\Facades\Log;

/**
 * قناة إشعار واتساب المخصصة (Feature 7)
 *
 * تسمح لـ Laravel Notifications بإرسال الإشعارات عبر واتساب باستخدام Twilio
 * يتم تفعيلها تلقائياً عند وجود دالة toWhatsapp() في فئة الإشعار
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class WhatsAppChannel
{
    protected $whatsapp;

    /**
     * Create a new channel instance.
     */
    public function __construct(WhatsAppService $whatsapp)
    {
        $this->whatsapp = $whatsapp;
    }

    /**
     * إرسال الإشعار عبر واتساب
     *
     * @param mixed         $notifiable
     * @param Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification): void
    {
        if (!method_exists($notification, 'toWhatsapp')) {
            return;
        }

        try {
            $notification->toWhatsapp($notifiable, $this->whatsapp);
        } catch (\Exception $e) {
            Log::error('WhatsAppChannel: Send failed: ' . $e->getMessage());
        }
    }
}
