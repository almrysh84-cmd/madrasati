<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

/**
 * إشعار برسالة جديدة لولي الأمر أو المعلم.
 * يُحفظ في قاعدة البيانات ويظهر في الـ bell dropdown.
 */
class NewMessageNotification extends Notification
{
    use Queueable;

    protected $senderName;
    protected $messageBody;
    protected $studentName;
    protected $conversationUrl;

    public function __construct(string $senderName, string $messageBody, ?string $studentName, string $conversationUrl)
    {
        $this->senderName      = $senderName;
        $this->messageBody     = $messageBody;
        $this->studentName     = $studentName;
        $this->conversationUrl = $conversationUrl;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        $msg = "رسالة جديدة من {$this->senderName}";
        if ($this->studentName) {
            $msg .= " (بخصوص ابنك {$this->studentName})";
        }

        return [
            'type'    => 'message',
            'message' => $msg,
            'preview' => mb_substr($this->messageBody, 0, 80),
            'icon'    => 'fas fa-comment-dots',
            'color'   => 'primary',
            'url'     => $this->conversationUrl,
        ];
    }
}
