<?php

namespace App\Imports;

use App\Models\Grade;
use App\Models\QuestionBank;
use App\Models\Subject;
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
 * استيراد أسئلة بنك الأسئلة من ملف Excel
 *
 * المشروع: madrasati - نظام إدارة المدارس
 */
class QuestionBankImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnError, SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;

    protected $teacherId;
    protected $successCount = 0;
    protected $errorCount = 0;

    // خريطة تحويل أنواع الأسئلة من النص العربي إلى القيم البرمجية
    protected $typeMap = [
        'اختيار من متعدد' => 'mcq',
        'mcq' => 'mcq',
        'صح/خطأ' => 'true_false',
        'صح / خطأ' => 'true_false',
        'true_false' => 'true_false',
        'true/false' => 'true_false',
        'مقالي' => 'essay',
        'essay' => 'essay',
    ];

    // خريطة تحويل مستويات الصعوبة
    protected $levelMap = [
        'سهل' => 'easy',
        'easy' => 'easy',
        'متوسط' => 'medium',
        'medium' => 'medium',
        'صعب' => 'hard',
        'hard' => 'hard',
    ];

    public function __construct($teacherId = null)
    {
        $this->teacherId = $teacherId;
    }

    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            try {
                // تحويل الأعمدة - تدعم كلاً من العربية والإنجليزية
                $questionAr = $row['question_ar'] ?? $row['السؤال_بالعربي'] ?? null;
                $typeText = $row['type'] ?? $row['النوع'] ?? null;
                $levelText = $row['level'] ?? $row['المستوى'] ?? null;
                $subjectName = $row['subject'] ?? $row['المادة'] ?? null;
                $gradeName = $row['grade'] ?? $row['المرحلة'] ?? null;
                $optionsText = $row['options'] ?? $row['الخيارات'] ?? null;
                $correctAnswer = $row['correct_answer'] ?? $row['الإجابة_الصحيحة'] ?? null;
                $score = $row['score'] ?? $row['الدرجة'] ?? 1;

                if (!$questionAr || !$typeText || !$subjectName || !$gradeName) {
                    $this->errorCount++;
                    continue;
                }

                // تحويل نوع السؤال
                $type = $this->typeMap[trim($typeText)] ?? null;
                if (!$type) {
                    $this->errorCount++;
                    continue;
                }

                // تحويل مستوى الصعوبة
                $level = $this->levelMap[trim($levelText)] ?? 'medium';

                // مطابقة المادة والمرحلة بالاسم
                $subject = Subject::where('name->ar', $subjectName)->orWhere('name->en', $subjectName)->first();
                $grade = Grade::where('Name->ar', $gradeName)->orWhere('Name->en', $gradeName)->first();

                if (!$subject || !$grade) {
                    $this->errorCount++;
                    continue;
                }

                // معالجة الخيارات
                $options = null;
                if ($type === 'mcq' && $optionsText) {
                    $options = array_map('trim', explode('|', $optionsText));
                    $options = array_filter($options, function ($opt) {
                        return $opt !== '';
                    });
                    $options = array_values($options);
                    if (count($options) < 2) {
                        $this->errorCount++;
                        continue;
                    }
                } elseif ($type === 'true_false') {
                    $options = ['صح', 'خطأ'];
                }

                QuestionBank::create([
                    'question' => ['ar' => $questionAr, 'en' => $questionAr],
                    'type' => $type,
                    'level' => $level,
                    'score' => is_numeric($score) ? $score : 1,
                    'subject_id' => $subject->id,
                    'grade_id' => $grade->id,
                    'created_by' => $this->teacherId,
                    'is_shared' => true,
                    'options' => $options,
                    'correct_answer' => $correctAnswer,
                ]);

                $this->successCount++;
            } catch (Throwable $e) {
                $this->errorCount++;
            }
        }
    }

    /**
     * قواعد التحقق من صحة البيانات
     */
    public function rules(): array
    {
        return [
            'type' => 'required',
            'score' => 'nullable|numeric',
        ];
    }

    public function getSuccessCount()
    {
        return $this->successCount;
    }

    public function getErrorCount()
    {
        return $this->errorCount;
    }
}
