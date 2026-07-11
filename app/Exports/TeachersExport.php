<?php

namespace App\Exports;

use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

/**
 * تصدير بيانات المعلمين إلى ملف Excel
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class TeachersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Teacher::with(['specializations', 'genders'])->get();
    }

    /**
     * عناوين الأعمدة
     */
    public function headings(): array
    {
        return [
            'الرقم',
            'الاسم (عربي)',
            'الاسم (إنجليزي)',
            'البريد الإلكتروني',
            'التخصص',
            'الجنس',
            'تاريخ الالتحاق',
            'العنوان',
        ];
    }

    /**
     * تخطيط كل صف
     */
    public function map($teacher): array
    {
        return [
            $teacher->id,
            $teacher->getTranslation('name', 'ar'),
            $teacher->getTranslation('name', 'en'),
            $teacher->email,
            $teacher->specializations ? $teacher->specializations->getTranslation('Name', 'ar') : '',
            $teacher->genders ? $teacher->genders->getTranslation('Name', 'ar') : '',
            $teacher->Joining_Date,
            $teacher->Address,
        ];
    }
}
