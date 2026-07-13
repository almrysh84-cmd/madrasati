<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * تنظيم المواد الدراسية النموذجية.
 *
 * المستخدم طلب المواد التالية:
 * - المرحلة الأساسية (كل الصفوف): القرآن الكريم، التربية الإسلامية، اللغة العربية،
 *   اللغة الإنجليزية، الرياضيات، الاجتماعيات (تاريخ + وطنية + جغرافيا)، العلوم
 * - المرحلة الثانوية: الكيمياء، الفيزياء، الأحياء، التاريخ، الجغرافيا، المجتمع
 *
 * هذا الـ migration يُنشئ هذه المواد لكل صف دراسي موجود في النظام
 * (مرتبطة بالمعلم الافتراضي إذا لم يكن هناك معلم مخصص).
 *
 * Idempotent: يتحقق من وجود المادة قبل إنشائها (updateOrInsert).
 */
return new class extends Migration
{
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // جلب كل المراحل والصفوف
        $grades = DB::table('grades')->orderBy('id')->get();
        $classrooms = DB::table('classrooms')->orderBy('id')->get();

        // جلب معلم افتراضي (أول معلم)
        $defaultTeacherId = DB::table('teachers')->value('id') ?? 1;

        // المواد الأساسية لكل المراحل
        $basicSubjects = [
            ['ar' => 'القرآن الكريم', 'en' => 'Holy Quran'],
            ['ar' => 'التربية الإسلامية', 'en' => 'Islamic Education'],
            ['ar' => 'اللغة العربية', 'en' => 'Arabic Language'],
            ['ar' => 'اللغة الإنجليزية', 'en' => 'English Language'],
            ['ar' => 'الرياضيات', 'en' => 'Mathematics'],
            ['ar' => 'العلوم', 'en' => 'Science'],
            ['ar' => 'التاريخ', 'en' => 'History'],
            ['ar' => 'الجغرافيا', 'en' => 'Geography'],
            ['ar' => 'التربية الوطنية', 'en' => 'National Education'],
        ];

        // مواد إضافية للمرحلة الثانوية فقط
        $secondarySubjects = [
            ['ar' => 'الكيمياء', 'en' => 'Chemistry'],
            ['ar' => 'الفيزياء', 'en' => 'Physics'],
            ['ar' => 'الأحياء', 'en' => 'Biology'],
            ['ar' => 'علم المجتمع', 'en' => 'Sociology'],
        ];

        $created = 0;
        foreach ($grades as $grade) {
            // تحديد إذا كانت المرحلة ثانوية (الاسم يحوي "ثانوي" أو ID >= مرحلة معينة)
            $gradeName = '';
            $nameDecoded = json_decode($grade->Name, true);
            if (is_array($nameDecoded)) {
                $gradeName = $nameDecoded['ar'] ?? '';
            } else {
                $gradeName = $grade->Name;
            }
            $isSecondary = (strpos($gradeName, 'ثانوي') !== false ||
                            strpos($gradeName, 'الثانوية') !== false ||
                            strpos($gradeName, 'Secondary') !== false);

            foreach ($classrooms as $classroom) {
                if ($classroom->Grade_id != $grade->id) continue;

                // المواد الأساسية
                foreach ($basicSubjects as $subj) {
                    $nameJson = json_encode($subj, JSON_UNESCAPED_UNICODE);
                    $exists = DB::table('subjects')
                        ->where('name', $nameJson)
                        ->where('grade_id', $grade->id)
                        ->where('classroom_id', $classroom->id)
                        ->exists();
                    if (!$exists) {
                        DB::table('subjects')->insert([
                            'name'          => $nameJson,
                            'grade_id'      => $grade->id,
                            'classroom_id'  => $classroom->id,
                            'teacher_id'    => $defaultTeacherId,
                            'created_at'    => now(),
                            'updated_at'    => now(),
                        ]);
                        $created++;
                    }
                }

                // مواد إضافية للثانوي
                if ($isSecondary) {
                    foreach ($secondarySubjects as $subj) {
                        $nameJson = json_encode($subj, JSON_UNESCAPED_UNICODE);
                        $exists = DB::table('subjects')
                            ->where('name', $nameJson)
                            ->where('grade_id', $grade->id)
                            ->where('classroom_id', $classroom->id)
                            ->exists();
                        if (!$exists) {
                            DB::table('subjects')->insert([
                                'name'          => $nameJson,
                                'grade_id'      => $grade->id,
                                'classroom_id'  => $classroom->id,
                                'teacher_id'    => $defaultTeacherId,
                                'created_at'    => now(),
                                'updated_at'    => now(),
                            ]);
                            $created++;
                        }
                    }
                }
            }
        }

        echo "Created $created new subjects.\n";
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function down()
    {
        // No-op
    }
};
