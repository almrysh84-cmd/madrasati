<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\Gender;
use App\Models\Nationalitie;
use App\Models\Type_Blood;
use App\Models\Grade;
use App\Models\Classroom;
use App\Models\Section;
use App\Models\My_Parent;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
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
 * استيراد بيانات الطلاب من ملف Excel
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class StudentsImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnError, SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;

    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // التحقق من وجود البريد الإلكتروني وتفادي التكرار
            if (Student::where('email', $row['email'])->exists()) {
                continue;
            }

            // مطابقة الحقول النصية بالمعرفات الرقمية
            $gender = Gender::where('Name->ar', $row['gender'])->orWhere('Name->en', $row['gender'])->first();
            $nationalitie = Nationalitie::where('Name->ar', $row['nationality'])->orWhere('Name->en', $row['nationality'])->first();
            $blood = Type_Blood::where('Name', $row['blood_type'])->first();
            $grade = Grade::where('Name->ar', $row['grade'])->orWhere('Name->en', $row['grade'])->first();
            $classroom = Classroom::where('Name_Class->ar', $row['classroom'])->orWhere('Name_Class->en', $row['classroom'])->first();
            $section = Section::where('Name_Section->ar', $row['section'])->orWhere('Name_Section->en', $row['section'])->first();
            $parent = My_Parent::where('email', $row['parent_email'])->first();

            if (!$gender || !$nationalitie || !$blood || !$grade || !$classroom || !$section || !$parent) {
                continue;
            }

            Student::create([
                'name' => ['ar' => $row['name_ar'], 'en' => $row['name_en'] ?? $row['name_ar']],
                'email' => $row['email'],
                'password' => Hash::make($row['password'] ?? '12345678'),
                'gender_id' => $gender->id,
                'nationalitie_id' => $nationalitie->id,
                'blood_id' => $blood->id,
                'Date_Birth' => $row['date_birth'],
                'Grade_id' => $grade->id,
                'Classroom_id' => $classroom->id,
                'section_id' => $section->id,
                'parent_id' => $parent->id,
                'academic_year' => $row['academic_year'] ?? date('Y'),
            ]);
        }
    }

    /**
     * قواعد التحقق من صحة البيانات
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'name_ar' => 'required',
            'date_birth' => 'required',
            'gender' => 'required',
            'nationality' => 'required',
            'blood_type' => 'required',
            'grade' => 'required',
            'classroom' => 'required',
            'section' => 'required',
            'parent_email' => 'required|email',
        ];
    }
}
