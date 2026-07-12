<?php

namespace App\Repository;

use App\Exports\QuestionBankExport;
use App\Imports\QuestionBankImport;
use App\Models\Grade;
use App\Models\QuestionBank;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class QuestionBankRepository implements QuestionBankRepositoryInterface
{
    /**
     * عرض قائمة أسئلة البنك
     * المعلم يرى أسئلته الخاصة + الأسئلة المشتركة من معلمين آخرين
     */
    public function index()
    {
        $teacherId = auth()->user()->id;

        $query = QuestionBank::with(['subject', 'grade', 'creator'])
            ->where(function ($q) use ($teacherId) {
                $q->where('created_by', $teacherId)
                  ->orWhere('is_shared', true);
            });

        // تطبيق عوامل التصفية من معايير الطلب
        if (request()->filled('subject_id')) {
            $query->where('subject_id', request('subject_id'));
        }
        if (request()->filled('grade_id')) {
            $query->where('grade_id', request('grade_id'));
        }
        if (request()->filled('type')) {
            $query->where('type', request('type'));
        }
        if (request()->filled('level')) {
            $query->where('level', request('level'));
        }

        $questions = $query->orderBy('created_at', 'desc')->get();

        return view('pages.Question_Bank.index', compact('questions'));
    }

    /**
     * عرض نموذج إضافة سؤال جديد
     * المواا المتاحة = مواد المعلم فقط
     */
    public function create()
    {
        $subjects = Subject::where('teacher_id', auth()->user()->id)->get();
        $grades = Grade::all();
        return view('pages.Question_Bank.create', compact('subjects', 'grades'));
    }

    /**
     * حفظ سؤال جديد في البنك
     * يدعم ثلاثة أنواع: mcq, true_false, essay
     */
    public function store($request)
    {
        DB::beginTransaction();
        try {
            $question = new QuestionBank();
            $question->question = ['ar' => $request->question_ar, 'en' => $request->question_en ?? $request->question_ar];
            $question->type = $request->type;
            $question->level = $request->level;
            $question->score = $request->score;
            $question->subject_id = $request->subject_id;
            $question->grade_id = $request->Grade_id;
            $question->created_by = auth()->user()->id;
            $question->is_shared = $request->has('is_shared') ? true : false;

            // معالجة الخيارات والإجابة الصحيحة حسب نوع السؤال
            if ($request->type === 'mcq') {
                $options = array_filter($request->options ?? [], function ($opt) {
                    return trim($opt) !== '';
                });
                $question->options = array_values($options);
                $question->correct_answer = $request->correct_answer;
            } elseif ($request->type === 'true_false') {
                $question->options = ['صح', 'خطأ'];
                $question->correct_answer = $request->correct_answer;
            } else {
                // essay - لا توجد إجابة صحيحة محددة
                $question->options = null;
                $question->correct_answer = null;
            }

            $question->save();

            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('question_bank.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

    /**
     * عرض نموذج تعديل السؤال
     * المعلم يمكنه تعديل أسئلته فقط
     */
    public function edit($id)
    {
        $question = QuestionBank::findOrFail($id);

        if ($question->created_by != auth()->user()->id) {
            toastr()->error('لا تملك صلاحية تعديل هذا السؤال');
            return redirect()->route('question_bank.index');
        }

        $subjects = Subject::where('teacher_id', auth()->user()->id)->get();
        $grades = Grade::all();
        return view('pages.Question_Bank.edit', compact('question', 'subjects', 'grades'));
    }

    /**
     * تحديث السؤال
     */
    public function update($request)
    {
        DB::beginTransaction();
        try {
            $question = QuestionBank::findOrFail($request->id);

            if ($question->created_by != auth()->user()->id) {
                toastr()->error('لا تملك صلاحية تعديل هذا السؤال');
                return redirect()->route('question_bank.index');
            }

            $question->question = ['ar' => $request->question_ar, 'en' => $request->question_en ?? $request->question_ar];
            $question->type = $request->type;
            $question->level = $request->level;
            $question->score = $request->score;
            $question->subject_id = $request->subject_id;
            $question->grade_id = $request->Grade_id;
            $question->is_shared = $request->has('is_shared') ? true : false;

            if ($request->type === 'mcq') {
                $options = array_filter($request->options ?? [], function ($opt) {
                    return trim($opt) !== '';
                });
                $question->options = array_values($options);
                $question->correct_answer = $request->correct_answer;
            } elseif ($request->type === 'true_false') {
                $question->options = ['صح', 'خطأ'];
                $question->correct_answer = $request->correct_answer;
            } else {
                $question->options = null;
                $question->correct_answer = null;
            }

            $question->save();

            DB::commit();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('question_bank.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

    /**
     * حذف السؤال
     * المعلم يمكنه حذف أسئلته فقط
     */
    public function destroy($id)
    {
        try {
            $question = QuestionBank::findOrFail($id);

            if ($question->created_by != auth()->user()->id) {
                toastr()->error('لا تملك صلاحية حذف هذا السؤال');
                return redirect()->route('question_bank.index');
            }

            $question->delete();
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * تصدير أسئلة البنك إلى Excel
     */
    public function export()
    {
        return Excel::download(new QuestionBankExport(auth()->user()->id), 'question_bank.xlsx');
    }

    /**
     * استيراد أسئلة من Excel
     */
    public function import($request)
    {
        try {
            $import = new QuestionBankImport(auth()->user()->id);
            Excel::import($import, $request->file('file'));

            $successCount = $import->getSuccessCount();
            $errorCount = $import->getErrorCount();

            if ($errorCount > 0) {
                toastr()->warning("تم استيراد {$successCount} سؤال بنجاح، وتم تجاهل {$errorCount} سؤال بسبب أخطاء في البيانات");
            } else {
                toastr()->success("تم استيراد {$successCount} سؤال بنجاح");
            }

            return redirect()->route('question_bank.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * البحث في البنك حسب المادة والصف والنوع والمستوى
     * يستخدم عند إنشاء اختبارات جديدة لاختيار أسئلة من البنك
     */
    public function search($request)
    {
        $query = QuestionBank::with(['subject', 'grade', 'creator'])
            ->where(function ($q) {
                $q->where('created_by', auth()->user()->id)
                  ->orWhere('is_shared', true);
            });

        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }
        if ($request->filled('grade_id')) {
            $query->where('grade_id', $request->grade_id);
        }
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }

        $questions = $query->orderBy('created_at', 'desc')->get();

        return response()->json([
            'status' => true,
            'data' => $questions->map(function ($q) {
                return [
                    'id' => $q->id,
                    'question' => $q->getTranslation('question', 'ar'),
                    'type' => $q->type,
                    'type_text' => $q->type_text,
                    'level' => $q->level,
                    'level_text' => $q->level_text,
                    'score' => $q->score,
                    'options' => $q->options,
                    'correct_answer' => $q->correct_answer,
                ];
            }),
        ]);
    }
}
