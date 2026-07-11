<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ReceiptStudent extends Model
{
    use HasFactory, LogsActivity;

    /**
     * إعدادات تسجيل النشاطات
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['student_id', 'Debit', 'description'])
            ->logOnlyDirty()
            ->useLogName('receipt')
            ->setDescriptionForEvent(fn(string $eventName) => "تم {$eventName} إيصال قبض");
    }
    
    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }
}
