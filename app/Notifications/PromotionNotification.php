<?php

namespace App\Notifications;

use App\Models\PromotionLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PromotionNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $log;
    protected $type;

    /**
     * Create a new notification instance.
     *
     * @param PromotionLog $log
     * @param string $type  approved|rejected
     */
    public function __construct(PromotionLog $log, $type = 'approved')
    {
        $this->log = $log;
        $this->type = $type;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $student = $this->log->student;
        $studentName = $student ? $student->name : '';

        if ($this->type === 'approved') {
            $fromGrade = $this->log->fromGrade ? $this->log->fromGrade->getTranslation('Name', 'ar') : '';
            $toGrade = $this->log->toGrade ? $this->log->toGrade->getTranslation('Name', 'ar') : '';

            return (new MailMessage())
                ->subject('إشعار ترقية الطالب')
                ->greeting('عزيزي ولي الأمر،')
                ->line('تمت الموافقة على ترقية الطالب/ة: ' . $studentName)
                ->line('من المرحلة: ' . $fromGrade)
                ->line('إلى المرحلة: ' . $toGrade)
                ->line('المتوسط العام: ' . $this->log->overall_average)
                ->line('السنة الدراسية الجديدة: ' . $this->log->academic_year_new)
                ->action('عرض التفاصيل', url('/'))
                ->line('شكراً لاستخدامكم نظام مدرستي.');
        }

        return (new MailMessage())
            ->subject('إشعار رفض الترقية')
            ->greeting('عزيزي ولي الأمر،')
            ->line('تم رفض ترقية الطالب/ة: ' . $studentName)
            ->line('ملاحظة المراجعة: ' . ($this->log->review_note ?? 'لا توجد ملاحظات'))
            ->line('شكراً لاستخدامكم نظام مدرستي.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $student = $this->log->student;
        $studentName = $student ? $student->name : '';

        if ($this->type === 'approved') {
            $fromGrade = $this->log->fromGrade ? $this->log->fromGrade->getTranslation('Name', 'ar') : '';
            $toGrade = $this->log->toGrade ? $this->log->toGrade->getTranslation('Name', 'ar') : '';

            return [
                'title'       => 'تمت الموافقة على ترقية الطالب',
                'body'        => 'تمت الموافقة على ترقية ' . $studentName . ' من ' . $fromGrade . ' إلى ' . $toGrade,
                'type'        => 'promotion_approved',
                'student_id'  => $this->log->student_id,
                'log_id'      => $this->log->id,
                'icon'        => 'ti-arrow-up-circle',
                'color'       => 'success',
                'url'         => route('auto_promotion.logs'),
            ];
        }

        return [
            'title'       => 'تم رفض ترقية الطالب',
            'body'        => 'تم رفض ترقية ' . $studentName . '. ملاحظة: ' . ($this->log->review_note ?? ''),
            'type'        => 'promotion_rejected',
            'student_id'  => $this->log->student_id,
            'log_id'      => $this->log->id,
            'icon'        => 'ti-close',
            'color'       => 'danger',
            'url'         => route('auto_promotion.logs'),
        ];
    }
}
