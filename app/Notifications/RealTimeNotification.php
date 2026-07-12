<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;

/**
 * إشعار في الوقت الفعلي - يُبث عبر Pusher ويُخزن في قاعدة البيانات
 *
 * يستخدم لتحديث عداد الإشعارات في الشريط العلوي بدون إعادة تحميل الصفحة
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class RealTimeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $data;

    /**
     * Create a new notification instance.
     *
     * @param array $data  بيانات الإشعار (title, message, icon, color, url)
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the array representation of the notification (stored in database).
     */
    public function toArray(object $notifiable): array
    {
        return $this->data;
    }

    /**
     * Get the broadcast representation of the notification (real-time via Pusher).
     */
    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'title'   => $this->data['title'] ?? 'إشعار جديد',
            'message' => $this->data['message'] ?? '',
            'icon'    => $this->data['icon'] ?? 'fas fa-bell',
            'color'   => $this->data['color'] ?? 'info',
            'url'     => $this->data['url'] ?? '#',
            'type'    => $this->data['type'] ?? 'general',
        ]);
    }

    /**
     * The broadcast type for this notification.
     */
    public function broadcastType(): string
    {
        return $this->data['type'] ?? 'RealTimeNotification';
    }
}
