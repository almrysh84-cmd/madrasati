<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class PromotionLog extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = [];
    protected $table = 'promotion_logs';

    protected $casts = [
        'reviewed_at' => 'datetime',
        'overall_average' => 'float',
    ];

    /**
     * إعدادات تسجيل النشاطات
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['status', 'overall_average', 'failed_subjects_count', 'review_note'])
            ->logOnlyDirty()
            ->useLogName('promotion_log')
            ->setDescriptionForEvent(fn(string $eventName) => "تم {$eventName} سجل ترقية تلقائية");
    }

    // علاقة مع الطالب
    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }

    // علاقة مع المرحلة الحالية
    public function fromGrade()
    {
        return $this->belongsTo('App\Models\Grade', 'from_grade');
    }

    // علاقة مع المرحلة الجديدة
    public function toGrade()
    {
        return $this->belongsTo('App\Models\Grade', 'to_grade');
    }

    // علاقة مع الصف الحالي
    public function fromClassroom()
    {
        return $this->belongsTo('App\Models\Classroom', 'from_classroom');
    }

    // علاقة مع الصف الجديد
    public function toClassroom()
    {
        return $this->belongsTo('App\Models\Classroom', 'to_classroom');
    }

    // علاقة مع القسم الحالي
    public function fromSection()
    {
        return $this->belongsTo('App\Models\Section', 'from_section');
    }

    // علاقة مع القسم الجديد
    public function toSection()
    {
        return $this->belongsTo('App\Models\Section', 'to_section');
    }

    // علاقة مع المشرف الذي راجع الطلب
    public function reviewer()
    {
        return $this->belongsTo('App\Models\User', 'reviewed_by');
    }

    // علاقة مع المشرف الذي بدأ عملية الترقية
    public function trigger()
    {
        return $this->belongsTo('App\Models\User', 'triggered_by');
    }

    // accessor: نص حالة الترقية بالعربية
    public function getStatusTextAttribute()
    {
        $statuses = [
            'pending'  => 'بانتظار المراجعة',
            'approved' => 'موافق عليه',
            'rejected' => 'مرفوض',
        ];
        return $statuses[$this->status] ?? $this->status;
    }

    // accessor: لون شارة الحالة (Bootstrap)
    public function getStatusColorAttribute()
    {
        $colors = [
            'pending'  => 'warning',
            'approved' => 'success',
            'rejected' => 'danger',
        ];
        return $colors[$this->status] ?? 'secondary';
    }
}
