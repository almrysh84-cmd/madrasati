<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Announcement extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = [];
    protected $table = 'announcements';

    protected $casts = [
        'publish_at'  => 'datetime',
        'is_published' => 'boolean',
    ];

    /**
     * إعدادات تسجيل الأنشطة
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'body', 'target_audience', 'is_published', 'publish_at'])
            ->logOnlyDirty()
            ->useLogName('announcement')
            ->setDescriptionForEvent(fn(string $eventName) => "تم {$eventName} إعلان");
    }

    /**
     * علاقة مع منشئ الإعلان
     */
    public function creator()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    /**
     * Scope: الإعلانات المنشورة فقط
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->where(function ($q) {
                $q->whereNull('publish_at')
                  ->orWhere('publish_at', '<=', now());
            });
    }

    /**
     * Scope: الإعلانات الموجهة لجمهور معين أو للجميع
     */
    public function scopeForAudience($query, $audience)
    {
        return $query->where(function ($q) use ($audience) {
            $q->where('target_audience', $audience)
              ->orWhere('target_audience', 'all');
        });
    }

    /**
     * Accessor: نص الجمهور المستهدف بالعربية
     */
    public function getTargetAudienceTextAttribute()
    {
        $audiences = [
            'admin'    => trans('Announcements_trans.audience_admin'),
            'teachers' => trans('Announcements_trans.audience_teachers'),
            'students' => trans('Announcements_trans.audience_students'),
            'parents'  => trans('Announcements_trans.audience_parents'),
            'all'      => trans('Announcements_trans.audience_all'),
        ];
        return $audiences[$this->target_audience] ?? $this->target_audience;
    }

    /**
     * Accessor: لون شارة الجمهور (Bootstrap)
     */
    public function getTargetAudienceColorAttribute()
    {
        $colors = [
            'admin'    => 'danger',
            'teachers' => 'info',
            'students' => 'success',
            'parents'  => 'primary',
            'all'      => 'secondary',
        ];
        return $colors[$this->target_audience] ?? 'secondary';
    }
}
