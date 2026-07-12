<?php

namespace App\Repository;

use App\Http\Traits\AttachFilesTrait;
use App\Models\Grade;
use App\Models\Homework;
use App\Models\HomeworkQuestion;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;

class HomeworkRepository implements HomeworkRepositoryInterface
{

    use AttachFilesTrait;

    /**
     * عرض قائمة الواجبات الخاصة بالمعلم فقط
     */
    public function index()
    {
        $homeworks = Homework::where('teacher_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('pages.Teachers.dashboard.Homework.index', compact('homeworks'));
    }

    /**
     * عرض نموذج إضافة واجب جديد
     * المواد المتاحة = مواد المعلم فقط
     */
    public function create()
    {
        $subjects = Subject::where('teacher_id', auth()->user()->id)->get();
        $grades = Grade::all();
        return view('pages.Teachers.dashboard.Homework.create', compact('subjects', 'grades'));
    }

    /**
     * حفظ واجب جديد
     * يدعم ثلاثة أنواع: file, image, question
     */
    public function store($request)
    {
        DB::beginTransaction();
        try {
            $homework = new Homework();
            $homework->title = ['ar' => $request->title_ar, 'en' => $request->title_en];
            $homework->description = ['ar' => $request->description_ar, 'en' => $request->description_en];
            $homework->type = $request->type;
            $homework->due_date = $request->due_date;
            $homework->score = $request->score;
            $homework->subject_id = $request->subject_id;
            $homework->grade_id = $request->Grade_id;
            $homework->classroom_id = $request->Classroom_id;
            $homework->section_id = $request->section_id;
            $homework->teacher_id = auth()->user()->id;

            // رفع الملف للنوعين file و image
            if ($request->hasFile('file_name') && in_array($request->type, ['file', 'image'])) {
                // P0-7 fix: uploadFile now returns a sanitized filename; we persist that
                $file_name = $this->uploadFile($request, 'file_name', 'homework');
                $homework->file_name = $file_name;
            } else {
                $homework->file_name = null;
            }

            $homework->save();

            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('homework.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * عرض تفاصيل الواجب (الأسئلة للنوع question)
     */
    public function show($id)
    {
        $homework = Homework::findOrFail($id);

        // التأكد أن هذا الواجب يخص المعلم الحالي
        if ($homework->teacher_id != auth()->user()->id) {
            toastr()->error('لا تملك صلاحية عرض هذا الواجب');
            return redirect()->route('homework.index');
        }

        $questions = HomeworkQuestion::where('homework_id', $id)->get();
        return view('pages.Teachers.dashboard.Homework.show', compact('homework', 'questions'));
    }

    /**
     * عرض نموذج تعديل الواجب
     */
    public function edit($id)
    {
        $homework = Homework::findOrFail($id);

        if ($homework->teacher_id != auth()->user()->id) {
            toastr()->error('لا تملك صلاحية تعديل هذا الواجب');
            return redirect()->route('homework.index');
        }

        $subjects = Subject::where('teacher_id', auth()->user()->id)->get();
        $grades = Grade::all();
        return view('pages.Teachers.dashboard.Homework.edit', compact('homework', 'subjects', 'grades'));
    }

    /**
     * تحديث الواجب
     */
    public function update($request)
    {
        DB::beginTransaction();
        try {
            $homework = Homework::findOrFail($request->id);

            if ($homework->teacher_id != auth()->user()->id) {
                toastr()->error('لا تملك صلاحية تعديل هذا الواجب');
                return redirect()->route('homework.index');
            }

            $homework->title = ['ar' => $request->title_ar, 'en' => $request->title_en];
            $homework->description = ['ar' => $request->description_ar, 'en' => $request->description_en];
            $homework->type = $request->type;
            $homework->due_date = $request->due_date;
            $homework->score = $request->score;
            $homework->subject_id = $request->subject_id;
            $homework->grade_id = $request->Grade_id;
            $homework->classroom_id = $request->Classroom_id;
            $homework->section_id = $request->section_id;

            if ($request->hasFile('file_name') && in_array($request->type, ['file', 'image'])) {
                // حذف الملف القديم
                if ($homework->file_name) {
                    $this->deleteFile($homework->file_name, 'homework');
                }
                // P0-7 fix: use sanitized filename returned from uploadFile
                $homework->file_name = $this->uploadFile($request, 'file_name', 'homework');
            }

            $homework->save();

            DB::commit();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('homework.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * حذف الواجب
     */
    public function destroy($id)
    {
        try {
            $homework = Homework::findOrFail($id);

            if ($homework->teacher_id != auth()->user()->id) {
                toastr()->error('لا تملك صلاحية حذف هذا الواجب');
                return redirect()->route('homework.index');
            }

            // حذف الملف المرفق إن وجد
            if ($homework->file_name) {
                $this->deleteFile($homework->file_name, 'homework');
            }

            $homework->delete();
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * حفظ سؤال جديد للواجب (للنوع question)
     */
    public function storeQuestion($request)
    {
        try {
            $homework = Homework::findOrFail($request->homework_id);

            if ($homework->teacher_id != auth()->user()->id) {
                toastr()->error('لا تملك صلاحية إضافة أسئلة لهذا الواجب');
                return redirect()->back();
            }

            $question = new HomeworkQuestion();
            $question->homework_id = $request->homework_id;
            $question->title = $request->title;
            $question->answers = $request->answers;
            $question->right_answer = $request->right_answer;
            $question->score = $request->score;
            $question->save();

            toastr()->success(trans('messages.success'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * حذف سؤال من الواجب
     */
    public function destroyQuestion($id)
    {
        try {
            $question = HomeworkQuestion::findOrFail($id);
            if ($question->homework->teacher_id != auth()->user()->id) {
                toastr()->error('لا تملك صلاحية حذف هذا السؤال');
                return redirect()->back();
            }
            $question->delete();
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * تنزيل ملف الواجب
     */
    public function download($filename)
    {
        // P0-6 fix: Path Traversal — sanitize with basename()
        $filename = basename($filename);
        if ($filename === '' || strpos($filename, '/') !== false || strpos($filename, '\\') !== false) {
            abort(400, 'Invalid file request');
        }

        $relative = 'attachments/homework/' . $filename;
        if (!\Illuminate\Support\Facades\Storage::disk('upload_attachments')->exists($relative)) {
            abort(404, 'الملف غير موجود');
        }

        return \Illuminate\Support\Facades\Storage::disk('upload_attachments')->download($relative);
    }
}
