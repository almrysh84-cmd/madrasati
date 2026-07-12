<?php

namespace App\Http\Controllers\Students\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Homework;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentHomeworkController extends Controller
{
    /**
     * عرض قائمة الواجبات الخاصة بالطالب المسجّل دخوله
     * بناءً على مرحلته/صفه/قسمه.
     */
    public function index()
    {
        $student = auth()->user();

        // جلب الواجبات الخاصة بصف وقسم الطالب فقط (مع تحميل العلاقات لتفادي N+1)
        $homeworks = Homework::with(['subject', 'teacher', 'grade', 'classroom', 'section'])
            ->where('grade_id', $student->Grade_id)
            ->where('classroom_id', $student->Classroom_id)
            ->where('section_id', $student->section_id)
            ->orderBy('due_date', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.Students.dashboard.homework_index', compact('homeworks'));
    }

    /**
     * عرض تفاصيل واجب محدد للطالب.
     */
    public function show($id)
    {
        $student = auth()->user();
        $homework = Homework::with(['subject', 'teacher', 'questions'])
            ->findOrFail($id);

        // التأكد من أن الواجب يخص صف وقسم الطالب
        if ($homework->grade_id != $student->Grade_id
            || $homework->classroom_id != $student->Classroom_id
            || $homework->section_id != $student->section_id) {
            abort(403, 'هذا الواجب غير مخصص لصفك');
        }

        return view('pages.Students.dashboard.homework_show', compact('homework'));
    }

    /**
     * تنزيل ملف الواجب للطالب.
     */
    public function download($filename)
    {
        // P0-6 fix: Path Traversal — sanitize filename
        $filename = basename($filename);
        if ($filename === '' || strpos($filename, '/') !== false || strpos($filename, '\\') !== false) {
            abort(400, 'Invalid file request');
        }

        $relative = 'attachments/homework/' . $filename;
        if (!Storage::disk('upload_attachments')->exists($relative)) {
            abort(404, 'الملف غير موجود');
        }

        return Storage::disk('upload_attachments')->download($relative);
    }
}
