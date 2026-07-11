<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * إشعار نشر اختبار جديد
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class QuizPublishedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $quizName;
    protected $subjectName;
    protected $gradeName;

    /**
     * Create a new notification instance.
     */
    public function __construct($quizName, $subjectName = null, $gradeName = null)
    {
        $this->quizName = $quizName;
        $this->subjectName = $subjectName;
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
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title'   => 'اختبار جديد',
            'message' => 'تم نشر اختبار جديد: ' . $this->quizName,
            'subject' => $this->subjectName,
            'grade'   => $this->gradeName,
            'icon'    => 'fas fa-clipboard-list',
            'color'   => 'info',
            'url'     => '/dashboard',
        ];
    }
}
