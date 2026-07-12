<?php

namespace App\Imports;

use App\Models\Attendance;
use App\Models\Student;
use App\Models\Grade;
use App\Models\Classroom;
use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Throwable;

/**
 * استيراد بيانات الحضور والغياب من ملف Excel
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class AttendanceImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnError, SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;

    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $student = Student::where('email', $row['student_email'])->first();
            if (!$student) {
                continue;
            }

            // التحقق من عدم تكرار سجل الحضور لنفس الطالب في نفس اليوم
            $exists = Attendance::where('student_id', $student->id)
                ->where('attendence_date', $row['attendance_date'])
                ->exists();

            if ($exists) {
                continue;
            }

            // تحويل قيمة الحضور إلى قيمة منطقية (1 = حضور، 0 = غياب)
            $status = in_array(strtolower(trim($row['status'])), ['1', 'true', 'present', 'حاضر', 'حضور', 'نعم']) ? 1 : 0;

            Attendance::create([
                'student_id' => $student->id,
                'grade_id' => $student->Grade_id,
                'classroom_id' => $student->Classroom_id,
                'section_id' => $student->section_id,
                'teacher_id' => auth()->user()->id ?? Teacher::first()->id,
                'attendence_date' => $row['attendance_date'],
                'attendence_status' => $status,
            ]);
        }
    }

    /**
     * قواعد التحقق
     */
    public function rules(): array
    {
        return [
            'student_email' => 'required|email',
            'attendance_date' => 'required',
            'status' => 'required',
        ];
    }
}
