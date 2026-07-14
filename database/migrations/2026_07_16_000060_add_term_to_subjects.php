<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * إضافة عمود 'term' لجدول subjects + إعادة إنشاء المواد بالترمين.
 *
 * الهيكل:
 * - كل صف دراسي (classroom) له ترمان: term=1 (الفصل الأول) و term=2 (الفصل الثاني)
 * - كل ترم يحوي نفس المواد لنفس الصف
 * - إجمالي المواد = عدد المواد لكل صف × 2 ترم × 12 صف
 *
 * المواد حسب الصف (نفس القائمة لكلا الترمين):
 * - الروضة (classroom_id=1): 8 مواد
 * - الأول-الثامن (classroom_id=2-9): 8 مواد لكل صف
 * - التاسع (classroom_id=10): 7 مواد
 * - الأول الثانوي (classroom_id=11): 12 مادة
 * - الثاني الثانوي (classroom_id=12): 9 مواد
 */
return new class extends Migration
{
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // 1. إضافة عمود term إذا لم يكن موجوداً
        if (!Schema::hasColumn('subjects', 'term')) {
            Schema::table('subjects', function (Blueprint $table) {
                $table->tinyInteger('term')->default(1)->after('classroom_id');
                $table->index('term');
            });
            echo "Added 'term' column to subjects table.\n";
        }

        // 2. حذف كل المواد القديمة
        DB::table('subjects')->delete();
        echo "Deleted all old subjects.\n";

        // 3. جلب معلم افتراضي
        $defaultTeacherId = DB::table('teachers')->value('id') ?? 1;

        // 4. تعريف المواد لكل صف دراسي (classroom_id)
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
            // الثاني-الثامن (classroom_id=3-9) — نفس الأول
            3 => null, 4 => null, 5 => null, 6 => null,
            7 => null, 8 => null, 9 => null,
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

        // نسخ مواد الأول (classroom_id=2) للصفوف 3-9
        $basicSubjects = $subjectsByClassroom[2];
        for ($i = 3; $i <= 9; $i++) {
            $subjectsByClassroom[$i] = $basicSubjects;
        }

        // 5. جلب معلومات Grades لكل classroom
        $classrooms = DB::table('classrooms')->orderBy('id')->get();

        $created = 0;
        // إنشاء المواد لكلا الترمين (1 و 2)
        foreach ([1, 2] as $term) {
            foreach ($classrooms as $classroom) {
                $cid = $classroom->id;
                $gid = $classroom->Grade_id;

                if (!isset($subjectsByClassroom[$cid])) continue;

                foreach ($subjectsByClassroom[$cid] as $subj) {
                    $nameJson = json_encode($subj, JSON_UNESCAPED_UNICODE);
                    DB::table('subjects')->insert([
                        'name'         => $nameJson,
                        'grade_id'     => $gid,
                        'classroom_id' => $cid,
                        'term'         => $term,
                        'teacher_id'   => $defaultTeacherId,
                        'created_at'   => now(),
                        'updated_at'   => now(),
                    ]);
                    $created++;
                }
            }
        }

        echo "Created $created subjects (2 terms × 12 classrooms).\n";

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function down()
    {
        if (Schema::hasColumn('subjects', 'term')) {
            Schema::table('subjects', function (Blueprint $table) {
                $table->dropColumn('term');
            });
        }
    }
};
