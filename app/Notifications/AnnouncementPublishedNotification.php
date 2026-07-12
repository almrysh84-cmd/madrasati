<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

/**
 * إشعار بنشر إعلان جديد.
 * يُحفظ في قاعدة البيانات ويظهر في الـ bell dropdown للطالب/المعلم/ولي الأمر.
 *
 * ملاحظة: لا نستخدم ShouldQueue لأنه لا يوجد queue worker على Railway.
 */
class AnnouncementPublishedNotification extends Notification
{
    use Queueable;

    protected $title;
    protected $audience;
    protected $creatorName;

    public function __construct(string $title, string $audience, string $creatorName)
    {
        $this->title       = $title;
        $this->audience    = $audience;
        $this->creatorName = $creatorName;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'type'    => 'announcement',
            'title'   => $this->title,
            'message' => "إعلان جديد من {$this->creatorName}: {$this->title} ({$this->audience})",
            'icon'    => 'fas fa-bullhorn',
            'color'   => 'info',
            'url'     => '/en/student/announcements',
        ];
    }
}
