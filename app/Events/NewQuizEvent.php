<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * حدث إشعار اختبار جديد - يُبث في الوقت الفعلي عبر Pusher
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class NewQuizEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $notifiableType;
    public $notifiableId;
    public $data;

    /**
     * Create a new event instance.
     *
     * @param string $notifiableType  نوع المستخدم (Student, My_Parent, Teacher, User)
     * @param int    $notifiableId    معرف المستخدم
     * @param array  $data            بيانات الإشعار
     */
    public function __construct(string $notifiableType, int $notifiableId, array $data)
    {
        $this->notifiableType = $notifiableType;
        $this->notifiableId = $notifiableId;
        $this->data = $data;
    }

    /**
     * Get the channels the event should broadcast on.
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('App.Models.' . $this->notifiableType . '.' . $this->notifiableId),
        ];
    }

    /**
     * The event's broadcast name.
     */
    public function broadcastAs(): string
    {
        return 'NewQuiz';
    }

    /**
     * Get the data to broadcast.
     */
    public function broadcastWith(): array
    {
        return $this->data;
    }
}
