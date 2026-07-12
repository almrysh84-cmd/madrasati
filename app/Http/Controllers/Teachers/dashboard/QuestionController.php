<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Quizze;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * P0-5 fix: helper to verify that a quizze (and transitively its questions)
     * belongs to the currently authenticated teacher.
     */
    private function assertQuizOwnership($quizze_id)
    {
        $quiz = Quizze::where('id', $quizze_id)
            ->where('teacher_id', auth()->user()->id)
            ->first();
        if (!$quiz) {
            abort(403, 'غير مصرح لك بالوصول إلى هذا الاختبار');
        }
        return $quiz;
    }

    public function store(Request $request)
    {
        try {
            // P0-5 fix: verify the quiz belongs to this teacher before adding a question
            $this->assertQuizOwnership($request->quizz_id);

            $question = new Question();
            $question->title = $request->title;
            $question->answers = $request->answers;
            $question->right_answer = $request->right_answer;
            $question->score = $request->score;
            $question->quizze_id = $request->quizz_id;
            $question->save();
            toastr()->success(trans('messages.success'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function show($id)
    {
        // P0-5 fix: verify ownership before letting teacher add questions
        $this->assertQuizOwnership($id);
        $quizz_id = $id;
        return view('pages.Teachers.dashboard.Questions.create', compact('quizz_id'));
    }


    public function edit($id)
    {
        $question = Question::with('quizze')->findorFail($id);
        // P0-5 fix: verify the question's quiz belongs to this teacher
        if (!$question->quizze || $question->quizze->teacher_id !== auth()->user()->id) {
            abort(403, 'غير مصرح لك بالوصول إلى هذا السؤال');
        }
        return view('pages.Teachers.dashboard.Questions.edit', compact('question'));
    }


    public function update(Request $request, $id)
    {
        try {
            $question = Question::with('quizze')->findorfail($id);
            // P0-5 fix: verify ownership
            if (!$question->quizze || $question->quizze->teacher_id !== auth()->user()->id) {
                abort(403, 'غير مصرح لك بتعديل هذا السؤال');
            }
            $question->title = $request->title;
            $question->answers = $request->answers;
            $question->right_answer = $request->right_answer;
            $question->score = $request->score;
            $question->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function destroy($id)
    {
        try {
            $question = Question::with('quizze')->findorFail($id);
            // P0-5 fix: verify ownership
            if (!$question->quizze || $question->quizze->teacher_id !== auth()->user()->id) {
                abort(403, 'غير مصرح لك بحذف هذا السؤال');
            }
            $question->delete();
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
