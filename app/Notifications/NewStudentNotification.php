<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * إشعار إضافة طالب جديد
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class NewStudentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $studentName;
    protected $gradeName;

    /**
     * Create a new notification instance.
     */
    public function __construct($studentName, $gradeName = null)
    {
        $this->studentName = $studentName;
        $this->gradeName = $gradeName;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification (stored in database).
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title'   => 'طالب جديد',
            'message' => 'تم إضافة طالب جديد: ' . $this->studentName,
            'grade'   => $this->gradeName,
            'icon'    => 'fas fa-user-plus',
            'color'   => 'success',
            'url'     => '/dashboard',
        ];
    }
}
