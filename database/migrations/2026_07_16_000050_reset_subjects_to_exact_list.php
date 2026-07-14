<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * تنظيف وإعادة إنشاء المواد الدراسية بالشكل الصحيح.
 *
 * المشكلة: migration سابق أنشأ مواد مكررة (أكثر من 100 مادة) لأنه أضاف
 * مواد لكل组合 grade+classroom بدون التحقق من التكرار.
 *
 * هذا الـ migration:
 * 1. يحذف كل المواد القديمة
 * 2. ينشئ المواد الصحيحة لكل صف دراسي (classroom) حسب القائمة المحددة
 *
 * المواد حسب الصف:
 * - الروضة (classroom_id=1): قرآن، تربية إسلامية، عربي، إنجليزي، رياضيات، سلوك، اجتماعيات، حاسوب
 * - الأول (classroom_id=2): قرآن، تربية إسلامية، عربي، إنجليزي، رياضيات، علوم، اجتماعيات، حاسوب
 * - الثاني (classroom_id=3): نفس الأول
 * - الثالث (classroom_id=4): نفس الأول
 * - الرابع (classroom_id=5): نفس الأول
 * - الخامس (classroom_id=6): نفس الأول
 * - السادس (classroom_id=7): نفس الأول
 * - السابع (classroom_id=8): نفس الأول
 * - الثامن (classroom_id=9): نفس الأول
 * - التاسع (classroom_id=10): قرآن، تربية إسلامية، عربي، إنجليزي، رياضيات، علوم، اجتماعيات (بدون حاسوب)
 * - الأول الثانوي (classroom_id=11): قرآن، تربية إسلامية، عربي، إنجليزي، رياضيات، فيزياء، كيمياء، أحياء، جغرافيا، تاريخ، مجتمع مدني، حاسوب
 * - الثاني الثانوي (classroom_id=12): قرآن، تربية إسلامية، عربي، إنجليزي، رياضيات، فيزياء، كيمياء، أحياء، حاسوب
 */
