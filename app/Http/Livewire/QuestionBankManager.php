<?php

namespace App\Http\Livewire;

use App\Models\Grade;
use App\Models\QuestionBank;
use App\Models\Subject;
use Livewire\Component;

class QuestionBankManager extends Component
{
    // خصائص النموذج
    public $question_id;
    public $question_ar;
    public $question_en;
    public $type = 'mcq';
    public $level = 'medium';
    public $score = 1;
    public $subject_id;
    public $grade_id;
    public $is_shared = true;
    public $correct_answer;
    public $options = [];

    // خصائص التصفية
    public $filter_subject;
    public $filter_grade;
    public $filter_type;
    public $filter_level;

    // التحكم بالواجهة
    public $showModal = false;
    public $editMode = false;

    protected $rules = [
        'question_ar'    => 'required|string|max:1000',
        'question_en'    => 'nullable|string|max:1000',
        'type'           => 'required|in:mcq,true_false,essay',
        'level'          => 'required|in:easy,medium,hard',
        'score'          => 'required|numeric|min:0.5|max:100',
        'subject_id'     => 'required|exists:subjects,id',
        'grade_id'       => 'required|exists:grades,id',
        'correct_answer' => 'nullable|string',
        'is_shared'      => 'boolean',
    ];

    public function render()
    {
        $teacherId = auth()->user()->id;

        $query = QuestionBank::with(['subject', 'grade', 'creator'])
            ->where(function ($q) use ($teacherId) {
                $q->where('created_by', $teacherId)
                  ->orWhere('is_shared', true);
            });

        if ($this->filter_subject) {
            $query->where('subject_id', $this->filter_subject);
        }
        if ($this->filter_grade) {
            $query->where('grade_id', $this->filter_grade);
        }
        if ($this->filter_type) {
            $query->where('type', $this->filter_type);
        }
        if ($this->filter_level) {
            $query->where('level', $this->filter_level);
        }

        $questions = $query->orderBy('created_at', 'desc')->paginate(20);

        $subjects = Subject::where('teacher_id', $teacherId)->get();
        $grades = Grade::all();

        return view('livewire.question-bank-manager', compact('questions', 'subjects', 'grades'));
    }

    public function openCreateModal()
    {
        $this->resetInput();
        $this->editMode = false;
        $this->showModal = true;
    }

    public function openEditModal($id)
    {
        $question = QuestionBank::findOrFail($id);
        if ($question->created_by != auth()->user()->id) {
            session()->flash('error', 'لا تملك صلاحية تعديل هذا السؤال');
            return;
        }
        $this->question_id = $question->id;
        $this->question_ar = $question->getTranslation('question', 'ar');
        $this->question_en = $question->getTranslation('question', 'en');
        $this->type = $question->type;
        $this->level = $question->level;
        $this->score = $question->score;
        $this->subject_id = $question->subject_id;
        $this->grade_id = $question->grade_id;
        $this->is_shared = $question->is_shared;
        $this->correct_answer = $question->correct_answer;
        $this->options = $question->options ?? [];

        // التأكد من وجود 4 خيارات على الأقل للاختيار من متعدد
        if ($this->type === 'mcq') {
            while (count($this->options) < 4) {
                $this->options[] = '';
            }
        }

        $this->editMode = true;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'question' => ['ar' => $this->question_ar, 'en' => $this->question_en ?? $this->question_ar],
            'type' => $this->type,
            'level' => $this->level,
            'score' => $this->score,
            'subject_id' => $this->subject_id,
            'grade_id' => $this->grade_id,
            'is_shared' => $this->is_shared,
        ];

        if ($this->type === 'mcq') {
            $filteredOptions = array_filter($this->options, function ($opt) {
                return trim($opt) !== '';
            });
            $data['options'] = array_values($filteredOptions);
            $data['correct_answer'] = $this->correct_answer;
        } elseif ($this->type === 'true_false') {
            $data['options'] = ['صح', 'خطأ'];
            $data['correct_answer'] = $this->correct_answer;
        } else {
            $data['options'] = null;
            $data['correct_answer'] = null;
        }

        if ($this->editMode) {
            $question = QuestionBank::findOrFail($this->question_id);
            if ($question->created_by != auth()->user()->id) {
                session()->flash('error', 'لا تملك صلاحية تعديل هذا السؤال');
                return;
            }
            $question->update($data);
            session()->flash('success', 'تم تحديث السؤال بنجاح');
        } else {
            $data['created_by'] = auth()->user()->id;
            QuestionBank::create($data);
            session()->flash('success', 'تم إضافة السؤال بنجاح');
        }

        $this->showModal = false;
        $this->resetInput();
    }

    public function delete($id)
    {
        $question = QuestionBank::findOrFail($id);
        if ($question->created_by != auth()->user()->id) {
            session()->flash('error', 'لا تملك صلاحية حذف هذا السؤال');
            return;
        }
        $question->delete();
        session()->flash('success', 'تم حذف السؤال بنجاح');
    }

    public function updatedType($value)
    {
        if ($value === 'mcq' && count($this->options) < 4) {
            $this->options = ['', '', '', ''];
        }
    }

    public function addOption()
    {
        if (count($this->options) < 6) {
            $this->options[] = '';
        }
    }

    public function removeOption($index)
    {
        if (count($this->options) > 2) {
            unset($this->options[$index]);
            $this->options = array_values($this->options);
        }
    }

    private function resetInput()
    {
        $this->question_id = null;
        $this->question_ar = '';
        $this->question_en = '';
        $this->type = 'mcq';
        $this->level = 'medium';
        $this->score = 1;
        $this->subject_id = null;
        $this->grade_id = null;
        $this->is_shared = true;
        $this->correct_answer = null;
        $this->options = ['', '', '', ''];
    }
}
