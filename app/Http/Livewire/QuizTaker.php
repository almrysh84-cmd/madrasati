<?php

namespace App\Http\Livewire;

use App\Models\Quizze;
use App\Models\Question;
use App\Models\QuizAttempt;
use App\Services\QuizService;
use Livewire\Component;

class QuizTaker extends Component
{
    public $quizId;
    public $quiz;
    public $attempt;
    public $questions;
    public $currentQuestionIndex = 0;
    public $answers = []; // [question_id => answer_value]
    public $started = false;
    public $finished = false;
    public $result = null;
    public $remainingSeconds = 0;
    public $tabSwitches = 0;

    // للأسئلة متعددة الخيارات
    public $selectedOptions = []; // [question_id => [option_index, ...]]

    protected $rules = [];

    public function mount($quizId)
    {
        $this->quizId = $quizId;
        $this->quiz = Quizze::with('questions')->findOrFail($quizId);
    }

    public function startQuiz()
    {
        $service = app(QuizService::class);

        try {
            $this->attempt = $service->startAttempt($this->quizId, auth()->user()->id);
            $this->questions = $service->getQuestionsForAttempt($this->attempt);
            $this->started = true;
            $this->remainingSeconds = $this->attempt->remainingSeconds();

            // إرسال حدث لبدء المؤقت في JS
            $this->dispatchBrowserEvent('quiz-started', ['seconds' => $this->remainingSeconds]);
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
        }
    }

    public function nextQuestion()
    {
        // حفظ إجابة السؤال الحالي
        $this->saveCurrentAnswer();

        if ($this->currentQuestionIndex < $this->questions->count() - 1) {
            $this->currentQuestionIndex++;
        } else {
            $this->submitQuiz();
        }
    }

    public function prevQuestion()
    {
        if ($this->currentQuestionIndex > 0) {
            $this->currentQuestionIndex--;
        }
    }

    public function saveCurrentAnswer()
    {
        $question = $this->questions[$this->currentQuestionIndex];
        $answer = $this->answers[$question->id] ?? null;

        // للأسئلة متعددة الخيارات
        if (in_array($question->question_type, ['mcq_single', 'mcq_multiple'])) {
            $options = $this->selectedOptions[$question->id] ?? [];
            if ($question->question_type === 'mcq_single' && !empty($options)) {
                $answer = $options[0]; // فهرس الإجابة
            } elseif ($question->question_type === 'mcq_multiple') {
                $answer = $options; // مصفوفة فهارس
            }
        }

        if ($answer !== null) {
            $service = app(QuizService::class);
            try {
                $service->saveAnswer($this->attempt->id, $question->id, $answer);
            } catch (\Exception $e) {
                // تجاهل أخطاء الحفظ الجزئي
            }
        }
    }

    public function submitQuiz()
    {
        // حفظ آخر إجابة
        $this->saveCurrentAnswer();

        $service = app(QuizService::class);

        try {
            $this->result = $service->submitAttempt($this->attempt->id);
            $this->finished = true;
            $this->started = false;

            $this->dispatchBrowserEvent('quiz-finished');

            if ($this->result->passed) {
                toastr()->success('🎉 نجحت! درجتك: ' . $this->result->score . '/' . $this->result->max_score);
            } else {
                toastr()->warning('درجتك: ' . $this->result->score . '/' . $this->result->max_score . ' (' . $this->result->percentage . '%)');
            }
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
        }
    }

    public function recordTabSwitch()
    {
        $this->tabSwitches++;
        if ($this->attempt && $this->quiz->anti_cheat) {
            app(QuizService::class)->recordTabSwitch($this->attempt->id);
            toastr()->warning('⚠️ تم تسجيل تبديل التبويب! قد يتم إلغاء اختبارك.');
        }
    }

    public function getRemainingTimeAttribute()
    {
        if (!$this->attempt) return '--:--';
        $secs = $this->remainingSeconds;
        $mins = floor($secs / 60);
        $secs = $secs % 60;
        return sprintf('%02d:%02d', $mins, $secs);
    }


    public function toggleMultiOption($questionId, $optionIdx)
    {
        if (!isset($this->selectedOptions[$questionId])) {
            $this->selectedOptions[$questionId] = [];
        }
        if (in_array($optionIdx, $this->selectedOptions[$questionId])) {
            $this->selectedOptions[$questionId] = array_diff($this->selectedOptions[$questionId], [$optionIdx]);
        } else {
            $this->selectedOptions[$questionId][] = $optionIdx;
        }
    }

    public function render()
    {
        return view('livewire.quiz-taker');
    }
}
