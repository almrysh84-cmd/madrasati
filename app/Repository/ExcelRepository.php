<?php

namespace App\Repository;

use App\Imports\StudentsImport;
use App\Imports\TeachersImport;
use App\Imports\GradesImport;
use App\Imports\AttendanceImport;
use App\Exports\StudentsExport;
use App\Exports\TeachersExport;
use App\Exports\GradesExport;
use App\Exports\AttendanceExport;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * مستودع استيراد وتصدير Excel
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class ExcelRepository implements ExcelRepositoryInterface
{
    /**
     * صفحة الاستيراد والتصدير الرئيسية
     */
    public function index()
    {
        return view('pages.Excel.index');
    }

    /**
     * استيراد الطلاب من ملف Excel
     */
    public function importStudents($request)
    {
        $import = new StudentsImport();
        Excel::import($import, $request->file('file'));

        $failures = $import->failures();
        $errors = $import->errors();

        if (count($failures) > 0 || count($errors) > 0) {
            $this->storeErrors($failures, $errors, 'students_errors');
        }

        return $this->buildResponse($failures, $errors, 'students_errors');
    }

    /**
     * استيراد المعلمين من ملف Excel
     */
    public function importTeachers($request)
    {
        $import = new TeachersImport();
        Excel::import($import, $request->file('file'));

        $failures = $import->failures();
        $errors = $import->errors();

        if (count($failures) > 0 || count($errors) > 0) {
            $this->storeErrors($failures, $errors, 'teachers_errors');
        }

        return $this->buildResponse($failures, $errors, 'teachers_errors');
    }

    /**
     * استيراد المراحل الدراسية
     */
    public function importGrades($request)
    {
        $import = new GradesImport();
        Excel::import($import, $request->file('file'));

        $failures = $import->failures();
        $errors = $import->errors();

        if (count($failures) > 0 || count($errors) > 0) {
            $this->storeErrors($failures, $errors, 'grades_errors');
        }

        return $this->buildResponse($failures, $errors, 'grades_errors');
    }

    /**
     * استيراد الحضور
     */
    public function importAttendance($request)
    {
        $import = new AttendanceImport();
        Excel::import($import, $request->file('file'));

        $failures = $import->failures();
        $errors = $import->errors();

        if (count($failures) > 0 || count($errors) > 0) {
            $this->storeErrors($failures, $errors, 'attendance_errors');
        }

        return $this->buildResponse($failures, $errors, 'attendance_errors');
    }

    /**
     * تصدير الطلاب
     */
    public function exportStudents()
    {
        return Excel::download(new StudentsExport(), 'students.xlsx');
    }

    /**
     * تصدير المعلمين
     */
    public function exportTeachers()
    {
        return Excel::download(new TeachersExport(), 'teachers.xlsx');
    }

    /**
     * تصدير المراحل الدراسية
     */
    public function exportGrades()
    {
        return Excel::download(new GradesExport(), 'grades.xlsx');
    }

    /**
     * تصدير الحضور
     */
    public function exportAttendance()
    {
        return Excel::download(new AttendanceExport(), 'attendance.xlsx');
    }

    /**
     * تنزيل ملف الأخطاء
     */
    public function downloadErrors($filename)
    {
        $path = storage_path('app/excel_errors/' . $filename . '.xlsx');
        if (file_exists($path)) {
            return response()->download($path, $filename . '.xlsx')->deleteFileAfterSend(false);
        }

        toastr()->error(trans('Excel_trans.file_not_found'));
        return redirect()->back();
    }

    /**
     * حفظ الأخطاء في ملف Excel
     */
    private function storeErrors($failures, $errors, $filename)
    {
        $errorData = [];

        foreach ($failures as $failure) {
            $errorData[] = [
                'الصف' => $failure->row(),
                'العمود' => $failure->attribute(),
                'القيمة' => implode(', ', $failure->values()),
                'الخطأ' => implode(', ', $failure->errors()),
            ];
        }

        foreach ($errors as $error) {
            $errorData[] = [
                'الصف' => '',
                'العمود' => '',
                'القيمة' => '',
                'الخطأ' => $error->getMessage(),
            ];
        }

        if (count($errorData) > 0) {
            $directory = storage_path('app/excel_errors');
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            Excel::store(new class($errorData) implements \Maatwebsite\Excel\Concerns\FromCollection, \Maatwebsite\Excel\Concerns\WithHeadings {
                private $data;
                public function __construct($data) { $this->data = collect($data); }
                public function collection() { return $this->data; }
                public function headings(): array { return ['الصف', 'العمود', 'القيمة', 'الخطأ']; }
            }, 'excel_errors/' . $filename . '.xlsx');
        }
    }

    /**
     * بناء الاستجابة بعد الاستيراد
     */
    private function buildResponse($failures, $errors, $errorFilename)
    {
        $failureCount = count($failures) + count($errors);

        if ($failureCount > 0) {
            toastr()->warning(trans('Excel_trans.import_with_errors', ['count' => $failureCount]));
            return redirect()->route('excel.index')->with([
                'has_errors' => true,
                'error_file' => $errorFilename,
                'error_count' => $failureCount,
            ]);
        }

        toastr()->success(trans('Excel_trans.import_success'));
        return redirect()->route('excel.index');
    }
}
