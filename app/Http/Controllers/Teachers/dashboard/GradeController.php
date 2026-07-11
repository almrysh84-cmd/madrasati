<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Http\Controllers\Controller;
use App\Repository\StudentGradeRepositoryInterface;
use Illuminate\Http\Request;

class GradeController extends Controller
{

    protected $grade;

    public function __construct(StudentGradeRepositoryInterface $grade)
    {
        $this->grade = $grade;
    }

    // صفحة إدخال التقديرات
    public function index()
    {
        return $this->grade->index();
    }

    // حفظ التقديرات
    public function store(Request $request)
    {
        return $this->grade->store($request);
    }

    // جلب الطلاب حسب المادة والقسم (AJAX)
    public function getStudents(Request $request)
    {
        return $this->grade->getStudents($request->subject_id, $request->section_id);
    }

    // تقرير التقديرات
    public function report()
    {
        return $this->grade->report();
    }

    // البحث في تقرير التقديرات
    public function search(Request $request)
    {
        return $this->grade->search($request);
    }
}
