<?php

namespace App\Exports;

use App\Models\QuestionBank;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

/**
 * تصدير أسئلة بنك الأسئلة إلى ملف Excel
 *
 * المشروع: madrasati - نظام إدارة المدارس
 */
class QuestionBankExport implements FromCollection, WithHeadings, WithMapping
{
    protected $teacherId;

    public function __construct($teacherId = null)
    {
        $this->teacherId = $teacherId;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = QuestionBank::with(['subject', 'grade', 'creator']);

        if ($this->teacherId) {
            $query->where('created_by', $this->teacherId)
                  ->orWhere('is_shared', true);
        }

        return $query->get();
    }

    /**
     * عناوين الأعمدة في ملف Excel
     */
    public function headings(): array
    {
        return [
            'الرقم',
            'نص السؤال (عربي)',
            'نص السؤال (إنجليزي)',
            'النوع',
            'المستوى',
            'الدرجة',
            'الخيارات (مفصولة بـ |)',
            'الإجابة الصحيحة',
            'المادة',
            'المرحلة',
            'أنشأها المعلم',
            'مشترك',
            'تاريخ الإنشاء',
        ];
    }

    /**
     * تخطيط كل صف
     */
    public function map($question): array
    {
        $typeMap = [
            'mcq' => 'اختيار من متعدد',
            'true_false' => 'صح/خطأ',
            'essay' => 'مقالي',
        ];
        $levelMap = [
            'easy' => 'سهل',
            'medium' => 'متوسط',
            'hard' => 'صعب',
        ];

        return [
            $question->id,
            $question->getTranslation('question', 'ar'),
            $question->getTranslation('question', 'en'),
            $typeMap[$question->type] ?? $question->type,
            $levelMap[$question->level] ?? $question->level,
            $question->score,
            $question->options ? implode(' | ', $question->options) : '',
            $question->correct_answer ?? '',
            $question->subject ? $question->subject->getTranslation('name', 'ar') : '',
            $question->grade ? $question->grade->getTranslation('Name', 'ar') : '',
            $question->creator ? $question->creator->getTranslation('Name', 'ar') : '',
            $question->is_shared ? 'نعم' : 'لا',
            $question->created_at->format('Y-m-d H:i'),
        ];
    }
}
