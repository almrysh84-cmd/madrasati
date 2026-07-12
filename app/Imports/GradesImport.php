<?php

namespace App\Imports;

use App\Models\Grade;
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
 * استيراد المراحل الدراسية من ملف Excel
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class GradesImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnError, SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;

    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // تفادي تكرار اسم المرحلة
            $existsAr = Grade::where('Name->ar', $row['name_ar'])->exists();
            $existsEn = Grade::where('Name->en', $row['name_en'] ?? $row['name_ar'])->exists();

            if ($existsAr || $existsEn) {
                continue;
            }

            Grade::create([
                'Name' => ['ar' => $row['name_ar'], 'en' => $row['name_en'] ?? $row['name_ar']],
                'Notes' => $row['notes'] ?? '',
            ]);
        }
    }

    /**
     * قواعد التحقق
     */
    public function rules(): array
    {
        return [
            'name_ar' => 'required',
        ];
    }
}
