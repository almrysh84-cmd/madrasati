<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class QuestionBank extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['question'];

    protected $guarded = [];

    protected $table = 'question_bank';

    // خيارات الإجاجة يتم تخزينها كـ JSON
    protected $casts = [
        'options' => 'array',
        'is_shared' => 'boolean',
    ];

    // جلب المادة الدراسية المرتبطة بالسؤال
    public function subject()
    {
        return $this->belongsTo('App\Models\Subject', 'subject_id');
    }

    // جلب المرحلة الدراسية المرتبطة بالسؤال
    public function grade()
    {
        return $this->belongsTo('App\Models\Grade', 'grade_id');
    }

    // جلب المعلم الذي أنشأ السؤال
    public function creator()
    {
        return $this->belongsTo('App\Models\Teacher', 'created_by');
    }

    /**
     * الحصول على نص نوع السؤال بالعربية
     */
    public function getTypeTextAttribute()
    {
        $types = [
            'mcq' => 'اختيار من متعدد',
            'true_false' => 'صح / خطأ',
            'essay' => 'مقالي',
        ];
        return $types[$this->type] ?? $this->type;
    }

    /**
     * الحصول على نص مستوى الصعوبة بالعربية
     */
    public function getLevelTextAttribute()
    {
        $levels = [
            'easy' => 'سهل',
            'medium' => 'متوسط',
            'hard' => 'صعب',
        ];
        return $levels[$this->level] ?? $this->level;
    }

    /**
     * الحصول على لون شارة مستوى الصعوبة
     */
    public function getLevelColorAttribute()
    {
        $colors = [
            'easy' => 'success',
            'medium' => 'warning',
            'hard' => 'danger',
        ];
        return $colors[$this->level] ?? 'info';
    }

    /**
     * الحصول على لون شارة نوع السؤال
     */
    public function getTypeColorAttribute()
    {
        $colors = [
            'mcq' => 'primary',
            'true_false' => 'info',
            'essay' => 'warning',
        ];
        return $colors[$this->type] ?? 'secondary';
    }
}
