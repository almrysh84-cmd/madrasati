<?php

namespace App\Notifications;

use App\Models\Homework;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class HomeworkCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $homework;

    public function __construct(Homework $homework)
    {
        $this->homework = $homework;
    }

    /**
     * قنوات التسليم: قاعدة البيانات (تظهر في لوحة الإشعارات)
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * تمثيل الإشعار في قاعدة البيانات
     */
    public function toArray($notifiable)
    {
        $subjectName = $this->homework->subject
            ? $this->homework->subject->getTranslation('name', 'ar')
            : 'غير محدد';

        $teacherName = $this->homework->teacher
            ? $this->homework->teacher->getTranslation('name', 'ar')
            : 'غير محدد';

        return [
            'type'           => 'homework',
            'homework_id'    => $this->homework->id,
            'title'          => $this->homework->getTranslation('title', 'ar'),
            'subject'        => $subjectName,
            'teacher'        => $teacherName,
            'due_date'       => $this->homework->due_date,
            'score'          => $this->homework->score,
            'message'        => "واجب جديد في مادة {$subjectName} من المعلم {$teacherName}",
            'url'            => '/en/my_homework/' . $this->homework->id,
        ];
    }
}
