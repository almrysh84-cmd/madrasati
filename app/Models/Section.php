<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Section extends Model
{
    use HasTranslations, LogsActivity;

    /**
     * إعدادات تسجيل النشاطات
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['Name_Section', 'Grade_id', 'Class_id', 'Status'])
            ->logOnlyDirty()
            ->useLogName('section')
            ->setDescriptionForEvent(fn(string $eventName) => "تم {$eventName} قسم دراسي");
    }

    public $translatable = ['Name_Section'];
    protected $fillable = ['Name_Section', 'Grade_id', 'Class_id'];

    protected $table = 'sections';
    public $timestamps = true;


    // علاقة بين الاقسام والصفوف لجلب اسم الصف في جدول الاقسام

    public function My_classs()
    {
        return $this->belongsTo('App\Models\Classroom', 'Class_id');
    }

    // علاقة الاقسام مع المعلمين
    public function teachers()
    {
        return $this->belongsToMany('App\Models\Teacher', 'teacher_section');
    }

    public function Grades()
    {
        return $this->belongsTo('App\Models\Grade', 'Grade_id');
    }
}
