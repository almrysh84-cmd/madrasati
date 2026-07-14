<?php

namespace App\Services;

use App\Models\Quizze;
use App\Models\Question;
use App\Models\QuizAttempt;
use App\Models\QuizAnswer;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

/**
 * خدمة الاختبارات الإلكترونية.
 *
 * تتعامل مع:
 * - بدء محاولة اختبار
 * - حفظ الإجابات
 * - التصحيح الآلي
 * - منع الغش
 */
class QuizService
{
    /**
     * بدء محاولة اختبار جديدة (أو استئناف محاولة جارية)
     */
    public function startAttempt(int $quizId, int $studentId): QuizAttempt
    {
        $quiz = Quizze::findOrFail($quizId);
        $student = Student::findOrFail($studentId);

        // التحقق من عدم وجود محاولة جارية
        $existing = QuizAttempt::where('quiz_id', $quizId)
            ->where('student_id', $studentId)
            ->where('status', 'in_progress')
            ->first();

        if ($existing) {
            // استئناف المحاولة الجارية
            if ($existing->isExpired()) {
                $existing->submit();
                // إنشاء محاولة جديدة إذا سُمح
            } else {
                return $existing;
            }
        }

        // التحقق من عدد المحاولات
        $attemptCount = QuizAttempt::where('quiz_id', $quizId)
            ->where('student_id', $studentId)
            ->whereIn('status', ['submitted', 'graded'])
            ->count();

        if ($attemptCount >= $quiz->max_attempts) {
            throw new \Exception('لقد استنفدت جميع المحاولات المسموحة لهذا الاختبار');
        }

        // التحقق من توفّر الاختبار
        if ($quiz->available_from && now()->lt($quiz->available_from)) {
            throw new \Exception('الاختبار غير متاح بعد');
        }
        if ($quiz->available_to && now()->gt($quiz->available_to)) {
            throw new \Exception('انتهت فترة توفر الاختبار');
        }

        return QuizAttempt::create([
            'quiz_id'        => $quizId,
            'student_id'     => $studentId,
            'started_at'     => now(),
            'status'         => 'in_progress',
            'attempt_number' => $attemptCount + 1,
            'max_score'      => $quiz->questions()->sum('score'),
        ]);
    }

    /**
     * حفظ إجابة سؤال
     */
    public function saveAnswer(int $attemptId, int $questionId, $answer): QuizAnswer
    {
        $attempt = QuizAttempt::findOrFail($attemptId);

        if (!$attempt->isInProgress()) {
            throw new \Exception('انتهت المحاولة');
        }

        $question = Question::findOrFail($questionId);

        // إنشاء أو تحديث الإجابة
        $quizAnswer = QuizAnswer::firstOrNew([
            'quiz_attempt_id' => $attemptId,
            'question_id'     => $questionId,
        ]);

        $quizAnswer->student_answer = is_array($answer) ? $answer : ['value' => $answer];
        $quizAnswer->answered_at = now();

        // تصحيح آلي للأسئلة الموضوعية
        if (in_array($question->question_type, ['mcq_single', 'true_false', 'fill_blank'])) {
            $isCorrect = $this->checkAnswer($question, $answer);
            $quizAnswer->is_correct = $isCorrect;
            $quizAnswer->score_awarded = $isCorrect ? $question->score : 0;
        }
        // الأسئلة المقالية والاختيار المتعدد تحتاج تصحيح يدوي
        else {
            $quizAnswer->is_correct = null;
            $quizAnswer->score_awarded = 0;
        }

        $quizAnswer->save();

        return $quizAnswer;
    }

    /**
     * تصحيح إجابة سؤال موضوعي
     */
    private function checkAnswer(Question $question, $answer): bool
    {
        $correctAnswer = $question->right_answer;

        if ($question->question_type === 'mcq_single' || $question->question_type === 'true_false') {
            return trim(strtolower($answer)) === trim(strtolower($correctAnswer));
        }

        if ($question->question_type === 'fill_blank') {
            // دعم إجابات متعددة صحيحة (مفصولة بـ |)
            $correctOptions = explode('|', $correctAnswer);
            foreach ($correctOptions as $option) {
                if (trim(strtolower($answer)) === trim(strtolower($option))) {
                    return true;
                }
            }
            return false;
        }

        return false;
    }

    /**
     * تسليم المحاولة وحساب النتيجة
     */
    public function submitAttempt(int $attemptId): QuizAttempt
    {
        $attempt = QuizAttempt::findOrFail($attemptId);

        if (!$attempt->isInProgress()) {
            throw new \Exception('المحاولة منتهية بالفعل');
        }

        DB::transaction(function () use ($attempt) {
            // تصحيح الإجابات غير المصححة
            $ungraded = $attempt->answers()->whereNull('is_correct')->get();
            foreach ($ungraded as $answer) {
                if (in_array($answer->question->question_type, ['mcq_single', 'true_false', 'fill_blank'])) {
                    $isCorrect = $this->checkAnswer($answer->question, $answer->student_answer['value'] ?? '');
                    $answer->update([
                        'is_correct'     => $isCorrect,
                        'score_awarded'  => $isCorrect ? $answer->question->score : 0,
                    ]);
                }
            }

            $attempt->submit();
        });

        return $attempt->fresh();
    }

    /**
     * تسجيل تبديل التبويب (مضاد الغش)
     */
    public function recordTabSwitch(int $attemptId): void
    {
        QuizAttempt::where('id', $attemptId)->increment('tab_switches');
    }

    /**
     * الحصول على أسئلة الاختبار (مع ترتيب عشوائي إذا مفعّل)
     */
    public function getQuestionsForAttempt(QuizAttempt $attempt)
    {
        $query = $attempt->quiz->questions();

        if ($attempt->quiz->shuffle_questions) {
            $query->inRandomOrder();
        }

        return $query->get();
    }
}
