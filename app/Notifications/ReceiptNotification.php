<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * إشعار تسجيل سند قبض
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class ReceiptNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $studentName;
    protected $amount;

    /**
     * Create a new notification instance.
     */
    public function __construct($studentName, $amount)
    {
        $this->studentName = $studentName;
        $this->amount = $amount;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title'   => 'سند قبض',
            'message' => 'تم تسجيل سند قبض للطالب: ' . $this->studentName . ' بمبلغ: ' . $this->amount,
            'icon'    => 'fas fa-money-bill-wave',
            'color'   => 'success',
            'url'     => '/dashboard',
        ];
    }
}
