<?php

namespace App\Imports;

use App\Models\Teacher;
use App\Models\Gender;
use App\Models\Specialization;
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
 * استيراد بيانات المعلمين من ملف Excel
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class TeachersImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnError, SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;

    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // تفادي تكرار البريد الإلكتروني
            if (Teacher::where('email', $row['email'])->exists()) {
                continue;
            }

            $gender = Gender::where('Name->ar', $row['gender'])->orWhere('Name->en', $row['gender'])->first();
            $specialization = Specialization::where('Name->ar', $row['specialization'])->orWhere('Name->en', $row['specialization'])->first();

            if (!$gender || !$specialization) {
                continue;
            }

            Teacher::create([
                'email' => $row['email'],
                'password' => Hash::make($row['password'] ?? '12345678'),
                'name' => ['ar' => $row['name_ar'], 'en' => $row['name_en'] ?? $row['name_ar']],
                'Specialization_id' => $specialization->id,
                'Gender_id' => $gender->id,
                'Joining_Date' => $row['joining_date'],
                'Address' => $row['address'] ?? '',
            ]);
        }
    }

    /**
     * قواعد التحقق
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'name_ar' => 'required',
            'joining_date' => 'required',
            'gender' => 'required',
            'specialization' => 'required',
        ];
    }
}
