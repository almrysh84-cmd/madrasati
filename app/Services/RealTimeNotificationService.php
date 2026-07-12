<?php

namespace App\Services;

use App\Notifications\RealTimeNotification;
use App\Events\NewGradeEvent;
use App\Events\NewQuizEvent;
use App\Events\NewMessageEvent;
use Illuminate\Support\Facades\Log;

/**
 * خدمة إرسال الإشعارات في الوقت الفعلي
 *
 * تتولى إرسال الإشعارات للمستخدمين عبر الحُرّاس المختلفة (admin, teacher, student, parent)
 * وتُبث الأحداث عبر Pusher لتحديث الواجهة في الوقت الفعلي
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class RealTimeNotificationService
{
    /**
     * خريطة الحُرّاس إلى نماذج العناصر القابلة للإشعار (Notifiable)
     *
     * @var array
     */
    protected $guardModels = [
        'web'     => \App\Models\User::class,
        'teacher' => \App\Models\Teacher::class,
        'student' => \App\Models\Student::class,
        'parent'  => \App\Models\My_Parent::class,
    ];

    /**
     * إرسال إشعار درجة جديدة
     *
     * @param mixed  $notifiable   المستخدم المستهدف (Student/My_Parent)
     * @param string $guardName    اسم الحارس (student/parent)
     * @param array  $data         بيانات الإشعار
     */
    public function notifyNewGrade($notifiable, string $guardName, array $data): void
    {
        try {
            $notifiable->notify(new RealTimeNotification($data));

            $modelType = class_basename(get_class($notifiable));
            broadcast(new NewGradeEvent($modelType, $notifiable->id, $data))->toOthers();
        } catch (\Exception $e) {
            Log::error('RealTime new grade notification failed: ' . $e->getMessage());
        }
    }

    /**
     * إرسال إشعار اختبار جديد
     *
     * @param mixed  $notifiable   المستخدم المستهدف
     * @param string $guardName    اسم الحارس
     * @param array  $data         بيانات الإشعار
     */
    public function notifyNewQuiz($notifiable, string $guardName, array $data): void
    {
        try {
            $notifiable->notify(new RealTimeNotification($data));

            $modelType = class_basename(get_class($notifiable));
            broadcast(new NewQuizEvent($modelType, $notifiable->id, $data))->toOthers();
        } catch (\Exception $e) {
            Log::error('RealTime new quiz notification failed: ' . $e->getMessage());
        }
    }

    /**
     * إرسال إشعار رسالة جديدة
     *
     * @param mixed  $notifiable   المستخدم المستهدف
     * @param string $guardName    اسم الحارس
     * @param array  $data         بيانات الإشعار
     */
    public function notifyNewMessage($notifiable, string $guardName, array $data): void
    {
        try {
            $notifiable->notify(new RealTimeNotification($data));

            $modelType = class_basename(get_class($notifiable));
            broadcast(new NewMessageEvent($modelType, $notifiable->id, $data))->toOthers();
        } catch (\Exception $e) {
            Log::error('RealTime new message notification failed: ' . $e->getMessage());
        }
    }

    /**
     * إرسال إشعار عام في الوقت الفعلي
     *
     * @param mixed  $notifiable   المستخدم المستهدف
     * @param array  $data         بيانات الإشعار
     */
    public function sendGeneral($notifiable, array $data): void
    {
        try {
            $notifiable->notify(new RealTimeNotification($data));

            $modelType = class_basename(get_class($notifiable));
            broadcast(new \App\Events\NewGradeEvent($modelType, $notifiable->id, $data))->toOthers();
        } catch (\Exception $e) {
            Log::error('RealTime general notification failed: ' . $e->getMessage());
        }
    }

    /**
     * إرسال إشعار لعدة مستخدمين (إرسال جماعي)
     *
     * @param iterable $notifiables  قائمة المستخدمين
     * @param array    $data         بيانات الإشعار
     */
    public function sendBulk(iterable $notifiables, array $data): void
    {
        foreach ($notifiables as $notifiable) {
            $this->sendGeneral($notifiable, $data);
        }
    }
}
