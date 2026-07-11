<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * إشعار إنشاء فاتورة رسوم
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class FeeInvoiceNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $studentName;
    protected $amount;
    protected $feeType;

    /**
     * Create a new notification instance.
     */
    public function __construct($studentName, $amount, $feeType = null)
    {
        $this->studentName = $studentName;
        $this->amount = $amount;
        $this->feeType = $feeType;
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
            'title'   => 'فاتورة رسوم',
            'message' => 'تم إنشاء فاتورة رسوم للطالب: ' . $this->studentName . ' بمبلغ: ' . $this->amount,
            'feeType' => $this->feeType,
            'icon'    => 'fas fa-file-invoice-dollar',
            'color'   => 'warning',
            'url'     => '/dashboard',
        ];
    }
}
