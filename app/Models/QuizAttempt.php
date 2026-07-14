<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * محاولة طالب لأداء اختبار.
 *
 * تتتبع: وقت البدء، وقت التسليم، الدرجة، حالة التصحيح،
 * عدد تبديلات التبويب (مضاد الغش).
 */
class QuizAttempt extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'quiz_id', 'student_id', 'started_at', 'submitted_at',
        'duration_seconds', 'score', 'max_score', 'percentage',
        'status', 'passed', 'attempt_number', 'meta', 'tab_switches',
    ];

    protected $casts = [
        'started_at'    => 'datetime',
        'submitted_at'  => 'datetime',
        'meta'          => 'array',
        'score'         => 'decimal:2',
        'max_score'     => 'decimal:2',
        'percentage'    => 'decimal:2',
        'passed'        => 'boolean',
    ];

    /**
     * علاقة مع الاختبار
     */
    public function quiz(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Quizze::class, 'quiz_id');
    }

    /**
     * علاقة مع الطالب
     */
    public function student(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * علاقة مع الإجابات
     */
    public function answers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(QuizAnswer::class);
    }

    /**
     * هل المحاولة لا تزال جارية؟
     */
    public function isInProgress(): bool
    {
        return $this->status === 'in_progress';
    }

    /**
     * هل انتهى الوقت المسموح؟
     */
    public function isExpired(): bool
    {
        if (!$this->quiz->duration_minutes) return false;
        $deadline = $this->started_at->addMinutes($this->quiz->duration_minutes);
        return now()->isAfter($deadline);
    }

    /**
     * الوقت المتبقي بالثواني
     */
    public function remainingSeconds(): int
    {
        if (!$this->quiz->duration_minutes) return -1;
        $deadline = $this->started_at->addMinutes($this->quiz->duration_minutes);
        return max(0, now()->diffInSeconds($deadline));
    }

    /**
     * تسليم المحاولة وحساب الدرجة
     */
    public function submit(): void
    {
        $this->update([
            'submitted_at'      => now(),
            'duration_seconds'  => $this->started_at->diffInSeconds(now()),
            'status'            => 'graded',
        ]);

        // حساب الدرجة من الإجابات
        $totalScore = $this->answers()->sum('score_awarded');
        $maxScore = $this->quiz->questions()->sum('score');

        $this->update([
            'score'      => $totalScore,
            'max_score'  => $maxScore,
            'percentage' => $maxScore > 0 ? ($totalScore / $maxScore) * 100 : 0,
            'passed'     => $maxScore > 0 && ($totalScore / $maxScore) * 100 >= $this->quiz->passing_score,
        ]);
    }
}
