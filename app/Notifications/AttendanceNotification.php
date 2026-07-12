<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * إشعار تسجيل الحضور والغياب
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class AttendanceNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $studentName;
    protected $status;
    protected $date;

    /**
     * Create a new notification instance.
     */
    public function __construct($studentName, $status, $date)
    {
        $this->studentName = $studentName;
        $this->status = $status;
        $this->date = $date;
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
        $statusText = $this->status == 1 ? 'حاضر' : 'غائب';

        return [
            'title'   => 'تسجيل الحضور',
            'message' => 'تم تسجيل حالة الحضور للطالب: ' . $this->studentName . ' — ' . $statusText,
            'date'    => $this->date,
            'icon'    => 'fas fa-calendar-check',
            'color'   => $this->status == 1 ? 'success' : 'danger',
            'url'     => '/dashboard',
        ];
    }
}
