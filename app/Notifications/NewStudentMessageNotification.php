<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

/**
 * إشعار برسالة جديدة من طالب للمعلم.
 */
class NewStudentMessageNotification extends Notification
{
    use Queueable;

    protected $studentName;
    protected $subjectName;
    protected $messageBody;
    protected $conversationUrl;

    public function __construct(string $studentName, string $subjectName, string $messageBody, string $conversationUrl)
    {
        $this->studentName      = $studentName;
        $this->subjectName      = $subjectName;
        $this->messageBody      = $messageBody;
        $this->conversationUrl  = $conversationUrl;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'type'    => 'student_message',
            'message' => "رسالة جديدة من الطالب {$this->studentName} (مادة {$this->subjectName})",
            'preview' => mb_substr($this->messageBody, 0, 80),
            'icon'    => 'fas fa-comment-dots',
            'color'   => 'primary',
            'url'     => $this->conversationUrl,
        ];
    }
}
