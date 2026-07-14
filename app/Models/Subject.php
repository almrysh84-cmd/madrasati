<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Subject extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['name'];

    protected $fillable = ['name', 'grade_id', 'classroom_id', 'term', 'teacher_id'];


    // جلب اسم المراحل الدراسية

    public function grade()
    {
        return $this->belongsTo('App\Models\Grade', 'grade_id');
    }

    // جلب اسم الصفوف الدراسية
    public function classroom()
    {
        return $this->belongsTo('App\Models\Classroom', 'classroom_id');
    }

    // جلب اسم المعلم
    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher', 'teacher_id');
    }

    // جلب الواجبات المرتبطة بالمادة
    public function homeworks()
    {
        return $this->hasMany('App\Models\Homework', 'subject_id');
    }

    // جلب تقديرات الطلاب المرتبطة بالمادة
    public function studentGrades()
    {
        return $this->hasMany('App\Models\StudentGrade', 'subject_id');
    }
}
