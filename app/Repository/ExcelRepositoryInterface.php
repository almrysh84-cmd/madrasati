<?php

namespace App\Repository;

/**
 * واجهة مستودع استيراد وتصدير Excel
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
interface ExcelRepositoryInterface
{
    // صفحة الاستيراد والتصدير الرئيسية
    public function index();

    // استيراد الطلاب
    public function importStudents($request);

    // استيراد المعلمين
    public function importTeachers($request);

    // استيراد المراحل الدراسية
    public function importGrades($request);

    // استيراد الحضور
    public function importAttendance($request);

    // تصدير الطلاب
    public function exportStudents();

    // تصدير المعلمين
    public function exportTeachers();

    // تصدير المراحل الدراسية
    public function exportGrades();

    // تصدير الحضور
    public function exportAttendance();

    // تنزيل ملف الأخطاء
    public function downloadErrors($filename);
}
