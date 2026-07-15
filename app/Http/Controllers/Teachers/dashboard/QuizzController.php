<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Degree;
use App\Models\Grade;
use App\Models\Question;
use App\Models\Quizze;
use App\Models\Section;
use App\Models\Subject;
use Illuminate\Http\Request;

class QuizzController extends Controller
{


    public function index()
    {
        // Eager-load relations to avoid N+1 queries
        $quizzes = Quizze::with(['subject', 'grade', 'classroom', 'section'])
            ->where('teacher_id', auth()->user()->id)
            ->get();
        return view('pages.Teachers.dashboard.Quizzes.index', compact('quizzes'));
    }


    public function create()
    {
        $data['grades'] = Grade::all();
        $data['subjects'] = Subject::where('teacher_id', auth()->user()->id)->get();
        return view('pages.Teachers.dashboard.Quizzes.create', $data);
    }


    public function store(Request $request)
    {
        try {
            $quizzes = new Quizze();
            $quizzes->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $quizzes->subject_id = $request->subject_id;
            $quizzes->grade_id = $request->Grade_id;
            $quizzes->classroom_id = $request->Classroom_id;
            $quizzes->section_id = $request->section_id;
            $quizzes->teacher_id = auth()->user()->id;
            $quizzes->exam_type = $request->exam_type ?? 'monthly';
            $quizzes->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('quizzes.create');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }



    public function edit($id)
    {
        $quizz = Quizze::findorFail($id);
        // P0-5 fix: IDOR — verify ownership
        if ($quizz->teacher_id !== auth()->user()->id) {
            abort(403, 'غير مصرح لك بالوصول إلى هذا الاختبار');
        }
        $data['grades'] = Grade::all();
        $data['subjects'] = Subject::where('teacher_id', auth()->user()->id)->get();
        return view('pages.Teachers.dashboard.Quizzes.edit', $data, compact('quizz'));
    }

    public function show($id)
    {
        $quizz = Quizze::findorFail($id);
        // P0-5 fix: IDOR — verify ownership
        if ($quizz->teacher_id !== auth()->user()->id) {
            abort(403, 'غير مصرح لك بالوصول إلى هذا الاختبار');
        }
        $questions = Question::where('quizze_id', $id)->get();
        return view('pages.Teachers.dashboard.Questions.index', compact('questions', 'quizz'));
    }

    public function update(Request $request)
    {
        try {
            $quizz = Quizze::findorFail($request->id);
            // P0-5 fix: IDOR — verify ownership before update
            if ($quizz->teacher_id !== auth()->user()->id) {
                abort(403, 'غير مصرح لك بتعديل هذا الاختبار');
            }
            $quizz->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $quizz->subject_id = $request->subject_id;
            $quizz->grade_id = $request->Grade_id;
            $quizz->classroom_id = $request->Classroom_id;
            $quizz->section_id = $request->section_id;
            // P0-5 fix: do NOT overwrite teacher_id — keep the original owner
            $quizz->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('quizzes.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function destroy($id)
    {
        try {
            $quizz = Quizze::findorFail($id);
            // P0-5 fix: IDOR — verify ownership before delete
            if ($quizz->teacher_id !== auth()->user()->id) {
                abort(403, 'غير مصرح لك بحذف هذا الاختبار');
            }
            $quizz->delete();
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function student_quizze($quizze_id)
    {
        $degrees = Degree::where('quizze_id', $quizze_id)->get();
        return view('pages.Teachers.dashboard.Quizzes.student_quizze', compact('degrees'));
    }

    public function repeat_quizze(Request $request)
    {
        Degree::where('student_id', $request->student_id)->where('quizze_id', $request->quizze_id)->delete();
        toastr()->success('تم فتح الاختبار مرة اخرى للطالب');
        return redirect()->back();
    }
}
