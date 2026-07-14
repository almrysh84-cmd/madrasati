<?php

namespace App\Services;

use App\Models\Student;
use App\Models\Teacher;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentsImport;
use App\Exports\StudentsExport;
use App\Exports\TeachersExport;
use App\Exports\GradesExport;
use App\Exports\AttendanceExport;
use Illuminate\Support\Facades\Storage;
use Exception;

/**
 * خدمة الاستيراد والتصدير المتقدم.
 */
class ImportExportService
{
    /**
     * استيراد الطلاب من ملف Excel
     */
    public function importStudents($file): array
    {
        try {
            $import = new StudentsImport();
            Excel::import($import, $file);

            return [
                'success'  => true,
                'message'  => 'تم استيراد الطلاب بنجاح',
                'imported' => $import->getRowCount() ?? 0,
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'خطأ في الاستيراد: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * تصدير الطلاب إلى Excel
     */
    public function exportStudents(): string
    {
        $fileName = 'students_' . date('Y-m-d_His') . '.xlsx';
        Excel::store(new StudentsExport, $fileName, 'public');
        return $fileName;
    }

    /**
     * تصدير المعلمين
     */
    public function exportTeachers(): string
    {
        $fileName = 'teachers_' . date('Y-m-d_His') . '.xlsx';
        Excel::store(new TeachersExport, $fileName, 'public');
        return $fileName;
    }

    /**
     * تصدير الدرجات
     */
    public function exportGrades(int $subjectId = null, int $gradeId = null): string
    {
        $fileName = 'grades_' . date('Y-m-d_His') . '.xlsx';
        Excel::store(new GradesExport($subjectId, $gradeId), $fileName, 'public');
        return $fileName;
    }

    /**
     * تصدير الحضور
     */
    public function exportAttendance(string $from = null, string $to = null): string
    {
        $fileName = 'attendance_' . date('Y-m-d_His') . '.xlsx';
        Excel::store(new AttendanceExport($from, $to), $fileName, 'public');
        return $fileName;
    }

    /**
     * تحميل قالب جاهز للاستيراد
     */
    public function downloadTemplate(string $type): string
    {
        $templates = [
            'students' => 'templates/students_template.xlsx',
            'teachers' => 'templates/teachers_template.xlsx',
        ];

        $path = $templates[$type] ?? null;
        if (!$path || !Storage::disk('public')->exists($path)) {
            throw new Exception('القالب غير متوفر');
        }

        return $path;
    }
}
