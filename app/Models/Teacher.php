<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Teacher extends Authenticatable
{
    use HasFactory;
    use HasTranslations;
    use Notifiable;
    use LogsActivity;

    public $translatable = ['name'];

    /**
     * P0-9 fix: Mass Assignment — explicit $fillable (password set explicitly via Hash::make()).
     */
    protected $fillable = [
        'name', 'email', 'password',
        'Specialization_id', 'Gender_id', 'Joining_Date', 'Address',
    ];

    /**
     * إعدادات تسجيل النشاطات
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'email', 'Specialization_id', 'Gender_id'])
            ->logOnlyDirty()
            ->useLogName('teacher')
            ->setDescriptionForEvent(fn(string $eventName) => "تم {$eventName} معلم");
    }

    public function getAuthIdentifierName()
    {
        return 'email';
    }

    public function getAuthPasswordName()
    {
        return 'password';
    }

    // علاقة بين المعلمين والتخصصات لجلب اسم التخصص
    public function specializations()
    {
        return $this->belongsTo('App\Models\Specialization', 'Specialization_id');
    }

    // علاقة بين المعلمين والانواع لجلب جنس المعلم
    public function genders()
    {
        return $this->belongsTo('App\Models\Gender', 'Gender_id');
    }

    // علاقة المعلمين مع الاقسام
    public function Sections()
    {
        return $this->belongsToMany('App\Models\Section', 'teacher_section');
    }
}
