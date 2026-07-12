<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Fee_invoice extends Model
{
    use HasFactory, LogsActivity;

    /**
     * إعدادات تسجيل النشاطات
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['amount', 'description', 'student_id', 'Grade_id', 'Classroom_id'])
            ->logOnlyDirty()
            ->useLogName('fee_invoice')
            ->setDescriptionForEvent(fn(string $eventName) => "تم {$eventName} فاتورة رسوم");
    }
    /**
     * P0-9 fix: Mass Assignment — explicit $fillable.
     */
    protected $fillable = [
        'invoice_date', 'student_id', 'Grade_id', 'Classroom_id',
        'fee_id', 'amount', 'description',
    ];

    public function grade()
    {
        return $this->belongsTo('App\Models\Grade', 'Grade_id');
    }


    public function classroom()
    {
        return $this->belongsTo('App\Models\Classroom', 'Classroom_id');
    }


    public function section()
    {
        return $this->belongsTo('App\Models\Section', 'section_id');
    }

    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }

    public function fees()
    {
        return $this->belongsTo('App\Models\Fee', 'fee_id');
    }
}
