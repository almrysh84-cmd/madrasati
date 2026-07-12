<?php

namespace App\Http\Controllers\Excel;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImportExcelRequest;
use App\Repository\ExcelRepositoryInterface;
use Illuminate\Http\Request;

/**
 * متحكم استيراد وتصدير Excel
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class ExcelController extends Controller
{
    protected $excelRepository;

    public function __construct(ExcelRepositoryInterface $excelRepository)
    {
        $this->excelRepository = $excelRepository;
    }

    /**
     * صفحة الاستيراد والتصدير الرئيسية
     */
    public function index()
    {
        return $this->excelRepository->index();
    }

    /**
     * استيراد الطلاب
     */
    public function importStudents(ImportExcelRequest $request)
    {
        return $this->excelRepository->importStudents($request);
    }

    /**
     * استيراد المعلمين
     */
    public function importTeachers(ImportExcelRequest $request)
    {
        return $this->excelRepository->importTeachers($request);
    }

    /**
     * استيراد المراحل الدراسية
     */
    public function importGrades(ImportExcelRequest $request)
    {
        return $this->excelRepository->importGrades($request);
    }

    /**
     * استيراد الحضور
     */
    public function importAttendance(ImportExcelRequest $request)
    {
        return $this->excelRepository->importAttendance($request);
    }

    /**
     * تصدير الطلاب
     */
    public function exportStudents()
    {
        return $this->excelRepository->exportStudents();
    }

    /**
     * تصدير المعلمين
     */
    public function exportTeachers()
    {
        return $this->excelRepository->exportTeachers();
    }

    /**
     * تصدير المراحل الدراسية
     */
    public function exportGrades()
    {
        return $this->excelRepository->exportGrades();
    }

    /**
     * تصدير الحضور
     */
    public function exportAttendance()
    {
        return $this->excelRepository->exportAttendance();
    }

    /**
     * تنزيل ملف الأخطاء
     */
    public function downloadErrors($filename)
    {
        return $this->excelRepository->downloadErrors($filename);
    }
}
