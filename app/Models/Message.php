<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    /**
     * علاقة مع الطالب (الذي تدور حوله المحادثة)
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    /**
     * المُرسِل — نُرجِع النموذج المناسب حسب النوع
     */
    public function sender()
    {
        if ($this->sender_type === 'parent') {
            return $this->belongsTo(My_Parent::class, 'sender_id');
        }
        return $this->belongsTo(Teacher::class, 'sender_id');
    }

    /**
     * المُستقبِل — نُرجِع النموذج المناسب حسب النوع
     */
    public function receiver()
    {
        if ($this->receiver_type === 'parent') {
            return $this->belongsTo(My_Parent::class, 'receiver_id');
        }
        return $this->belongsTo(Teacher::class, 'receiver_id');
    }

    /**
     * Scope: الرسائل غير المقروءة
     */
    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }
}
