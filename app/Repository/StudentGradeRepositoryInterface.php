<?php

namespace App\Repository;

interface StudentGradeRepositoryInterface
{
    // عرض صفحة إدخال التقديرات
    public function index();

    // جلب الطلاب حسب المادة والقسم المحدد (AJAX)
    public function getStudents($subject_id, $section_id);

    // حفظ التقديرات
    public function store($request);

    // عرض تقرير التقديرات
    public function report();

    // البحث في تقرير التقديرات
    public function search($request);
}
