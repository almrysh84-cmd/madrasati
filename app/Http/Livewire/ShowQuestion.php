<?php

namespace App\Http\Livewire;

use App\Models\Degree;
use App\Models\Question;
use Livewire\Component;

class ShowQuestion extends Component
{
    public $quizze_id, $student_id, $data, $counter = 0, $questioncount = 0;

    public function render()
    {
        $this->data = Question::where('quizze_id', $this->quizze_id)->get();
        $this->questioncount = $this->data->count();
        return view('livewire.show-question', ['data' => $this->data]);
    }

    /**
     * P0-8 fix: receive ONLY question_id and the chosen answer from the client.
     * Look up the right_answer and score SERVER-SIDE — never trust client.
     */
    public function nextQuestion($question_id, $answer)
    {
        // Fetch the question server-side to get the authoritative right_answer and score
        $question = Question::where('id', $question_id)
            ->where('quizze_id', $this->quizze_id) // ensure the question belongs to this quiz
            ->first();

        if (!$question) {
            toastr()->error('سؤال غير صالح');
            return redirect('student_exams');
        }

        $score = (float) $question->score;
        $right_answer = $question->right_answer;
        $is_correct = strcmp(trim(mb_strtolower($answer)), trim(mb_strtolower($right_answer))) === 0;

        $stuDegree = Degree::where('student_id', $this->student_id)
            ->where('quizze_id', $this->quizze_id)
            ->first();

        // Insert
        if ($stuDegree == null) {
            $degree = new Degree();
            $degree->quizze_id = $this->quizze_id;
            $degree->student_id = $this->student_id;
            $degree->question_id = $question_id;
            $degree->score = $is_correct ? $score : 0;
            $degree->date = date('Y-m-d');
            $degree->save();
        } else {
            // Update — detect tampering (re-answering earlier questions)
            if ($stuDegree->question_id >= $question_id) {
                $stuDegree->score = 0;
                $stuDegree->abuse = '1';
                $stuDegree->save();
                toastr()->error('تم إلغاء الاختبار لإكتشاف تلاعب بالنظام');
                return redirect('student_exams');
            } else {
                $stuDegree->question_id = $question_id;
                if ($is_correct) {
                    $stuDegree->score = (float) $stuDegree->score + $score;
                }
                $stuDegree->save();
            }
        }

        if ($this->counter < $this->questioncount - 1) {
            $this->counter++;
        } else {
            toastr()->success('تم إجراء الاختبار بنجاح');
            return redirect('student_exams');
        }
    }
}
