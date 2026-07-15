<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Http\Resources\GradeResource;
use App\Models\Student;
use App\Models\Degree;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with(['gender', 'grade', 'classroom', 'section']);

        if ($request->has('grade_id')) {
            $query->where('Grade_id', $request->grade_id);
        }
        if ($request->has('classroom_id')) {
            $query->where('Classroom_id', $request->classroom_id);
        }

        $students = $query->paginate(50);
        return StudentResource::collection($students);
    }

    public function show($id)
    {
        $student = Student::with(['gender', 'grade', 'classroom', 'section', 'myparent'])
            ->findOrFail($id);
        return new StudentResource($student);
    }

    public function grades($id, Request $request)
    {
        $student = Student::findOrFail($id);
        $grades = Degree::where('student_id', $id)
            ->with(['quizze.subject'])
            ->orderBy('id', 'desc');

        if ($request->has('subject_id')) {
            $grades->whereHas('quizze', function ($q) use ($request) {
                $q->where('subject_id', $request->subject_id);
            });
        }

        return GradeResource::collection($grades->paginate(50));
    }
}
