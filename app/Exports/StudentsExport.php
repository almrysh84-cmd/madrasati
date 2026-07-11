<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

/**
 * تصدير بيانات الطلاب إلى ملف Excel
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class StudentsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Student::with(['gender', 'nationalitie', 'blood', 'grade', 'classroom', 'section', 'myparent'])
            ->get();
    }

    /**
     * عناوين الأعمدة في ملف Excel
     */
    public function headings(): array
    {
        return [
            'الرقم',
            'الاسم (عربي)',
            'الاسم (إنجليزي)',
            'البريد الإلكتروني',
            'الجنس',
            'الجنسية',
            'فصيلة الدم',
            'تاريخ الميلاد',
            'المرحلة',
            'الصف',
            'القسم',
            'السنة الدراسية',
        ];
    }

    /**
     * تخطيط كل صف
     */
    public function map($student): array
    {
        return [
            $student->id,
            $student->getTranslation('name', 'ar'),
            $student->getTranslation('name', 'en'),
            $student->email,
            $student->gender ? $student->gender->getTranslation('Name', 'ar') : '',
            $student->nationalitie ? $student->nationalitie->getTranslation('Name', 'ar') : '',
            $student->blood ? $student->blood->Name : '',
            $student->Date_Birth,
            $student->grade ? $student->grade->getTranslation('Name', 'ar') : '',
            $student->classroom ? $student->classroom->getTranslation('Name_Class', 'ar') : '',
            $student->section ? $student->section->getTranslation('Name_Section', 'ar') : '',
            $student->academic_year,
        ];
    }
}