return new class extends Migration
{
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // 1. حذف كل المواد القديمة
        DB::table('subjects')->delete();
        echo "Deleted all old subjects.\n";

        // 2. جلب معلم افتراضي
        $defaultTeacherId = DB::table('teachers')->value('id') ?? 1;

        // 3. تعريف المواد لكل صف دراسي (classroom_id)
        $subjectsByClassroom = [
            // الروضة (classroom_id=1)
            1 => [
                ['ar' => 'القرآن الكريم', 'en' => 'Holy Quran'],
                ['ar' => 'التربية الإسلامية', 'en' => 'Islamic Education'],
                ['ar' => 'اللغة العربية', 'en' => 'Arabic Language'],
                ['ar' => 'اللغة الإنجليزية', 'en' => 'English Language'],
                ['ar' => 'الرياضيات', 'en' => 'Mathematics'],
                ['ar' => 'السلوك', 'en' => 'Behavior'],
                ['ar' => 'الاجتماعيات', 'en' => 'Social Studies'],
                ['ar' => 'الحاسوب', 'en' => 'Computer'],
            ],
            // الأول (classroom_id=2)
            2 => [
                ['ar' => 'القرآن الكريم', 'en' => 'Holy Quran'],
                ['ar' => 'التربية الإسلامية', 'en' => 'Islamic Education'],
                ['ar' => 'اللغة العربية', 'en' => 'Arabic Language'],
                ['ar' => 'اللغة الإنجليزية', 'en' => 'English Language'],
                ['ar' => 'الرياضيات', 'en' => 'Mathematics'],
                ['ar' => 'العلوم', 'en' => 'Science'],
                ['ar' => 'الاجتماعيات', 'en' => 'Social Studies'],
                ['ar' => 'الحاسوب', 'en' => 'Computer'],
            ],
            // الثاني (classroom_id=3) — نفس الأول
            3 => null, // will copy from 2
            // الثالث (classroom_id=4) — نفس الأول
            4 => null,
            // الرابع (classroom_id=5) — نفس الأول
            5 => null,
            // الخامس (classroom_id=6) — نفس الأول
            6 => null,
            // السادس (classroom_id=7) — نفس الأول
            7 => null,
            // السابع (classroom_id=8) — نفس الأول
            8 => null,
            // الثامن (classroom_id=9) — نفس الأول
            9 => null,
            // التاسع (classroom_id=10) — بدون حاسوب
            10 => [
                ['ar' => 'القرآن الكريم', 'en' => 'Holy Quran'],
                ['ar' => 'التربية الإسلامية', 'en' => 'Islamic Education'],
                ['ar' => 'اللغة العربية', 'en' => 'Arabic Language'],
                ['ar' => 'اللغة الإنجليزية', 'en' => 'English Language'],
                ['ar' => 'الرياضيات', 'en' => 'Mathematics'],
                ['ar' => 'العلوم', 'en' => 'Science'],
                ['ar' => 'الاجتماعيات', 'en' => 'Social Studies'],
            ],
            // الأول الثانوي (classroom_id=11)
            11 => [
                ['ar' => 'القرآن الكريم', 'en' => 'Holy Quran'],
                ['ar' => 'التربية الإسلامية', 'en' => 'Islamic Education'],
                ['ar' => 'اللغة العربية', 'en' => 'Arabic Language'],
                ['ar' => 'اللغة الإنجليزية', 'en' => 'English Language'],
                ['ar' => 'الرياضيات', 'en' => 'Mathematics'],
                ['ar' => 'الفيزياء', 'en' => 'Physics'],
                ['ar' => 'الكيمياء', 'en' => 'Chemistry'],
                ['ar' => 'الأحياء', 'en' => 'Biology'],
                ['ar' => 'الجغرافيا', 'en' => 'Geography'],
                ['ar' => 'التاريخ', 'en' => 'History'],
                ['ar' => 'المجتمع المدني', 'en' => 'Civic Society'],
                ['ar' => 'الحاسوب', 'en' => 'Computer'],
            ],
            // الثاني الثانوي (classroom_id=12)
            12 => [
                ['ar' => 'القرآن الكريم', 'en' => 'Holy Quran'],
                ['ar' => 'التربية الإسلامية', 'en' => 'Islamic Education'],
                ['ar' => 'اللغة العربية', 'en' => 'Arabic Language'],
                ['ar' => 'اللغة الإنجليزية', 'en' => 'English Language'],
                ['ar' => 'الرياضيات', 'en' => 'Mathematics'],
                ['ar' => 'الفيزياء', 'en' => 'Physics'],
                ['ar' => 'الكيمياء', 'en' => 'Chemistry'],
                ['ar' => 'الأحياء', 'en' => 'Biology'],
                ['ar' => 'الحاسوب', 'en' => 'Computer'],
            ],
        ];

        // 4. نسخ مواد الأول (classroom_id=2) للصفوف 3-9
        $basicSubjects = $subjectsByClassroom[2];
        for ($i = 3; $i <= 9; $i++) {
            $subjectsByClassroom[$i] = $basicSubjects;
        }

        // 5. جلب معلومات Grades لكل classroom
        $classrooms = DB::table('classrooms')->orderBy('id')->get();

        $created = 0;
        foreach ($classrooms as $classroom) {
            $cid = $classroom->id;
            $gid = $classroom->Grade_id;

            if (!isset($subjectsByClassroom[$cid])) {
                echo "  WARNING: No subjects defined for classroom_id=$cid\n";
                continue;
            }

            foreach ($subjectsByClassroom[$cid] as $subj) {
                $nameJson = json_encode($subj, JSON_UNESCAPED_UNICODE);
                DB::table('subjects')->insert([
                    'name'         => $nameJson,
                    'grade_id'     => $gid,
                    'classroom_id' => $cid,
                    'teacher_id'   => $defaultTeacherId,
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]);
                $created++;
            }
        }

        echo "Created $created subjects for " . count($classrooms) . " classrooms.\n";

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function down()
    {
        // No-op
    }
};
