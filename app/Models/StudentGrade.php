<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGrade extends Model
{
    use HasFactory;

    /**
     * P0-9 fix: Mass Assignment — explicit $fillable.
     */
    protected $fillable = [
        'student_id', 'subject_id', 'teacher_id',
        'grade_id', 'classroom_id', 'section_id',
        'evaluation_type', 'score', 'grade_text',
        'term', 'note', 'date',
    ];

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
