<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuizResource;
use App\Models\Quizze;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index(Request $request)
    {
        $query = Quizze::with(['subject', 'grade', 'classroom', 'questions']);

        if ($request->has('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }
        if ($request->has('grade_id')) {
            $query->where('grade_id', $request->grade_id);
        }

        $quizzes = $query->paginate(20);
        return QuizResource::collection($quizzes);
    }

    public function show($id)
    {
        $quiz = Quizze::with(['subject', 'grade', 'classroom', 'questions'])->findOrFail($id);
        return new QuizResource($quiz);
    }
}
