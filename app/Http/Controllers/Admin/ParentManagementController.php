<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\My_Parent;
use App\Models\Student;
use Illuminate\Http\Request;

/**
 * متحكم إدارة أولياء الأمور من قبل الإدارة.
 *
 * يتيح للإدارة:
 * - عرض كل أولياء الأمور
 * - عرض أبناء كل ولي أمر
 * - ربط ابن بولي أمر (إذا كان الابن بدون ولي أمر)
 * - فصل ابن عن ولي أمر
 */
class ParentManagementController extends Controller
{
    /**
     * عرض قائمة كل أولياء الأمور + أبنائهم
     */
    public function index()
    {
        $parents = My_Parent::with(['students' => function ($q) {
            $q->with(['grade', 'classroom', 'section']);
        }])
            ->orderBy('id', 'desc')
            ->paginate(20);

        // الطلاب بدون ولي أمر (متاحون للربط)
        $unlinkedStudents = Student::whereNull('parent_id')
            ->orWhere('parent_id', 0)
            ->with(['grade', 'classroom', 'section'])
            ->get();

        return view('pages.admin.parents_management', compact('parents', 'unlinkedStudents'));
    }

    /**
     * ربط ابن بولي أمر
     */
    public function linkChild(Request $request)
    {
        $request->validate([
            'parent_id'  => 'required|exists:my__parents,id',
            'student_id' => 'required|exists:students,id',
        ]);

        $student = Student::findOrFail($request->student_id);
        $student->parent_id = $request->parent_id;
        $student->save();

        toastr()->success('تم ربط الطالب بولي الأمر بنجاح');
        return redirect()->back();
    }

    /**
     * فصل ابن عن ولي أمر
     */
    public function unlinkChild($studentId)
    {
        $student = Student::findOrFail($studentId);
        $student->parent_id = null;
        $student->save();

        toastr()->success('تم فصل الطالب عن ولي الأمر');
        return redirect()->back();
    }

    /**
     * عرض أبناء ولي أمر محدد (AJAX)
     */
    public function getChildren($parentId)
    {
        $children = Student::where('parent_id', $parentId)
            ->with(['grade', 'classroom', 'section'])
            ->get();

        return response()->json([
            'success' => true,
            'children' => $children->map(function ($s) {
                return [
                    'id'       => $s->id,
                    'name'     => $s->getTranslation('name', 'ar'),
                    'email'    => $s->email,
                    'grade'    => $s->grade ? $s->grade->getTranslation('Name', 'ar') : '-',
                    'classroom'=> $s->classroom ? $s->classroom->getTranslation('Name_Class', 'ar') : '-',
                    'section'  => $s->section ? $s->section->getTranslation('Name_Section', 'ar') : '-',
                ];
            }),
        ]);
    }
}
