<?php

namespace App\Exports;

use App\Models\Grade;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

/**
 * تصدير المراحل الدراسية إلى ملف Excel
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class GradesExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Grade::all();
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
            'ملاحظات',
        ];
    }

    /**
     * تخطيط كل صف
     */
    public function map($grade): array
    {
        return [
            $grade->id,
            $grade->getTranslation('Name', 'ar'),
            $grade->getTranslation('Name', 'en'),
            $grade->Notes,
        ];
    }
}
