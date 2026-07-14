<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'question_type', 'answers', 'right_answer',
        'options_json', 'correct_answers_json', 'explanation',
        'media_path', 'media_type', 'difficulty', 'score', 'quizze_id',
    ];

    protected $casts = [
        'options_json'         => 'array',
        'correct_answers_json' => 'array',
    ];

    public function quizze()
    {
        return $this->belongsTo('App\Models\Quizze');
    }
}
