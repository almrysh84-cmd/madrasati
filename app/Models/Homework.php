<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Homework extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['title', 'description'];

    protected $guarded = [];

    // جلب المادة الدراسية
    public function subject()
    {
        return $this->belongsTo('App\Models\Subject', 'subject_id');
    }

    // جلب المرحلة الدراسية
    public function grade()
    {
        return $this->belongsTo('App\Models\Grade', 'grade_id');
    }

    // جلب الصف الدراسي
    public function classroom()
    {
        return $this->belongsTo('App\Models\Classroom', 'classroom_id');
    }

    // جلب القسم
    public function section()
    {
        return $this->belongsTo('App\Models\Section', 'section_id');
    }

    // جلب المعلم
    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher', 'teacher_id');
    }

    // جلب اسئلة الواجب (للنوع question)
    public function questions()
    {
        return $this->hasMany('App\Models\HomeworkQuestion', 'homework_id');
    }
}
