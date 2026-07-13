<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

/**
 * إشعار لولي الأمر بغياب ابنه.
 */
class StudentAbsentNotification extends Notification
{
    use Queueable;

    protected $studentName;
    protected $date;
    protected $subjectName;

    public function __construct(string $studentName, string $date, ?string $subjectName = null)
    {
        $this->studentName = $studentName;
        $this->date        = $date;
        $this->subjectName = $subjectName;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        $msg = "غاب ابنك {$this->studentName} يوم {$this->date}";
        if ($this->subjectName) {
            $msg .= " عن مادة {$this->subjectName}";
        }

        return [
            'type'    => 'attendance',
            'message' => $msg,
            'icon'    => 'fas fa-user-times',
            'color'   => 'danger',
            'url'     => '/en/attendances',
        ];
    }
}
