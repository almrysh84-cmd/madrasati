<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * إجابة طالب على سؤال محدد في محاولة اختبار.
 */
class QuizAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_attempt_id', 'question_id', 'student_answer',
        'is_correct', 'score_awarded', 'teacher_feedback', 'answered_at',
    ];

    protected $casts = [
        'student_answer'    => 'array',
        'is_correct'        => 'boolean',
        'score_awarded'     => 'decimal:2',
        'answered_at'       => 'datetime',
    ];

    /**
     * علاقة مع المحاولة
     */
    public function attempt(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(QuizAttempt::class, 'quiz_attempt_id');
    }

    /**
     * علاقة مع السؤال
     */
    public function question(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
