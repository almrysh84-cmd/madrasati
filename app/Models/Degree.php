<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    use HasFactory;

    /**
     * P0-9 fix: Mass Assignment — explicit $fillable.
     */
    protected $fillable = [
        'quizze_id', 'student_id', 'question_id',
        'score', 'abuse', 'date', 'note',
    ];
    public $timestamps = true;

    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }

    public function quizze()
    {
        return $this->belongsTo('App\Models\Quizze', 'quizze_id');
    }
}
