<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGrade extends Model
{
    use HasFactory;

    protected $guarded = [];

    // جلب الطالب
    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }

    // جلب المادة الدراسية
    public function subject()
    {
        return $this->belongsTo('App\Models\Subject', 'subject_id');
    }

    // جلب المعلم
    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher', 'teacher_id');
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
}
