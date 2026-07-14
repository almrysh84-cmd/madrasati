<?php

namespace App\Http\Livewire;

use App\Models\Quizze;
use App\Models\Question;
use Livewire\Component;

class QuizBuilder extends Component
{
    public $quizId;
    public $quiz;
    public $questions;

    // حقول السؤال الجديد
    public $title = '';
    public $question_type = 'mcq_single';
    public $score = 1;
    public $difficulty = 'medium';
    public $explanation = '';
    public $options = ['']; // قائمة الخيارات
    public $correct_option = 0; // فهرس الإجابة الصحيحة
    public $fill_blank_answers = ''; // إجابات أكمل الفراغ (مفصولة بـ |)
    public $essay_answer = ''; // الإجابة النموذجية للمقالي
    public $true_false_answer = 'صح';

    // إعدادات الاختبار
    public $duration_minutes = 30;
    public $passing_score = 50;
    public $max_attempts = 1;
    public $shuffle_questions = false;
    public $shuffle_options = false;
    public $show_results_immediately = true;
    public $anti_cheat = false;
    public $available_from;
    public $available_to;

    protected $rules = [
        'title'                 => 'required|string|max:500',
        'question_type'         => 'required|in:mcq_single,mcq_multiple,true_false,essay,fill_blank',
        'score'                 => 'required|numeric|min:0.5|max:100',
        'difficulty'            => 'required|in:easy,medium,hard',
        'duration_minutes'      => 'nullable|integer|min:1|max:300',
        'passing_score'         => 'nullable|numeric|min:0|max:100',
        'max_attempts'          => 'nullable|integer|min:1|max:10',
    ];

    public function mount($quizId)
    {
        $this->quizId = $quizId;
        $this->quiz = Quizze::findOrFail($quizId);
        $this->loadQuestions();
        $this->loadSettings();
    }

    public function loadQuestions()
    {
        $this->questions = Question::where('quizze_id', $this->quizId)
            ->orderBy('id')
            ->get();
    }

    public function loadSettings()
    {
        $this->duration_minutes = $this->quiz->duration_minutes ?? 30;
        $this->passing_score = $this->quiz->passing_score ?? 50;
        $this->max_attempts = $this->quiz->max_attempts ?? 1;
        $this->shuffle_questions = (bool) $this->quiz->shuffle_questions;
        $this->shuffle_options = (bool) $this->quiz->shuffle_options;
        $this->show_results_immediately = (bool) $this->quiz->show_results_immediately;
        $this->anti_cheat = (bool) $this->quiz->anti_cheat;
        $this->available_from = $this->quiz->available_from?->format('Y-m-d\TH:i');
        $this->available_to = $this->quiz->available_to?->format('Y-m-d\TH:i');
    }

    public function addOption()
    {
        $this->options[] = '';
    }

    public function removeOption($index)
    {
        if (count($this->options) > 1) {
            unset($this->options[$index]);
            $this->options = array_values($this->options);
            if ($this->correct_option >= count($this->options)) {
                $this->correct_option = count($this->options) - 1;
            }
        }
    }

    public function saveQuestion()
    {
        $this->validate();

        // بناء الإجابات + الإجابة الصحيحة حسب نوع السؤال
        $answers = '';
        $rightAnswer = '';
        $optionsJson = null;
        $correctJson = null;

        switch ($this->question_type) {
            case 'mcq_single':
            case 'mcq_multiple':
                $options = array_filter(array_map('trim', $this->options));
                if (count($options) < 2) {
                    $this->addError('options', 'يرجى إدخال خيارين على الأقل');
                    return;
                }
                $answers = implode(' - ', $options);
                $rightAnswer = $options[$this->correct_option] ?? $options[0];
                $optionsJson = json_encode($options);
                $correctJson = json_encode([$this->correct_option]);
                break;

            case 'true_false':
                $answers = 'صح - خطأ';
                $rightAnswer = $this->true_false_answer;
                $optionsJson = json_encode(['صح', 'خطأ']);
                $correctJson = json_encode([$this->true_false_answer === 'صح' ? 0 : 1]);
                break;

            case 'fill_blank':
                $rightAnswer = $this->fill_blank_answers;
                $answers = $this->fill_blank_answers;
                break;

            case 'essay':
                $rightAnswer = $this->essay_answer;
                $answers = '';
                break;
        }

        Question::create([
            'title'                => $this->title,
            'question_type'        => $this->question_type,
            'answers'              => $answers,
            'right_answer'         => $rightAnswer,
            'options_json'         => $optionsJson,
            'correct_answers_json' => $correctJson,
            'score'                => $this->score,
            'difficulty'           => $this->difficulty,
            'explanation'          => $this->explanation,
            'quizze_id'            => $this->quizId,
        ]);

        $this->reset(['title', 'explanation', 'options', 'correct_option', 'fill_blank_answers', 'essay_answer']);
        $this->options = [''];
        $this->question_type = 'mcq_single';
        $this->score = 1;
        $this->difficulty = 'medium';

        $this->loadQuestions();
        toastr()->success('تم إضافة السؤال بنجاح');
    }

    public function deleteQuestion($id)
    {
        Question::findOrFail($id)->delete();
        $this->loadQuestions();
        toastr()->success('تم حذف السؤال');
    }

    public function saveSettings()
    {
        $this->quiz->update([
            'duration_minutes'       => $this->duration_minutes,
            'passing_score'          => $this->passing_score,
            'max_attempts'           => $this->max_attempts,
            'shuffle_questions'      => $this->shuffle_questions,
            'shuffle_options'        => $this->shuffle_options,
            'show_results_immediately' => $this->show_results_immediately,
            'anti_cheat'             => $this->anti_cheat,
            'available_from'         => $this->available_from ?: null,
            'available_to'           => $this->available_to ?: null,
        ]);

        toastr()->success('تم حفظ إعدادات الاختبار');
    }

    public function render()
    {
        return view('livewire.quiz-builder');
    }
}
