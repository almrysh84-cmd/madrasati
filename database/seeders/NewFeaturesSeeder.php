<?php

namespace Database\Seeders;

use App\Models\QuestionBank;
use App\Models\Announcement;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * بذرة بيانات للميزات الجديدة (Features 1, 2, 3)
 *
 * تضيف بيانات تجريبية لـ:
 * - بنك الأسئلة المركزي (Feature 1)
 * - لوحة الإعلانات (Feature 3)
 * - لا تضيف بيانات لسجل الترقية التلقائية لأنها تعتمد على درجات الطلاب
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class NewFeaturesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ===== Feature 1: بنك الأسئلة المركزي =====
        $this->seedQuestionBank();

        // ===== Feature 3: لوحة الإعلانات =====
        $this->seedAnnouncements();
    }

    /**
     * بذرة بنك الأسئلة المركزي
     */
    private function seedQuestionBank()
    {
        DB::table('question_bank')->delete();

        $teacher = Teacher::first();
        $subject = Subject::first();
        $grade = Grade::first();

        if (!$teacher || !$subject || !$grade) {
            return;
        }

        $questions = [
            [
                'question'        => ['ar' => 'ما هي عاصمة مصر؟', 'en' => 'What is the capital of Egypt?'],
                'type'            => 'mcq',
                'options'         => ['القاهرة', 'الإسكندرية', 'الجيزة', 'أسوان'],
                'correct_answer'  => '0',
                'level'           => 'easy',
                'score'           => 1,
                'subject_id'      => $subject->id,
                'grade_id'        => $grade->id,
                'created_by'      => $teacher->id,
                'is_shared'       => true,
            ],
            [
                'question'        => ['ar' => 'كم يساوي 7 × 8 ؟', 'en' => 'What is 7 × 8 ?'],
                'type'            => 'mcq',
                'options'         => ['54', '56', '58', '64'],
                'correct_answer'  => '1',
                'level'           => 'medium',
                'score'           => 2,
                'subject_id'      => $subject->id,
                'grade_id'        => $grade->id,
                'created_by'      => $teacher->id,
                'is_shared'       => true,
            ],
            [
                'question'        => ['ar' => 'الأرض كوكب ثالث من الشمس.', 'en' => 'Earth is the third planet from the sun.'],
                'type'            => 'true_false',
                'options'         => null,
                'correct_answer'  => '1',
                'level'           => 'easy',
                'score'           => 1,
                'subject_id'      => $subject->id,
                'grade_id'        => $grade->id,
                'created_by'      => $teacher->id,
                'is_shared'       => true,
            ],
            [
                'question'        => ['ar' => 'اشرح أهمية الماء في حياة الإنسان.', 'en' => 'Explain the importance of water in human life.'],
                'type'            => 'essay',
                'options'         => null,
                'correct_answer'  => null,
                'level'           => 'hard',
                'score'           => 5,
                'subject_id'      => $subject->id,
                'grade_id'        => $grade->id,
                'created_by'      => $teacher->id,
                'is_shared'       => false,
            ],
            [
                'question'        => ['ar' => 'متى بدأت الحرب العالمية الأولى؟', 'en' => 'When did World War I begin?'],
                'type'            => 'mcq',
                'options'         => ['1912', '1914', '1916', '1918'],
                'correct_answer'  => '1',
                'level'           => 'medium',
                'score'           => 2,
                'subject_id'      => $subject->id,
                'grade_id'        => $grade->id,
                'created_by'      => $teacher->id,
                'is_shared'       => true,
            ],
        ];

        foreach ($questions as $q) {
            QuestionBank::create($q);
        }
    }

    /**
     * بذرة لوحة الإعلانات
     */
    private function seedAnnouncements()
    {
        DB::table('announcements')->delete();

        $admin = User::first();

        if (!$admin) {
            return;
        }

        $announcements = [
            [
                'title'           => 'مرحباً بكم في العام الدراسي الجديد',
                'body'            => 'نرحب بجميع الطلاب وأولياء الأمور في بداية العام الدراسي الجديد. نتمنى لكم عاماً دراسياً حافلاً بالنجاح والتقدم.',
                'target_audience' => 'all',
                'publish_at'      => now(),
                'is_published'    => true,
                'attachment'      => null,
                'created_by'      => $admin->id,
                'creator_type'    => 'admin',
            ],
            [
                'title'           => 'اجتماع أولياء الأمور',
                'body'            => 'ندعو جميع أولياء الأمور لحضور الاجتماع الدوري يوم السبت القادم الساعة العاشرة صباحاً في قاعة المدرسة.',
                'target_audience' => 'parents',
                'publish_at'      => now()->addDays(3),
                'is_published'    => true,
                'attachment'      => null,
                'created_by'      => $admin->id,
                'creator_type'    => 'admin',
            ],
            [
                'title'           => 'جدول امتحانات منتصف الفصل',
                'body'            => 'تم نشر جدول امتحانات منتصف الفصل الدراسي الأول. يرجى من الطلاب الاستعداد جيداً والالتزام بمواعيد الامتحانات.',
                'target_audience' => 'students',
                'publish_at'      => now()->subDay(),
                'is_published'    => true,
                'attachment'      => null,
                'created_by'      => $admin->id,
                'creator_type'    => 'admin',
            ],
            [
                'title'           => 'اجتماع هيئة التدريس',
                'body'            => 'اجتماع دوري لجميع المعلمين لمناقشة خطط التحصيل الدراسي وتقييم أداء الطلاب.',
                'target_audience' => 'teachers',
                'publish_at'      => now()->addDays(1),
                'is_published'    => true,
                'attachment'      => null,
                'created_by'      => $admin->id,
                'creator_type'    => 'admin',
            ],
            [
                'title'           => 'إعلان مسودة (غير منشور)',
                'body'            => 'هذا إعلان تجريبي غير منشور لاختبار وظيفة النشر.',
                'target_audience' => 'all',
                'publish_at'      => null,
                'is_published'    => false,
                'attachment'      => null,
                'created_by'      => $admin->id,
                'creator_type'    => 'admin',
            ],
        ];

        foreach ($announcements as $a) {
            Announcement::create($a);
        }
    }
}
