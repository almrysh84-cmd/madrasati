<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Quizze extends Model
{
    use HasFactory;
    use HasTranslations;
    use LogsActivity;

    /**
     * إعدادات تسجيل النشاطات
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'subject_id', 'grade_id', 'classroom_id', 'section_id'])
            ->logOnlyDirty()
            ->useLogName('quiz')
            ->setDescriptionForEvent(fn(string $eventName) => "تم {$eventName} اختبار");
    }
    public $translatable = ['name'];

    protected $fillable = [
        'name', 'subject_id', 'grade_id', 'classroom_id', 'section_id',
        'teacher_id', 'duration_minutes', 'passing_score', 'max_attempts',
        'shuffle_questions', 'shuffle_options', 'show_results_immediately',
        'anti_cheat', 'available_from', 'available_to', 'term',
    ];

    protected $casts = [
        'duration_minutes'         => 'integer',
        'passing_score'            => 'decimal:2',
        'max_attempts'             => 'integer',
        'shuffle_questions'        => 'boolean',
        'shuffle_options'          => 'boolean',
        'show_results_immediately' => 'boolean',
        'anti_cheat'               => 'boolean',
        'available_from'           => 'datetime',
        'available_to'             => 'datetime',
    ];

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher', 'teacher_id');
    }



    public function subject()
    {
        return $this->belongsTo('App\Models\Subject', 'subject_id');
    }


    public function grade()
    {
        return $this->belongsTo('App\Models\Grade', 'grade_id');
    }


    public function classroom()
    {
        return $this->belongsTo('App\Models\Classroom', 'classroom_id');
    }


    public function section()
    {
        return $this->belongsTo('App\Models\Section', 'section_id');
    }

    public function degree()
    {
        return $this->hasMany('App\Models\Degree');
    }

    public function questions()
    {
        return $this->hasMany('App\Models\Question');
    }
}
