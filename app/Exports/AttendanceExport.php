<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

/**
 * تصدير بيانات الحضور والغياب إلى ملف Excel
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class AttendanceExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Attendance::with(['students', 'grade', 'section'])->get();
    }

    /**
     * عناوين الأعمدة
     */
    public function headings(): array
    {
        return [
            'الرقم',
            'اسم الطالب',
            'البريد الإلكتروني',
            'المرحلة',
            'القسم',
            'تاريخ الحضور',
            'الحالة',
        ];
    }

    /**
     * تخطيط كل صف
     */
    public function map($attendance): array
    {
        return [
            $attendance->id,
            $attendance->students ? $attendance->students->getTranslation('name', 'ar') : '',
            $attendance->students ? $attendance->students->email : '',
            $attendance->grade ? $attendance->grade->getTranslation('Name', 'ar') : '',
            $attendance->section ? $attendance->section->getTranslation('Name_Section', 'ar') : '',
            $attendance->attendence_date,
            $attendance->attendence_status ? 'حاضر' : 'غائب',
        ];
    }
}
