<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * SchoolDataSeeder - يستورد بيانات مدرسة السعيد ذي عنقب
 * العام الدراسي: 2023/2024م
 * المحافظة: تعز - المديرية: مشرعة وحدنان
 *
 * إجمالي الطلاب: 333
 * إجمالي المواد: 118
 * إجمالي الدرجات: 2248
 */
class SchoolDataSeeder extends Seeder
{
    public function run()
    {
        // تعطيل فحص المفاتيح الأجنبية مؤقتاً
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // ========================================
        // 1. المراحل الدراسية (Grades)
        // ========================================
        DB::table('grades')->updateOrInsert(
            ['id' => 1],
            ['Name' => json_encode(['ar' => 'الروضة', 'en' => 'Kindergarten'], JSON_UNESCAPED_UNICODE), 'Notes' => '', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('grades')->updateOrInsert(
            ['id' => 2],
            ['Name' => json_encode(['ar' => 'المرحلة الأساسية الدنيا', 'en' => 'Lower Basic Education'], JSON_UNESCAPED_UNICODE), 'Notes' => '', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('grades')->updateOrInsert(
            ['id' => 3],
            ['Name' => json_encode(['ar' => 'المرحلة الأساسية العليا', 'en' => 'Upper Basic Education'], JSON_UNESCAPED_UNICODE), 'Notes' => '', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('grades')->updateOrInsert(
            ['id' => 4],
            ['Name' => json_encode(['ar' => 'المرحلة الثانوية', 'en' => 'Secondary Education'], JSON_UNESCAPED_UNICODE), 'Notes' => '', 'created_at' => now(), 'updated_at' => now()]
        );

        // ========================================
        // 2. الصفوف الدراسية (Classrooms)
        // ========================================
        DB::table('classrooms')->updateOrInsert(
            ['id' => 1],
            ['Name_Class' => json_encode(['ar' => 'الروضة 2', 'en' => 'KG2'], JSON_UNESCAPED_UNICODE), 'Grade_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('classrooms')->updateOrInsert(
            ['id' => 2],
            ['Name_Class' => json_encode(['ar' => 'الأول', 'en' => 'First Grade'], JSON_UNESCAPED_UNICODE), 'Grade_id' => 2, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('classrooms')->updateOrInsert(
            ['id' => 3],
            ['Name_Class' => json_encode(['ar' => 'الثاني', 'en' => 'Second Grade'], JSON_UNESCAPED_UNICODE), 'Grade_id' => 2, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('classrooms')->updateOrInsert(
            ['id' => 4],
            ['Name_Class' => json_encode(['ar' => 'الثالث', 'en' => 'Third Grade'], JSON_UNESCAPED_UNICODE), 'Grade_id' => 2, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('classrooms')->updateOrInsert(
            ['id' => 5],
            ['Name_Class' => json_encode(['ar' => 'الرابع', 'en' => 'Fourth Grade'], JSON_UNESCAPED_UNICODE), 'Grade_id' => 3, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('classrooms')->updateOrInsert(
            ['id' => 6],
            ['Name_Class' => json_encode(['ar' => 'الخامس', 'en' => 'Fifth Grade'], JSON_UNESCAPED_UNICODE), 'Grade_id' => 3, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('classrooms')->updateOrInsert(
            ['id' => 7],
            ['Name_Class' => json_encode(['ar' => 'السادس', 'en' => 'Sixth Grade'], JSON_UNESCAPED_UNICODE), 'Grade_id' => 3, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('classrooms')->updateOrInsert(
            ['id' => 8],
            ['Name_Class' => json_encode(['ar' => 'السابع', 'en' => 'Seventh Grade'], JSON_UNESCAPED_UNICODE), 'Grade_id' => 3, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('classrooms')->updateOrInsert(
            ['id' => 9],
            ['Name_Class' => json_encode(['ar' => 'الثامن', 'en' => 'Eighth Grade'], JSON_UNESCAPED_UNICODE), 'Grade_id' => 3, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('classrooms')->updateOrInsert(
            ['id' => 10],
            ['Name_Class' => json_encode(['ar' => 'التاسع', 'en' => 'Ninth Grade'], JSON_UNESCAPED_UNICODE), 'Grade_id' => 3, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('classrooms')->updateOrInsert(
            ['id' => 11],
            ['Name_Class' => json_encode(['ar' => 'الأول الثانوي', 'en' => 'First Secondary'], JSON_UNESCAPED_UNICODE), 'Grade_id' => 4, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('classrooms')->updateOrInsert(
            ['id' => 12],
            ['Name_Class' => json_encode(['ar' => 'الثاني العلمي', 'en' => 'Second Scientific'], JSON_UNESCAPED_UNICODE), 'Grade_id' => 4, 'created_at' => now(), 'updated_at' => now()]
        );

        // ========================================
        // 2b. الأقسام (Sections) - قسم واحد لكل صف
        // ========================================
        DB::table('sections')->truncate();
        DB::table('sections')->updateOrInsert(
            ['id' => 1],
            ['Name_Section' => json_encode(['ar' => 'أ', 'en' => 'A'], JSON_UNESCAPED_UNICODE), 'Status' => 1, 'Grade_id' => 1, 'Class_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('sections')->updateOrInsert(
            ['id' => 2],
            ['Name_Section' => json_encode(['ar' => 'أ', 'en' => 'A'], JSON_UNESCAPED_UNICODE), 'Status' => 1, 'Grade_id' => 2, 'Class_id' => 2, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('sections')->updateOrInsert(
            ['id' => 3],
            ['Name_Section' => json_encode(['ar' => 'أ', 'en' => 'A'], JSON_UNESCAPED_UNICODE), 'Status' => 1, 'Grade_id' => 2, 'Class_id' => 3, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('sections')->updateOrInsert(
            ['id' => 4],
            ['Name_Section' => json_encode(['ar' => 'أ', 'en' => 'A'], JSON_UNESCAPED_UNICODE), 'Status' => 1, 'Grade_id' => 2, 'Class_id' => 4, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('sections')->updateOrInsert(
            ['id' => 5],
            ['Name_Section' => json_encode(['ar' => 'أ', 'en' => 'A'], JSON_UNESCAPED_UNICODE), 'Status' => 1, 'Grade_id' => 3, 'Class_id' => 5, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('sections')->updateOrInsert(
            ['id' => 6],
            ['Name_Section' => json_encode(['ar' => 'أ', 'en' => 'A'], JSON_UNESCAPED_UNICODE), 'Status' => 1, 'Grade_id' => 3, 'Class_id' => 6, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('sections')->updateOrInsert(
            ['id' => 7],
            ['Name_Section' => json_encode(['ar' => 'أ', 'en' => 'A'], JSON_UNESCAPED_UNICODE), 'Status' => 1, 'Grade_id' => 3, 'Class_id' => 7, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('sections')->updateOrInsert(
            ['id' => 8],
            ['Name_Section' => json_encode(['ar' => 'أ', 'en' => 'A'], JSON_UNESCAPED_UNICODE), 'Status' => 1, 'Grade_id' => 3, 'Class_id' => 8, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('sections')->updateOrInsert(
            ['id' => 9],
            ['Name_Section' => json_encode(['ar' => 'أ', 'en' => 'A'], JSON_UNESCAPED_UNICODE), 'Status' => 1, 'Grade_id' => 3, 'Class_id' => 9, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('sections')->updateOrInsert(
            ['id' => 10],
            ['Name_Section' => json_encode(['ar' => 'أ', 'en' => 'A'], JSON_UNESCAPED_UNICODE), 'Status' => 1, 'Grade_id' => 3, 'Class_id' => 10, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('sections')->updateOrInsert(
            ['id' => 11],
            ['Name_Section' => json_encode(['ar' => 'أ', 'en' => 'A'], JSON_UNESCAPED_UNICODE), 'Status' => 1, 'Grade_id' => 4, 'Class_id' => 11, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('sections')->updateOrInsert(
            ['id' => 12],
            ['Name_Section' => json_encode(['ar' => 'أ', 'en' => 'A'], JSON_UNESCAPED_UNICODE), 'Status' => 1, 'Grade_id' => 4, 'Class_id' => 12, 'created_at' => now(), 'updated_at' => now()]
        );

        // ========================================
        // 3. المواد الدراسية (Subjects)
        // ========================================
        DB::table('subjects')->truncate();
        DB::table('subjects')->updateOrInsert(
            ['id' => 1],
            ['name' => json_encode(['ar' => 'القرآن الكريم', 'en' => 'القرآن الكريم'], JSON_UNESCAPED_UNICODE), 'grade_id' => 1, 'classroom_id' => 1, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 2],
            ['name' => json_encode(['ar' => 'التربية الإسلامية', 'en' => 'التربية الإسلامية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 1, 'classroom_id' => 1, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 3],
            ['name' => json_encode(['ar' => 'اللغة العربية', 'en' => 'اللغة العربية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 1, 'classroom_id' => 1, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 4],
            ['name' => json_encode(['ar' => 'اللغة الإنجليزية', 'en' => 'اللغة الإنجليزية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 1, 'classroom_id' => 1, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 5],
            ['name' => json_encode(['ar' => 'الرياضيات', 'en' => 'الرياضيات'], JSON_UNESCAPED_UNICODE), 'grade_id' => 1, 'classroom_id' => 1, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 6],
            ['name' => json_encode(['ar' => 'السلوك', 'en' => 'السلوك'], JSON_UNESCAPED_UNICODE), 'grade_id' => 1, 'classroom_id' => 1, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 7],
            ['name' => json_encode(['ar' => 'الاجتماعيات', 'en' => 'الاجتماعيات'], JSON_UNESCAPED_UNICODE), 'grade_id' => 1, 'classroom_id' => 1, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 8],
            ['name' => json_encode(['ar' => 'الفنية', 'en' => 'الفنية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 1, 'classroom_id' => 1, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 9],
            ['name' => json_encode(['ar' => 'البدنية', 'en' => 'البدنية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 1, 'classroom_id' => 1, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 10],
            ['name' => json_encode(['ar' => 'الحاسوب', 'en' => 'الحاسوب'], JSON_UNESCAPED_UNICODE), 'grade_id' => 1, 'classroom_id' => 1, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 11],
            ['name' => json_encode(['ar' => 'القرآن الكريم', 'en' => 'القرآن الكريم'], JSON_UNESCAPED_UNICODE), 'grade_id' => 2, 'classroom_id' => 2, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 12],
            ['name' => json_encode(['ar' => 'التربية الإسلامية', 'en' => 'التربية الإسلامية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 2, 'classroom_id' => 2, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 13],
            ['name' => json_encode(['ar' => 'اللغة العربية', 'en' => 'اللغة العربية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 2, 'classroom_id' => 2, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 14],
            ['name' => json_encode(['ar' => 'اللغة الإنجليزية', 'en' => 'اللغة الإنجليزية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 2, 'classroom_id' => 2, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 15],
            ['name' => json_encode(['ar' => 'الرياضيات', 'en' => 'الرياضيات'], JSON_UNESCAPED_UNICODE), 'grade_id' => 2, 'classroom_id' => 2, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 16],
            ['name' => json_encode(['ar' => 'العلوم', 'en' => 'العلوم'], JSON_UNESCAPED_UNICODE), 'grade_id' => 2, 'classroom_id' => 2, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 17],
            ['name' => json_encode(['ar' => 'الاجتماعيات', 'en' => 'الاجتماعيات'], JSON_UNESCAPED_UNICODE), 'grade_id' => 2, 'classroom_id' => 2, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 18],
            ['name' => json_encode(['ar' => 'الفنية', 'en' => 'الفنية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 2, 'classroom_id' => 2, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 19],
            ['name' => json_encode(['ar' => 'البدنية', 'en' => 'البدنية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 2, 'classroom_id' => 2, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 20],
            ['name' => json_encode(['ar' => 'الحاسوب', 'en' => 'الحاسوب'], JSON_UNESCAPED_UNICODE), 'grade_id' => 2, 'classroom_id' => 2, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 21],
            ['name' => json_encode(['ar' => 'القرآن الكريم', 'en' => 'القرآن الكريم'], JSON_UNESCAPED_UNICODE), 'grade_id' => 2, 'classroom_id' => 3, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 22],
            ['name' => json_encode(['ar' => 'التربية الإسلامية', 'en' => 'التربية الإسلامية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 2, 'classroom_id' => 3, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 23],
            ['name' => json_encode(['ar' => 'اللغة العربية', 'en' => 'اللغة العربية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 2, 'classroom_id' => 3, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 24],
            ['name' => json_encode(['ar' => 'اللغة الإنجليزية', 'en' => 'اللغة الإنجليزية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 2, 'classroom_id' => 3, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 25],
            ['name' => json_encode(['ar' => 'الرياضيات', 'en' => 'الرياضيات'], JSON_UNESCAPED_UNICODE), 'grade_id' => 2, 'classroom_id' => 3, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 26],
            ['name' => json_encode(['ar' => 'العلوم', 'en' => 'العلوم'], JSON_UNESCAPED_UNICODE), 'grade_id' => 2, 'classroom_id' => 3, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 27],
            ['name' => json_encode(['ar' => 'الاجتماعيات', 'en' => 'الاجتماعيات'], JSON_UNESCAPED_UNICODE), 'grade_id' => 2, 'classroom_id' => 3, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 28],
            ['name' => json_encode(['ar' => 'الفنية', 'en' => 'الفنية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 2, 'classroom_id' => 3, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 29],
            ['name' => json_encode(['ar' => 'البدنية', 'en' => 'البدنية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 2, 'classroom_id' => 3, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 30],
            ['name' => json_encode(['ar' => 'الحاسوب', 'en' => 'الحاسوب'], JSON_UNESCAPED_UNICODE), 'grade_id' => 2, 'classroom_id' => 3, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 31],
            ['name' => json_encode(['ar' => 'القرآن الكريم', 'en' => 'القرآن الكريم'], JSON_UNESCAPED_UNICODE), 'grade_id' => 2, 'classroom_id' => 4, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 32],
            ['name' => json_encode(['ar' => 'التربية الإسلامية', 'en' => 'التربية الإسلامية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 2, 'classroom_id' => 4, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 33],
            ['name' => json_encode(['ar' => 'اللغة العربية', 'en' => 'اللغة العربية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 2, 'classroom_id' => 4, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 34],
            ['name' => json_encode(['ar' => 'اللغة الإنجليزية', 'en' => 'اللغة الإنجليزية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 2, 'classroom_id' => 4, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 35],
            ['name' => json_encode(['ar' => 'الرياضيات', 'en' => 'الرياضيات'], JSON_UNESCAPED_UNICODE), 'grade_id' => 2, 'classroom_id' => 4, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 36],
            ['name' => json_encode(['ar' => 'العلوم', 'en' => 'العلوم'], JSON_UNESCAPED_UNICODE), 'grade_id' => 2, 'classroom_id' => 4, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 37],
            ['name' => json_encode(['ar' => 'الاجتماعيات', 'en' => 'الاجتماعيات'], JSON_UNESCAPED_UNICODE), 'grade_id' => 2, 'classroom_id' => 4, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 38],
            ['name' => json_encode(['ar' => 'الفنية', 'en' => 'الفنية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 2, 'classroom_id' => 4, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 39],
            ['name' => json_encode(['ar' => 'البدنية', 'en' => 'البدنية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 2, 'classroom_id' => 4, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 40],
            ['name' => json_encode(['ar' => 'الحاسوب', 'en' => 'الحاسوب'], JSON_UNESCAPED_UNICODE), 'grade_id' => 2, 'classroom_id' => 4, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 41],
            ['name' => json_encode(['ar' => 'القرآن الكريم', 'en' => 'القرآن الكريم'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 5, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 42],
            ['name' => json_encode(['ar' => 'التربية الإسلامية', 'en' => 'التربية الإسلامية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 5, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 43],
            ['name' => json_encode(['ar' => 'اللغة العربية', 'en' => 'اللغة العربية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 5, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 44],
            ['name' => json_encode(['ar' => 'اللغة الإنجليزية', 'en' => 'اللغة الإنجليزية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 5, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 45],
            ['name' => json_encode(['ar' => 'الرياضيات', 'en' => 'الرياضيات'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 5, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 46],
            ['name' => json_encode(['ar' => 'العلوم', 'en' => 'العلوم'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 5, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 47],
            ['name' => json_encode(['ar' => 'الاجتماعيات', 'en' => 'الاجتماعيات'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 5, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 48],
            ['name' => json_encode(['ar' => 'الفنية', 'en' => 'الفنية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 5, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 49],
            ['name' => json_encode(['ar' => 'البدنية', 'en' => 'البدنية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 5, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 50],
            ['name' => json_encode(['ar' => 'الحاسوب', 'en' => 'الحاسوب'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 5, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 51],
            ['name' => json_encode(['ar' => 'القرآن الكريم', 'en' => 'القرآن الكريم'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 6, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 52],
            ['name' => json_encode(['ar' => 'التربية الإسلامية', 'en' => 'التربية الإسلامية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 6, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 53],
            ['name' => json_encode(['ar' => 'اللغة العربية', 'en' => 'اللغة العربية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 6, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 54],
            ['name' => json_encode(['ar' => 'اللغة الإنجليزية', 'en' => 'اللغة الإنجليزية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 6, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 55],
            ['name' => json_encode(['ar' => 'الرياضيات', 'en' => 'الرياضيات'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 6, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 56],
            ['name' => json_encode(['ar' => 'العلوم', 'en' => 'العلوم'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 6, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 57],
            ['name' => json_encode(['ar' => 'الاجتماعيات', 'en' => 'الاجتماعيات'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 6, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 58],
            ['name' => json_encode(['ar' => 'الفنية', 'en' => 'الفنية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 6, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 59],
            ['name' => json_encode(['ar' => 'البدنية', 'en' => 'البدنية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 6, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 60],
            ['name' => json_encode(['ar' => 'الحاسوب', 'en' => 'الحاسوب'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 6, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 61],
            ['name' => json_encode(['ar' => 'القرآن الكريم', 'en' => 'القرآن الكريم'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 7, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 62],
            ['name' => json_encode(['ar' => 'التربية الإسلامية', 'en' => 'التربية الإسلامية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 7, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 63],
            ['name' => json_encode(['ar' => 'اللغة العربية', 'en' => 'اللغة العربية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 7, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 64],
            ['name' => json_encode(['ar' => 'اللغة الإنجليزية', 'en' => 'اللغة الإنجليزية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 7, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 65],
            ['name' => json_encode(['ar' => 'الرياضيات', 'en' => 'الرياضيات'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 7, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 66],
            ['name' => json_encode(['ar' => 'العلوم', 'en' => 'العلوم'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 7, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 67],
            ['name' => json_encode(['ar' => 'الاجتماعيات', 'en' => 'الاجتماعيات'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 7, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 68],
            ['name' => json_encode(['ar' => 'الفنية', 'en' => 'الفنية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 7, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 69],
            ['name' => json_encode(['ar' => 'البدنية', 'en' => 'البدنية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 7, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 70],
            ['name' => json_encode(['ar' => 'الحاسوب', 'en' => 'الحاسوب'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 7, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 71],
            ['name' => json_encode(['ar' => 'القرآن الكريم', 'en' => 'القرآن الكريم'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 8, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 72],
            ['name' => json_encode(['ar' => 'التربية الإسلامية', 'en' => 'التربية الإسلامية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 8, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 73],
            ['name' => json_encode(['ar' => 'اللغة العربية', 'en' => 'اللغة العربية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 8, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 74],
            ['name' => json_encode(['ar' => 'اللغة الإنجليزية', 'en' => 'اللغة الإنجليزية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 8, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 75],
            ['name' => json_encode(['ar' => 'الرياضيات', 'en' => 'الرياضيات'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 8, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 76],
            ['name' => json_encode(['ar' => 'العلوم', 'en' => 'العلوم'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 8, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 77],
            ['name' => json_encode(['ar' => 'الاجتماعيات', 'en' => 'الاجتماعيات'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 8, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 78],
            ['name' => json_encode(['ar' => 'الفنية', 'en' => 'الفنية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 8, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 79],
            ['name' => json_encode(['ar' => 'البدنية', 'en' => 'البدنية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 8, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 80],
            ['name' => json_encode(['ar' => 'الحاسوب', 'en' => 'الحاسوب'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 8, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 81],
            ['name' => json_encode(['ar' => 'القرآن الكريم', 'en' => 'القرآن الكريم'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 9, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 82],
            ['name' => json_encode(['ar' => 'التربية الإسلامية', 'en' => 'التربية الإسلامية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 9, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 83],
            ['name' => json_encode(['ar' => 'اللغة العربية', 'en' => 'اللغة العربية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 9, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 84],
            ['name' => json_encode(['ar' => 'اللغة الإنجليزية', 'en' => 'اللغة الإنجليزية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 9, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 85],
            ['name' => json_encode(['ar' => 'الرياضيات', 'en' => 'الرياضيات'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 9, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 86],
            ['name' => json_encode(['ar' => 'العلوم', 'en' => 'العلوم'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 9, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 87],
            ['name' => json_encode(['ar' => 'الاجتماعيات', 'en' => 'الاجتماعيات'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 9, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 88],
            ['name' => json_encode(['ar' => 'الفنية', 'en' => 'الفنية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 9, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 89],
            ['name' => json_encode(['ar' => 'البدنية', 'en' => 'البدنية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 9, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 90],
            ['name' => json_encode(['ar' => 'الحاسوب', 'en' => 'الحاسوب'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 9, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 91],
            ['name' => json_encode(['ar' => 'القرآن الكريم', 'en' => 'القرآن الكريم'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 10, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 92],
            ['name' => json_encode(['ar' => 'التربية الإسلامية', 'en' => 'التربية الإسلامية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 10, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 93],
            ['name' => json_encode(['ar' => 'اللغة العربية', 'en' => 'اللغة العربية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 10, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 94],
            ['name' => json_encode(['ar' => 'اللغة الإنجليزية', 'en' => 'اللغة الإنجليزية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 10, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 95],
            ['name' => json_encode(['ar' => 'الرياضيات', 'en' => 'الرياضيات'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 10, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 96],
            ['name' => json_encode(['ar' => 'العلوم', 'en' => 'العلوم'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 10, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 97],
            ['name' => json_encode(['ar' => 'الاجتماعيات', 'en' => 'الاجتماعيات'], JSON_UNESCAPED_UNICODE), 'grade_id' => 3, 'classroom_id' => 10, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 98],
            ['name' => json_encode(['ar' => 'القرآن الكريم', 'en' => 'القرآن الكريم'], JSON_UNESCAPED_UNICODE), 'grade_id' => 4, 'classroom_id' => 11, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 99],
            ['name' => json_encode(['ar' => 'التربية الإسلامية', 'en' => 'التربية الإسلامية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 4, 'classroom_id' => 11, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 100],
            ['name' => json_encode(['ar' => 'اللغة العربية', 'en' => 'اللغة العربية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 4, 'classroom_id' => 11, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 101],
            ['name' => json_encode(['ar' => 'اللغة الإنجليزية', 'en' => 'اللغة الإنجليزية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 4, 'classroom_id' => 11, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 102],
            ['name' => json_encode(['ar' => 'الرياضيات', 'en' => 'الرياضيات'], JSON_UNESCAPED_UNICODE), 'grade_id' => 4, 'classroom_id' => 11, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 103],
            ['name' => json_encode(['ar' => 'الفيزياء', 'en' => 'الفيزياء'], JSON_UNESCAPED_UNICODE), 'grade_id' => 4, 'classroom_id' => 11, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 104],
            ['name' => json_encode(['ar' => 'الكيمياء', 'en' => 'الكيمياء'], JSON_UNESCAPED_UNICODE), 'grade_id' => 4, 'classroom_id' => 11, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 105],
            ['name' => json_encode(['ar' => 'الجغرافيا', 'en' => 'الجغرافيا'], JSON_UNESCAPED_UNICODE), 'grade_id' => 4, 'classroom_id' => 11, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 106],
            ['name' => json_encode(['ar' => 'التاريخ', 'en' => 'التاريخ'], JSON_UNESCAPED_UNICODE), 'grade_id' => 4, 'classroom_id' => 11, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 107],
            ['name' => json_encode(['ar' => 'المجتمع المدني', 'en' => 'المجتمع المدني'], JSON_UNESCAPED_UNICODE), 'grade_id' => 4, 'classroom_id' => 11, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 108],
            ['name' => json_encode(['ar' => 'الفنية', 'en' => 'الفنية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 4, 'classroom_id' => 11, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 109],
            ['name' => json_encode(['ar' => 'القرآن الكريم', 'en' => 'القرآن الكريم'], JSON_UNESCAPED_UNICODE), 'grade_id' => 4, 'classroom_id' => 12, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 110],
            ['name' => json_encode(['ar' => 'التربية الإسلامية', 'en' => 'التربية الإسلامية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 4, 'classroom_id' => 12, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 111],
            ['name' => json_encode(['ar' => 'اللغة العربية', 'en' => 'اللغة العربية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 4, 'classroom_id' => 12, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 112],
            ['name' => json_encode(['ar' => 'اللغة الإنجليزية', 'en' => 'اللغة الإنجليزية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 4, 'classroom_id' => 12, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 113],
            ['name' => json_encode(['ar' => 'الرياضيات', 'en' => 'الرياضيات'], JSON_UNESCAPED_UNICODE), 'grade_id' => 4, 'classroom_id' => 12, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 114],
            ['name' => json_encode(['ar' => 'الفيزياء', 'en' => 'الفيزياء'], JSON_UNESCAPED_UNICODE), 'grade_id' => 4, 'classroom_id' => 12, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 115],
            ['name' => json_encode(['ar' => 'الكيمياء', 'en' => 'الكيمياء'], JSON_UNESCAPED_UNICODE), 'grade_id' => 4, 'classroom_id' => 12, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 116],
            ['name' => json_encode(['ar' => 'الفنية', 'en' => 'الفنية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 4, 'classroom_id' => 12, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 117],
            ['name' => json_encode(['ar' => 'البدنية', 'en' => 'البدنية'], JSON_UNESCAPED_UNICODE), 'grade_id' => 4, 'classroom_id' => 12, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('subjects')->updateOrInsert(
            ['id' => 118],
            ['name' => json_encode(['ar' => 'الحاسوب', 'en' => 'الحاسوب'], JSON_UNESCAPED_UNICODE), 'grade_id' => 4, 'classroom_id' => 12, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );

        // ========================================
        // 3b. الاختبارات (Quizzes) - اختبار واحد لكل مادة
        // ========================================
        DB::table('quizzes')->truncate();
        DB::table('quizzes')->updateOrInsert(
            ['id' => 1],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 1, 'grade_id' => 1, 'classroom_id' => 1, 'section_id' => 1, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 2],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 2, 'grade_id' => 1, 'classroom_id' => 1, 'section_id' => 1, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 3],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 3, 'grade_id' => 1, 'classroom_id' => 1, 'section_id' => 1, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 4],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 4, 'grade_id' => 1, 'classroom_id' => 1, 'section_id' => 1, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 5],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 5, 'grade_id' => 1, 'classroom_id' => 1, 'section_id' => 1, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 6],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 6, 'grade_id' => 1, 'classroom_id' => 1, 'section_id' => 1, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 7],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 7, 'grade_id' => 1, 'classroom_id' => 1, 'section_id' => 1, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 8],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 8, 'grade_id' => 1, 'classroom_id' => 1, 'section_id' => 1, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 9],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 9, 'grade_id' => 1, 'classroom_id' => 1, 'section_id' => 1, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 10],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 10, 'grade_id' => 1, 'classroom_id' => 1, 'section_id' => 1, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 11],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 11, 'grade_id' => 2, 'classroom_id' => 2, 'section_id' => 2, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 12],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 12, 'grade_id' => 2, 'classroom_id' => 2, 'section_id' => 2, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 13],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 13, 'grade_id' => 2, 'classroom_id' => 2, 'section_id' => 2, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 14],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 14, 'grade_id' => 2, 'classroom_id' => 2, 'section_id' => 2, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 15],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 15, 'grade_id' => 2, 'classroom_id' => 2, 'section_id' => 2, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 16],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 16, 'grade_id' => 2, 'classroom_id' => 2, 'section_id' => 2, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 17],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 17, 'grade_id' => 2, 'classroom_id' => 2, 'section_id' => 2, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 18],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 18, 'grade_id' => 2, 'classroom_id' => 2, 'section_id' => 2, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 19],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 19, 'grade_id' => 2, 'classroom_id' => 2, 'section_id' => 2, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 20],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 20, 'grade_id' => 2, 'classroom_id' => 2, 'section_id' => 2, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 21],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 21, 'grade_id' => 2, 'classroom_id' => 3, 'section_id' => 3, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 22],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 22, 'grade_id' => 2, 'classroom_id' => 3, 'section_id' => 3, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 23],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 23, 'grade_id' => 2, 'classroom_id' => 3, 'section_id' => 3, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 24],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 24, 'grade_id' => 2, 'classroom_id' => 3, 'section_id' => 3, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 25],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 25, 'grade_id' => 2, 'classroom_id' => 3, 'section_id' => 3, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 26],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 26, 'grade_id' => 2, 'classroom_id' => 3, 'section_id' => 3, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 27],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 27, 'grade_id' => 2, 'classroom_id' => 3, 'section_id' => 3, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 28],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 28, 'grade_id' => 2, 'classroom_id' => 3, 'section_id' => 3, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 29],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 29, 'grade_id' => 2, 'classroom_id' => 3, 'section_id' => 3, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 30],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 30, 'grade_id' => 2, 'classroom_id' => 3, 'section_id' => 3, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 31],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 31, 'grade_id' => 2, 'classroom_id' => 4, 'section_id' => 4, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 32],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 32, 'grade_id' => 2, 'classroom_id' => 4, 'section_id' => 4, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 33],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 33, 'grade_id' => 2, 'classroom_id' => 4, 'section_id' => 4, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 34],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 34, 'grade_id' => 2, 'classroom_id' => 4, 'section_id' => 4, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 35],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 35, 'grade_id' => 2, 'classroom_id' => 4, 'section_id' => 4, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 36],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 36, 'grade_id' => 2, 'classroom_id' => 4, 'section_id' => 4, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 37],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 37, 'grade_id' => 2, 'classroom_id' => 4, 'section_id' => 4, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 38],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 38, 'grade_id' => 2, 'classroom_id' => 4, 'section_id' => 4, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 39],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 39, 'grade_id' => 2, 'classroom_id' => 4, 'section_id' => 4, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 40],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 40, 'grade_id' => 2, 'classroom_id' => 4, 'section_id' => 4, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 41],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 41, 'grade_id' => 3, 'classroom_id' => 5, 'section_id' => 5, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 42],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 42, 'grade_id' => 3, 'classroom_id' => 5, 'section_id' => 5, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 43],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 43, 'grade_id' => 3, 'classroom_id' => 5, 'section_id' => 5, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 44],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 44, 'grade_id' => 3, 'classroom_id' => 5, 'section_id' => 5, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 45],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 45, 'grade_id' => 3, 'classroom_id' => 5, 'section_id' => 5, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 46],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 46, 'grade_id' => 3, 'classroom_id' => 5, 'section_id' => 5, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 47],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 47, 'grade_id' => 3, 'classroom_id' => 5, 'section_id' => 5, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 48],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 48, 'grade_id' => 3, 'classroom_id' => 5, 'section_id' => 5, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 49],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 49, 'grade_id' => 3, 'classroom_id' => 5, 'section_id' => 5, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 50],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 50, 'grade_id' => 3, 'classroom_id' => 5, 'section_id' => 5, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 51],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 51, 'grade_id' => 3, 'classroom_id' => 6, 'section_id' => 6, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 52],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 52, 'grade_id' => 3, 'classroom_id' => 6, 'section_id' => 6, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 53],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 53, 'grade_id' => 3, 'classroom_id' => 6, 'section_id' => 6, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 54],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 54, 'grade_id' => 3, 'classroom_id' => 6, 'section_id' => 6, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 55],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 55, 'grade_id' => 3, 'classroom_id' => 6, 'section_id' => 6, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 56],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 56, 'grade_id' => 3, 'classroom_id' => 6, 'section_id' => 6, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 57],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 57, 'grade_id' => 3, 'classroom_id' => 6, 'section_id' => 6, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 58],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 58, 'grade_id' => 3, 'classroom_id' => 6, 'section_id' => 6, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 59],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 59, 'grade_id' => 3, 'classroom_id' => 6, 'section_id' => 6, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 60],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 60, 'grade_id' => 3, 'classroom_id' => 6, 'section_id' => 6, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 61],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 61, 'grade_id' => 3, 'classroom_id' => 7, 'section_id' => 7, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 62],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 62, 'grade_id' => 3, 'classroom_id' => 7, 'section_id' => 7, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 63],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 63, 'grade_id' => 3, 'classroom_id' => 7, 'section_id' => 7, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 64],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 64, 'grade_id' => 3, 'classroom_id' => 7, 'section_id' => 7, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 65],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 65, 'grade_id' => 3, 'classroom_id' => 7, 'section_id' => 7, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 66],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 66, 'grade_id' => 3, 'classroom_id' => 7, 'section_id' => 7, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 67],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 67, 'grade_id' => 3, 'classroom_id' => 7, 'section_id' => 7, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 68],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 68, 'grade_id' => 3, 'classroom_id' => 7, 'section_id' => 7, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 69],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 69, 'grade_id' => 3, 'classroom_id' => 7, 'section_id' => 7, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 70],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 70, 'grade_id' => 3, 'classroom_id' => 7, 'section_id' => 7, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 71],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 71, 'grade_id' => 3, 'classroom_id' => 8, 'section_id' => 8, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 72],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 72, 'grade_id' => 3, 'classroom_id' => 8, 'section_id' => 8, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 73],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 73, 'grade_id' => 3, 'classroom_id' => 8, 'section_id' => 8, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 74],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 74, 'grade_id' => 3, 'classroom_id' => 8, 'section_id' => 8, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 75],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 75, 'grade_id' => 3, 'classroom_id' => 8, 'section_id' => 8, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 76],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 76, 'grade_id' => 3, 'classroom_id' => 8, 'section_id' => 8, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 77],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 77, 'grade_id' => 3, 'classroom_id' => 8, 'section_id' => 8, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 78],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 78, 'grade_id' => 3, 'classroom_id' => 8, 'section_id' => 8, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 79],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 79, 'grade_id' => 3, 'classroom_id' => 8, 'section_id' => 8, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 80],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 80, 'grade_id' => 3, 'classroom_id' => 8, 'section_id' => 8, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 81],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 81, 'grade_id' => 3, 'classroom_id' => 9, 'section_id' => 9, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 82],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 82, 'grade_id' => 3, 'classroom_id' => 9, 'section_id' => 9, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 83],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 83, 'grade_id' => 3, 'classroom_id' => 9, 'section_id' => 9, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 84],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 84, 'grade_id' => 3, 'classroom_id' => 9, 'section_id' => 9, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 85],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 85, 'grade_id' => 3, 'classroom_id' => 9, 'section_id' => 9, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 86],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 86, 'grade_id' => 3, 'classroom_id' => 9, 'section_id' => 9, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 87],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 87, 'grade_id' => 3, 'classroom_id' => 9, 'section_id' => 9, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 88],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 88, 'grade_id' => 3, 'classroom_id' => 9, 'section_id' => 9, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 89],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 89, 'grade_id' => 3, 'classroom_id' => 9, 'section_id' => 9, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 90],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 90, 'grade_id' => 3, 'classroom_id' => 9, 'section_id' => 9, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 91],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 91, 'grade_id' => 3, 'classroom_id' => 10, 'section_id' => 10, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 92],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 92, 'grade_id' => 3, 'classroom_id' => 10, 'section_id' => 10, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 93],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 93, 'grade_id' => 3, 'classroom_id' => 10, 'section_id' => 10, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 94],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 94, 'grade_id' => 3, 'classroom_id' => 10, 'section_id' => 10, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 95],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 95, 'grade_id' => 3, 'classroom_id' => 10, 'section_id' => 10, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 96],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 96, 'grade_id' => 3, 'classroom_id' => 10, 'section_id' => 10, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 97],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 97, 'grade_id' => 3, 'classroom_id' => 10, 'section_id' => 10, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 98],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 98, 'grade_id' => 4, 'classroom_id' => 11, 'section_id' => 11, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 99],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 99, 'grade_id' => 4, 'classroom_id' => 11, 'section_id' => 11, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 100],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 100, 'grade_id' => 4, 'classroom_id' => 11, 'section_id' => 11, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 101],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 101, 'grade_id' => 4, 'classroom_id' => 11, 'section_id' => 11, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 102],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 102, 'grade_id' => 4, 'classroom_id' => 11, 'section_id' => 11, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 103],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 103, 'grade_id' => 4, 'classroom_id' => 11, 'section_id' => 11, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 104],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 104, 'grade_id' => 4, 'classroom_id' => 11, 'section_id' => 11, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 105],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 105, 'grade_id' => 4, 'classroom_id' => 11, 'section_id' => 11, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 106],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 106, 'grade_id' => 4, 'classroom_id' => 11, 'section_id' => 11, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 107],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 107, 'grade_id' => 4, 'classroom_id' => 11, 'section_id' => 11, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 108],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 108, 'grade_id' => 4, 'classroom_id' => 11, 'section_id' => 11, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 109],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 109, 'grade_id' => 4, 'classroom_id' => 12, 'section_id' => 12, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 110],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 110, 'grade_id' => 4, 'classroom_id' => 12, 'section_id' => 12, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 111],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 111, 'grade_id' => 4, 'classroom_id' => 12, 'section_id' => 12, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 112],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 112, 'grade_id' => 4, 'classroom_id' => 12, 'section_id' => 12, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 113],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 113, 'grade_id' => 4, 'classroom_id' => 12, 'section_id' => 12, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 114],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 114, 'grade_id' => 4, 'classroom_id' => 12, 'section_id' => 12, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 115],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 115, 'grade_id' => 4, 'classroom_id' => 12, 'section_id' => 12, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 116],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 116, 'grade_id' => 4, 'classroom_id' => 12, 'section_id' => 12, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 117],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 117, 'grade_id' => 4, 'classroom_id' => 12, 'section_id' => 12, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('quizzes')->updateOrInsert(
            ['id' => 118],
            ['name' => json_encode(['ar' => 'اختبار نهاية العام', 'en' => 'Final Exam'], JSON_UNESCAPED_UNICODE), 'subject_id' => 118, 'grade_id' => 4, 'classroom_id' => 12, 'section_id' => 12, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );

        // ========================================
        // 3c. الأسئلة (Questions) - سؤال واحد لكل اختبار
        // ========================================
        DB::table('questions')->truncate();
        DB::table('questions')->updateOrInsert(
            ['id' => 1],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 2],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 2, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 3],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 3, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 4],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 4, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 5],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 5, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 6],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 6, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 7],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 7, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 8],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 8, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 9],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 9, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 10],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 10, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 11],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 11, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 12],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 12, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 13],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 13, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 14],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 14, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 15],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 15, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 16],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 16, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 17],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 17, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 18],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 18, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 19],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 19, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 20],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 20, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 21],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 21, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 22],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 22, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 23],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 23, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 24],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 24, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 25],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 25, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 26],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 26, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 27],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 27, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 28],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 28, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 29],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 29, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 30],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 30, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 31],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 31, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 32],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 32, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 33],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 33, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 34],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 34, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 35],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 35, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 36],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 36, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 37],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 37, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 38],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 38, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 39],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 39, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 40],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 40, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 41],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 41, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 42],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 42, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 43],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 43, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 44],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 44, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 45],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 45, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 46],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 46, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 47],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 47, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 48],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 48, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 49],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 49, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 50],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 50, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 51],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 51, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 52],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 52, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 53],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 53, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 54],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 54, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 55],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 55, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 56],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 56, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 57],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 57, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 58],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 58, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 59],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 59, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 60],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 60, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 61],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 61, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 62],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 62, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 63],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 63, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 64],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 64, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 65],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 65, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 66],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 66, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 67],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 67, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 68],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 68, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 69],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 69, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 70],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 70, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 71],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 71, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 72],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 72, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 73],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 73, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 74],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 74, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 75],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 75, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 76],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 76, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 77],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 77, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 78],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 78, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 79],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 79, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 80],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 80, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 81],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 81, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 82],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 82, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 83],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 83, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 84],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 84, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 85],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 85, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 86],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 86, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 87],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 87, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 88],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 88, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 89],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 89, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 90],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 90, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 91],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 91, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 92],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 92, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 93],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 93, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 94],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 94, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 95],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 95, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 96],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 96, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 97],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 97, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 98],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 98, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 99],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 99, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 100],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 100, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 101],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 101, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 102],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 102, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 103],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 103, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 104],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 104, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 105],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 105, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 106],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 106, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 107],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 107, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 108],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 108, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 109],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 109, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 110],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 110, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 111],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 111, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 112],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 112, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 113],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 113, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 114],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 114, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 115],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 115, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 116],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 116, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 117],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 117, 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('questions')->updateOrInsert(
            ['id' => 118],
            ['title' => 'ما نتيجة الاختبار النهائي؟', 'answers' => 'نجاح|رسوب', 'right_answer' => 'نجاح', 'score' => 100, 'quizze_id' => 118, 'created_at' => now(), 'updated_at' => now()]
        );

        // ========================================
        // 4. الطلاب (Students)
        // ========================================
        DB::table('students')->truncate();
        DB::table('students')->updateOrInsert(
            ['id' => 1],
            ['name' => json_encode(['ar' => 'صدام ماجد عبدالله محمد', 'en' => 'صدام ماجد عبدالله محمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student1@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 1, 'Classroom_id' => 1, 'section_id' => 1, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 2],
            ['name' => json_encode(['ar' => 'ناصر محمد محمد عبدالله سلطان', 'en' => 'ناصر محمد محمد عبدالله سلطان'], JSON_UNESCAPED_UNICODE), 'email' => 'student2@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 1, 'Classroom_id' => 1, 'section_id' => 1, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 3],
            ['name' => json_encode(['ar' => 'وسام بسام احمد محمد', 'en' => 'وسام بسام احمد محمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student3@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 1, 'Classroom_id' => 1, 'section_id' => 1, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 4],
            ['name' => json_encode(['ar' => 'أسماء محمد محمد علي عبدالله', 'en' => 'أسماء محمد محمد علي عبدالله'], JSON_UNESCAPED_UNICODE), 'email' => 'student4@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 1, 'Classroom_id' => 1, 'section_id' => 1, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 5],
            ['name' => json_encode(['ar' => 'اسيل محبوب محمد عبدالله', 'en' => 'اسيل محبوب محمد عبدالله'], JSON_UNESCAPED_UNICODE), 'email' => 'student5@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 1, 'Classroom_id' => 1, 'section_id' => 1, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 6],
            ['name' => json_encode(['ar' => 'ايمان سلطان علي عبدالله', 'en' => 'ايمان سلطان علي عبدالله'], JSON_UNESCAPED_UNICODE), 'email' => 'student6@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 1, 'Classroom_id' => 1, 'section_id' => 1, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 7],
            ['name' => json_encode(['ar' => 'جنات محمد امين حسن علي', 'en' => 'جنات محمد امين حسن علي'], JSON_UNESCAPED_UNICODE), 'email' => 'student7@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 1, 'Classroom_id' => 1, 'section_id' => 1, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 8],
            ['name' => json_encode(['ar' => 'ليان محمد عبدالعليم سعيد قائد', 'en' => 'ليان محمد عبدالعليم سعيد قائد'], JSON_UNESCAPED_UNICODE), 'email' => 'student8@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 1, 'Classroom_id' => 1, 'section_id' => 1, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 9],
            ['name' => json_encode(['ar' => 'ملاك جار الله عمر محمد', 'en' => 'ملاك جار الله عمر محمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student9@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 1, 'Classroom_id' => 1, 'section_id' => 1, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 10],
            ['name' => json_encode(['ar' => 'وئام وسام محمود الحاج عبدالولي', 'en' => 'وئام وسام محمود الحاج عبدالولي'], JSON_UNESCAPED_UNICODE), 'email' => 'student10@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 1, 'Classroom_id' => 1, 'section_id' => 1, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 11],
            ['name' => json_encode(['ar' => 'الطلاب الغائبون', 'en' => 'الطلاب الغائبون'], JSON_UNESCAPED_UNICODE), 'email' => 'student11@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 1, 'Classroom_id' => 1, 'section_id' => 1, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 12],
            ['name' => json_encode(['ar' => 'البراء مروان عبده محمد', 'en' => 'البراء مروان عبده محمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student12@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 1, 'Classroom_id' => 1, 'section_id' => 1, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 13],
            ['name' => json_encode(['ar' => 'احمد  فيصل احمد علي عبده', 'en' => 'احمد  فيصل احمد علي عبده'], JSON_UNESCAPED_UNICODE), 'email' => 'student13@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 2, 'section_id' => 2, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 14],
            ['name' => json_encode(['ar' => 'احمد محمد محمد عبدالله النهاري', 'en' => 'احمد محمد محمد عبدالله النهاري'], JSON_UNESCAPED_UNICODE), 'email' => 'student14@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 2, 'section_id' => 2, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 15],
            ['name' => json_encode(['ar' => 'اكرم فهد عبدالعزيز احمد قائد', 'en' => 'اكرم فهد عبدالعزيز احمد قائد'], JSON_UNESCAPED_UNICODE), 'email' => 'student15@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 2, 'section_id' => 2, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 16],
            ['name' => json_encode(['ar' => 'انس وليد العزي علي عبدالله', 'en' => 'انس وليد العزي علي عبدالله'], JSON_UNESCAPED_UNICODE), 'email' => 'student16@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 2, 'section_id' => 2, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 17],
            ['name' => json_encode(['ar' => 'أيمن بسام سعيد علي عبدالله', 'en' => 'أيمن بسام سعيد علي عبدالله'], JSON_UNESCAPED_UNICODE), 'email' => 'student17@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 2, 'section_id' => 2, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 18],
            ['name' => json_encode(['ar' => 'حسام عبدالعليم علي سيف غالب', 'en' => 'حسام عبدالعليم علي سيف غالب'], JSON_UNESCAPED_UNICODE), 'email' => 'student18@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 2, 'section_id' => 2, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 19],
            ['name' => json_encode(['ar' => 'حسين بندر عبدالجليل عبدالله سلطان', 'en' => 'حسين بندر عبدالجليل عبدالله سلطان'], JSON_UNESCAPED_UNICODE), 'email' => 'student19@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 2, 'section_id' => 2, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 20],
            ['name' => json_encode(['ar' => 'كهلان انور عبدالباري حسن علي', 'en' => 'كهلان انور عبدالباري حسن علي'], JSON_UNESCAPED_UNICODE), 'email' => 'student20@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 2, 'section_id' => 2, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 21],
            ['name' => json_encode(['ar' => 'مبارك شكيب محمد محمد هزاع', 'en' => 'مبارك شكيب محمد محمد هزاع'], JSON_UNESCAPED_UNICODE), 'email' => 'student21@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 2, 'section_id' => 2, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 22],
            ['name' => json_encode(['ar' => 'أسيل بدري محمد محمد مقبل', 'en' => 'أسيل بدري محمد محمد مقبل'], JSON_UNESCAPED_UNICODE), 'email' => 'student22@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 2, 'section_id' => 2, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 23],
            ['name' => json_encode(['ar' => 'آية احمد سيف قاسم', 'en' => 'آية احمد سيف قاسم'], JSON_UNESCAPED_UNICODE), 'email' => 'student23@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 2, 'section_id' => 2, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 24],
            ['name' => json_encode(['ar' => 'جليلة مجيب محمد محمد هزاع', 'en' => 'جليلة مجيب محمد محمد هزاع'], JSON_UNESCAPED_UNICODE), 'email' => 'student24@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 2, 'section_id' => 2, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 25],
            ['name' => json_encode(['ar' => 'دعاء عبدالملك عبدالله احمد', 'en' => 'دعاء عبدالملك عبدالله احمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student25@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 2, 'section_id' => 2, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 26],
            ['name' => json_encode(['ar' => 'رهف طه عبدالسلام قائد احمد', 'en' => 'رهف طه عبدالسلام قائد احمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student26@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 2, 'section_id' => 2, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 27],
            ['name' => json_encode(['ar' => 'ريتاج شكري سرحان احمد', 'en' => 'ريتاج شكري سرحان احمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student27@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 2, 'section_id' => 2, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 28],
            ['name' => json_encode(['ar' => 'صفاء سعيد عبده سعيد', 'en' => 'صفاء سعيد عبده سعيد'], JSON_UNESCAPED_UNICODE), 'email' => 'student28@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 2, 'section_id' => 2, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 29],
            ['name' => json_encode(['ar' => 'عائشة عبدالعليم احمد عبدالله سلطان', 'en' => 'عائشة عبدالعليم احمد عبدالله سلطان'], JSON_UNESCAPED_UNICODE), 'email' => 'student29@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 2, 'section_id' => 2, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 30],
            ['name' => json_encode(['ar' => 'مريم عواش سالم حميد احمد', 'en' => 'مريم عواش سالم حميد احمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student30@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 2, 'section_id' => 2, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 31],
            ['name' => json_encode(['ar' => 'يمنى محمد عبدالله محمد علي', 'en' => 'يمنى محمد عبدالله محمد علي'], JSON_UNESCAPED_UNICODE), 'email' => 'student31@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 2, 'section_id' => 2, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 32],
            ['name' => json_encode(['ar' => 'الملحقية', 'en' => 'الملحقية'], JSON_UNESCAPED_UNICODE), 'email' => 'student32@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 2, 'section_id' => 2, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 33],
            ['name' => json_encode(['ar' => 'الشافعي فكري عبدالجليل محمد احمد', 'en' => 'الشافعي فكري عبدالجليل محمد احمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student33@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 2, 'section_id' => 2, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 34],
            ['name' => json_encode(['ar' => 'محمد فيصل عبدالوهاب امير', 'en' => 'محمد فيصل عبدالوهاب امير'], JSON_UNESCAPED_UNICODE), 'email' => 'student34@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 2, 'section_id' => 2, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 35],
            ['name' => json_encode(['ar' => 'اية عبدالرحمن محمد حسن', 'en' => 'اية عبدالرحمن محمد حسن'], JSON_UNESCAPED_UNICODE), 'email' => 'student35@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 2, 'section_id' => 2, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 36],
            ['name' => json_encode(['ar' => 'ايناس محمد عبدالجليل محمد احمد', 'en' => 'ايناس محمد عبدالجليل محمد احمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student36@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 2, 'section_id' => 2, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 37],
            ['name' => json_encode(['ar' => 'أميمة عارف ناجي محمد مهيوب', 'en' => 'أميمة عارف ناجي محمد مهيوب'], JSON_UNESCAPED_UNICODE), 'email' => 'student37@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 2, 'section_id' => 2, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 38],
            ['name' => json_encode(['ar' => 'سارة خليفة هاشم امير', 'en' => 'سارة خليفة هاشم امير'], JSON_UNESCAPED_UNICODE), 'email' => 'student38@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 2, 'section_id' => 2, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 39],
            ['name' => json_encode(['ar' => 'ليان شكيم محمد حسن', 'en' => 'ليان شكيم محمد حسن'], JSON_UNESCAPED_UNICODE), 'email' => 'student39@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 2, 'section_id' => 2, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 40],
            ['name' => json_encode(['ar' => 'حسين علي محمد شمسان سعيد', 'en' => 'حسين علي محمد شمسان سعيد'], JSON_UNESCAPED_UNICODE), 'email' => 'student40@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 2, 'section_id' => 2, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 41],
            ['name' => json_encode(['ar' => 'عبدالغني رامي علي محمد شمسان', 'en' => 'عبدالغني رامي علي محمد شمسان'], JSON_UNESCAPED_UNICODE), 'email' => 'student41@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 2, 'section_id' => 2, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 42],
            ['name' => json_encode(['ar' => 'مهيب محمد عبدالله محمد هزاع', 'en' => 'مهيب محمد عبدالله محمد هزاع'], JSON_UNESCAPED_UNICODE), 'email' => 'student42@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 2, 'section_id' => 2, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 43],
            ['name' => json_encode(['ar' => 'هيثم حبيب سعيد علي عبده', 'en' => 'هيثم حبيب سعيد علي عبده'], JSON_UNESCAPED_UNICODE), 'email' => 'student43@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 2, 'section_id' => 2, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 44],
            ['name' => json_encode(['ar' => 'ريدان محمد احمد محمد مهيوب', 'en' => 'ريدان محمد احمد محمد مهيوب'], JSON_UNESCAPED_UNICODE), 'email' => 'student44@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 2, 'section_id' => 2, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 45],
            ['name' => json_encode(['ar' => 'محمد عزت محمد عبدالجليل ناصر', 'en' => 'محمد عزت محمد عبدالجليل ناصر'], JSON_UNESCAPED_UNICODE), 'email' => 'student45@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 2, 'section_id' => 2, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 46],
            ['name' => json_encode(['ar' => 'وائل ناصر علي احمد', 'en' => 'وائل ناصر علي احمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student46@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 2, 'section_id' => 2, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 47],
            ['name' => json_encode(['ar' => 'ليان عبدالسلام عبدالعزيز محمد', 'en' => 'ليان عبدالسلام عبدالعزيز محمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student47@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 2, 'section_id' => 2, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 48],
            ['name' => json_encode(['ar' => 'الطلاب الغياب', 'en' => 'الطلاب الغياب'], JSON_UNESCAPED_UNICODE), 'email' => 'student48@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 2, 'section_id' => 2, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 49],
            ['name' => json_encode(['ar' => 'عزالدين سميح احمد سعيد', 'en' => 'عزالدين سميح احمد سعيد'], JSON_UNESCAPED_UNICODE), 'email' => 'student49@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 2, 'section_id' => 2, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 50],
            ['name' => json_encode(['ar' => 'ايمن نضير محمود احمد', 'en' => 'ايمن نضير محمود احمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student50@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 3, 'section_id' => 3, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 51],
            ['name' => json_encode(['ar' => 'حسام وليد عبدالله مهيوب', 'en' => 'حسام وليد عبدالله مهيوب'], JSON_UNESCAPED_UNICODE), 'email' => 'student51@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 3, 'section_id' => 3, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 52],
            ['name' => json_encode(['ar' => 'شامان محمد عبدالله محمد هزاع', 'en' => 'شامان محمد عبدالله محمد هزاع'], JSON_UNESCAPED_UNICODE), 'email' => 'student52@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 3, 'section_id' => 3, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 53],
            ['name' => json_encode(['ar' => 'عزالدين محمد عبدالله مهيوب', 'en' => 'عزالدين محمد عبدالله مهيوب'], JSON_UNESCAPED_UNICODE), 'email' => 'student53@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 3, 'section_id' => 3, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 54],
            ['name' => json_encode(['ar' => 'عزالدين محمد العزي علي  عبدالله', 'en' => 'عزالدين محمد العزي علي  عبدالله'], JSON_UNESCAPED_UNICODE), 'email' => 'student54@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 3, 'section_id' => 3, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 55],
            ['name' => json_encode(['ar' => 'فتح خليل محمد عبدالله قاسم', 'en' => 'فتح خليل محمد عبدالله قاسم'], JSON_UNESCAPED_UNICODE), 'email' => 'student55@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 3, 'section_id' => 3, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 56],
            ['name' => json_encode(['ar' => 'فهد محمد امين حسن علي', 'en' => 'فهد محمد امين حسن علي'], JSON_UNESCAPED_UNICODE), 'email' => 'student56@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 3, 'section_id' => 3, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 57],
            ['name' => json_encode(['ar' => 'مازن وسيم امين غالب', 'en' => 'مازن وسيم امين غالب'], JSON_UNESCAPED_UNICODE), 'email' => 'student57@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 3, 'section_id' => 3, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 58],
            ['name' => json_encode(['ar' => 'ياسر عفيف صادق حسن', 'en' => 'ياسر عفيف صادق حسن'], JSON_UNESCAPED_UNICODE), 'email' => 'student58@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 3, 'section_id' => 3, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 59],
            ['name' => json_encode(['ar' => 'ابرار رضوان محمد احمد هزبر', 'en' => 'ابرار رضوان محمد احمد هزبر'], JSON_UNESCAPED_UNICODE), 'email' => 'student59@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 3, 'section_id' => 3, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 60],
            ['name' => json_encode(['ar' => 'جنات عادل محمد مهيوب', 'en' => 'جنات عادل محمد مهيوب'], JSON_UNESCAPED_UNICODE), 'email' => 'student60@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 3, 'section_id' => 3, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 61],
            ['name' => json_encode(['ar' => 'جنى فيصل احمد علي عبده', 'en' => 'جنى فيصل احمد علي عبده'], JSON_UNESCAPED_UNICODE), 'email' => 'student61@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 3, 'section_id' => 3, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 62],
            ['name' => json_encode(['ar' => 'حلا عبدالكريم محمد عبدالله', 'en' => 'حلا عبدالكريم محمد عبدالله'], JSON_UNESCAPED_UNICODE), 'email' => 'student62@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 3, 'section_id' => 3, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 63],
            ['name' => json_encode(['ar' => 'دينا علي محمد شمسان', 'en' => 'دينا علي محمد شمسان'], JSON_UNESCAPED_UNICODE), 'email' => 'student63@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 3, 'section_id' => 3, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 64],
            ['name' => json_encode(['ar' => 'ردينا سعيد علي ناجي', 'en' => 'ردينا سعيد علي ناجي'], JSON_UNESCAPED_UNICODE), 'email' => 'student64@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 3, 'section_id' => 3, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 65],
            ['name' => json_encode(['ar' => 'رغد عبدالرقيب عبدالوهاب امير', 'en' => 'رغد عبدالرقيب عبدالوهاب امير'], JSON_UNESCAPED_UNICODE), 'email' => 'student65@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 3, 'section_id' => 3, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 66],
            ['name' => json_encode(['ar' => 'زلفى عبده احمد محمد ناجي', 'en' => 'زلفى عبده احمد محمد ناجي'], JSON_UNESCAPED_UNICODE), 'email' => 'student66@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 3, 'section_id' => 3, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 67],
            ['name' => json_encode(['ar' => 'زهراء عرفات علي ناجي إبراهيم', 'en' => 'زهراء عرفات علي ناجي إبراهيم'], JSON_UNESCAPED_UNICODE), 'email' => 'student67@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 3, 'section_id' => 3, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 68],
            ['name' => json_encode(['ar' => 'فطوم محمد محمد علي عبدالله', 'en' => 'فطوم محمد محمد علي عبدالله'], JSON_UNESCAPED_UNICODE), 'email' => 'student68@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 3, 'section_id' => 3, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 69],
            ['name' => json_encode(['ar' => 'ليان محمد عبدالعليم سعيد قائد', 'en' => 'ليان محمد عبدالعليم سعيد قائد'], JSON_UNESCAPED_UNICODE), 'email' => 'student69@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 3, 'section_id' => 3, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 70],
            ['name' => json_encode(['ar' => 'الملحقية', 'en' => 'الملحقية'], JSON_UNESCAPED_UNICODE), 'email' => 'student70@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 3, 'section_id' => 3, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 71],
            ['name' => json_encode(['ar' => 'ريتاج محمد مهيوب الحاج', 'en' => 'ريتاج محمد مهيوب الحاج'], JSON_UNESCAPED_UNICODE), 'email' => 'student71@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 3, 'section_id' => 3, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 72],
            ['name' => json_encode(['ar' => 'شذى عبدالباري عبده احمد', 'en' => 'شذى عبدالباري عبده احمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student72@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 3, 'section_id' => 3, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 73],
            ['name' => json_encode(['ar' => 'شهد عبدالباري عبده احمد', 'en' => 'شهد عبدالباري عبده احمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student73@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 3, 'section_id' => 3, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 74],
            ['name' => json_encode(['ar' => 'ابراهيم رضوان محمد احمد هزبر', 'en' => 'ابراهيم رضوان محمد احمد هزبر'], JSON_UNESCAPED_UNICODE), 'email' => 'student74@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 4, 'section_id' => 4, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 75],
            ['name' => json_encode(['ar' => 'البراء فكري عبدالجليل محمد', 'en' => 'البراء فكري عبدالجليل محمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student75@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 4, 'section_id' => 4, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 76],
            ['name' => json_encode(['ar' => 'الياس محمد عبده سعيد', 'en' => 'الياس محمد عبده سعيد'], JSON_UNESCAPED_UNICODE), 'email' => 'student76@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 4, 'section_id' => 4, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 77],
            ['name' => json_encode(['ar' => 'ايمن محمد عبدالعليم سعيد', 'en' => 'ايمن محمد عبدالعليم سعيد'], JSON_UNESCAPED_UNICODE), 'email' => 'student77@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 4, 'section_id' => 4, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 78],
            ['name' => json_encode(['ar' => 'تركي عبد الملك عبدالله احمد', 'en' => 'تركي عبد الملك عبدالله احمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student78@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 4, 'section_id' => 4, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 79],
            ['name' => json_encode(['ar' => 'تركي محمد مقبل ناجي العماري', 'en' => 'تركي محمد مقبل ناجي العماري'], JSON_UNESCAPED_UNICODE), 'email' => 'student79@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 4, 'section_id' => 4, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 80],
            ['name' => json_encode(['ar' => 'جمال عبدالناصر عبدالرحمن محمد سلطان', 'en' => 'جمال عبدالناصر عبدالرحمن محمد سلطان'], JSON_UNESCAPED_UNICODE), 'email' => 'student80@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 4, 'section_id' => 4, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 81],
            ['name' => json_encode(['ar' => 'جمال فيصل عبدالوهاب امير', 'en' => 'جمال فيصل عبدالوهاب امير'], JSON_UNESCAPED_UNICODE), 'email' => 'student81@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 4, 'section_id' => 4, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 82],
            ['name' => json_encode(['ar' => 'ردفان شكيب محمد محمد هزاع', 'en' => 'ردفان شكيب محمد محمد هزاع'], JSON_UNESCAPED_UNICODE), 'email' => 'student82@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 4, 'section_id' => 4, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 83],
            ['name' => json_encode(['ar' => 'ريان شكيم محمد حسن غالب', 'en' => 'ريان شكيم محمد حسن غالب'], JSON_UNESCAPED_UNICODE), 'email' => 'student83@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 4, 'section_id' => 4, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 84],
            ['name' => json_encode(['ar' => 'زهير محمد مهيوب غالب', 'en' => 'زهير محمد مهيوب غالب'], JSON_UNESCAPED_UNICODE), 'email' => 'student84@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 4, 'section_id' => 4, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 85],
            ['name' => json_encode(['ar' => 'صخر عواش سالم حميد', 'en' => 'صخر عواش سالم حميد'], JSON_UNESCAPED_UNICODE), 'email' => 'student85@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 4, 'section_id' => 4, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 86],
            ['name' => json_encode(['ar' => 'مجد على الحاج عبدالقوي عبدالله', 'en' => 'مجد على الحاج عبدالقوي عبدالله'], JSON_UNESCAPED_UNICODE), 'email' => 'student86@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 4, 'section_id' => 4, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 87],
            ['name' => json_encode(['ar' => 'محمد احمد حيدرة احمد', 'en' => 'محمد احمد حيدرة احمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student87@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 4, 'section_id' => 4, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 88],
            ['name' => json_encode(['ar' => 'محمد عبدالرحمن محمد سرحان', 'en' => 'محمد عبدالرحمن محمد سرحان'], JSON_UNESCAPED_UNICODE), 'email' => 'student88@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 4, 'section_id' => 4, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 89],
            ['name' => json_encode(['ar' => 'محمد مكرم عبدالله علي', 'en' => 'محمد مكرم عبدالله علي'], JSON_UNESCAPED_UNICODE), 'email' => 'student89@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 4, 'section_id' => 4, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 90],
            ['name' => json_encode(['ar' => 'مدين فضل محمد عبدالله قاسم', 'en' => 'مدين فضل محمد عبدالله قاسم'], JSON_UNESCAPED_UNICODE), 'email' => 'student90@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 4, 'section_id' => 4, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 91],
            ['name' => json_encode(['ar' => 'هيثم احمد عبدالرحمن محمد سلطان', 'en' => 'هيثم احمد عبدالرحمن محمد سلطان'], JSON_UNESCAPED_UNICODE), 'email' => 'student91@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 4, 'section_id' => 4, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 92],
            ['name' => json_encode(['ar' => 'هيثم وائل عبدالغني علي', 'en' => 'هيثم وائل عبدالغني علي'], JSON_UNESCAPED_UNICODE), 'email' => 'student92@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 4, 'section_id' => 4, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 93],
            ['name' => json_encode(['ar' => 'ياسر مهيوب محمد مهيوب', 'en' => 'ياسر مهيوب محمد مهيوب'], JSON_UNESCAPED_UNICODE), 'email' => 'student93@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 4, 'section_id' => 4, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 94],
            ['name' => json_encode(['ar' => 'أسماء محمد عبده مهيوب', 'en' => 'أسماء محمد عبده مهيوب'], JSON_UNESCAPED_UNICODE), 'email' => 'student94@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 4, 'section_id' => 4, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 95],
            ['name' => json_encode(['ar' => 'اسماء محمد عبدالله سعيد', 'en' => 'اسماء محمد عبدالله سعيد'], JSON_UNESCAPED_UNICODE), 'email' => 'student95@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 4, 'section_id' => 4, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 96],
            ['name' => json_encode(['ar' => 'أنهار محمد احمد محمد', 'en' => 'أنهار محمد احمد محمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student96@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 4, 'section_id' => 4, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 97],
            ['name' => json_encode(['ar' => 'بثينة عبدالحليم عبدالله علي', 'en' => 'بثينة عبدالحليم عبدالله علي'], JSON_UNESCAPED_UNICODE), 'email' => 'student97@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 4, 'section_id' => 4, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 98],
            ['name' => json_encode(['ar' => 'جنات زيد احمد عبدالوهاب', 'en' => 'جنات زيد احمد عبدالوهاب'], JSON_UNESCAPED_UNICODE), 'email' => 'student98@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 4, 'section_id' => 4, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 99],
            ['name' => json_encode(['ar' => 'راما عبدالله قائد منصور', 'en' => 'راما عبدالله قائد منصور'], JSON_UNESCAPED_UNICODE), 'email' => 'student99@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 4, 'section_id' => 4, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 100],
            ['name' => json_encode(['ar' => 'روى ماجد احمد علي علي', 'en' => 'روى ماجد احمد علي علي'], JSON_UNESCAPED_UNICODE), 'email' => 'student100@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 4, 'section_id' => 4, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 101],
            ['name' => json_encode(['ar' => 'سارة سعيد عبده سعيد', 'en' => 'سارة سعيد عبده سعيد'], JSON_UNESCAPED_UNICODE), 'email' => 'student101@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 4, 'section_id' => 4, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 102],
            ['name' => json_encode(['ar' => 'سعاد يوسف عبد السلام قائد', 'en' => 'سعاد يوسف عبد السلام قائد'], JSON_UNESCAPED_UNICODE), 'email' => 'student102@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 4, 'section_id' => 4, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 103],
            ['name' => json_encode(['ar' => 'عبير عمار احمد محمد مهيوب', 'en' => 'عبير عمار احمد محمد مهيوب'], JSON_UNESCAPED_UNICODE), 'email' => 'student103@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 4, 'section_id' => 4, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 104],
            ['name' => json_encode(['ar' => 'فاطمة محمد محمد عبدالله النهاري', 'en' => 'فاطمة محمد محمد عبدالله النهاري'], JSON_UNESCAPED_UNICODE), 'email' => 'student104@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 4, 'section_id' => 4, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 105],
            ['name' => json_encode(['ar' => 'مرام عبدالله محمد مقبل', 'en' => 'مرام عبدالله محمد مقبل'], JSON_UNESCAPED_UNICODE), 'email' => 'student105@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 2, 'Classroom_id' => 4, 'section_id' => 4, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 106],
            ['name' => json_encode(['ar' => 'ابراهيم عبدالله سعيد احمد', 'en' => 'ابراهيم عبدالله سعيد احمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student106@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 5, 'section_id' => 5, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 107],
            ['name' => json_encode(['ar' => 'امجد مشرف عبده احمد', 'en' => 'امجد مشرف عبده احمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student107@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 5, 'section_id' => 5, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 108],
            ['name' => json_encode(['ar' => 'أنس محمد عبده سعيد', 'en' => 'أنس محمد عبده سعيد'], JSON_UNESCAPED_UNICODE), 'email' => 'student108@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 5, 'section_id' => 5, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 109],
            ['name' => json_encode(['ar' => 'ايهم محمد عبدالله محمد الحاج', 'en' => 'ايهم محمد عبدالله محمد الحاج'], JSON_UNESCAPED_UNICODE), 'email' => 'student109@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 5, 'section_id' => 5, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 110],
            ['name' => json_encode(['ar' => 'خالد عبدالرحمن عبده علي', 'en' => 'خالد عبدالرحمن عبده علي'], JSON_UNESCAPED_UNICODE), 'email' => 'student110@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 5, 'section_id' => 5, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 111],
            ['name' => json_encode(['ar' => 'خليفة نشون هاشم آمير', 'en' => 'خليفة نشون هاشم آمير'], JSON_UNESCAPED_UNICODE), 'email' => 'student111@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 5, 'section_id' => 5, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 112],
            ['name' => json_encode(['ar' => 'ريان عبده احمد محمد ناجي', 'en' => 'ريان عبده احمد محمد ناجي'], JSON_UNESCAPED_UNICODE), 'email' => 'student112@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 5, 'section_id' => 5, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 113],
            ['name' => json_encode(['ar' => 'شعيب فضل محمد عبدالله', 'en' => 'شعيب فضل محمد عبدالله'], JSON_UNESCAPED_UNICODE), 'email' => 'student113@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 5, 'section_id' => 5, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 114],
            ['name' => json_encode(['ar' => 'عابد محمد سعيد احمد', 'en' => 'عابد محمد سعيد احمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student114@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 5, 'section_id' => 5, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 115],
            ['name' => json_encode(['ar' => 'عزت مختار عبدالغفار محمد قائد', 'en' => 'عزت مختار عبدالغفار محمد قائد'], JSON_UNESCAPED_UNICODE), 'email' => 'student115@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 5, 'section_id' => 5, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 116],
            ['name' => json_encode(['ar' => 'محمد صادق سعيد علي', 'en' => 'محمد صادق سعيد علي'], JSON_UNESCAPED_UNICODE), 'email' => 'student116@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 5, 'section_id' => 5, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 117],
            ['name' => json_encode(['ar' => 'محمد علي سلطان احمد', 'en' => 'محمد علي سلطان احمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student117@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 5, 'section_id' => 5, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 118],
            ['name' => json_encode(['ar' => 'هيثم مصطفى عبدالله ابراهيم', 'en' => 'هيثم مصطفى عبدالله ابراهيم'], JSON_UNESCAPED_UNICODE), 'email' => 'student118@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 5, 'section_id' => 5, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 119],
            ['name' => json_encode(['ar' => 'هيثم وهيب سلطان مهيوب', 'en' => 'هيثم وهيب سلطان مهيوب'], JSON_UNESCAPED_UNICODE), 'email' => 'student119@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 5, 'section_id' => 5, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 120],
            ['name' => json_encode(['ar' => 'اريج محبوب محمد عبدالله', 'en' => 'اريج محبوب محمد عبدالله'], JSON_UNESCAPED_UNICODE), 'email' => 'student120@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 5, 'section_id' => 5, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 121],
            ['name' => json_encode(['ar' => 'براءة حمود سلطان جابر', 'en' => 'براءة حمود سلطان جابر'], JSON_UNESCAPED_UNICODE), 'email' => 'student121@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 5, 'section_id' => 5, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 122],
            ['name' => json_encode(['ar' => 'حورية ادم احمد مهيوب قاسم', 'en' => 'حورية ادم احمد مهيوب قاسم'], JSON_UNESCAPED_UNICODE), 'email' => 'student122@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 5, 'section_id' => 5, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 123],
            ['name' => json_encode(['ar' => 'روان مروان عبدالملك عبدالله سلطان', 'en' => 'روان مروان عبدالملك عبدالله سلطان'], JSON_UNESCAPED_UNICODE), 'email' => 'student123@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 5, 'section_id' => 5, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 124],
            ['name' => json_encode(['ar' => 'رهف مختار عبدالغفار محمد قائد', 'en' => 'رهف مختار عبدالغفار محمد قائد'], JSON_UNESCAPED_UNICODE), 'email' => 'student124@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 5, 'section_id' => 5, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 125],
            ['name' => json_encode(['ar' => 'سمية عارف ناجي محمد مهيوب', 'en' => 'سمية عارف ناجي محمد مهيوب'], JSON_UNESCAPED_UNICODE), 'email' => 'student125@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 5, 'section_id' => 5, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 126],
            ['name' => json_encode(['ar' => 'شروق محمد علي علي', 'en' => 'شروق محمد علي علي'], JSON_UNESCAPED_UNICODE), 'email' => 'student126@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 5, 'section_id' => 5, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 127],
            ['name' => json_encode(['ar' => 'شهد فؤاد علي علي', 'en' => 'شهد فؤاد علي علي'], JSON_UNESCAPED_UNICODE), 'email' => 'student127@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 5, 'section_id' => 5, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 128],
            ['name' => json_encode(['ar' => 'عائشة خليل محمد علي محمد قائد', 'en' => 'عائشة خليل محمد علي محمد قائد'], JSON_UNESCAPED_UNICODE), 'email' => 'student128@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 5, 'section_id' => 5, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 129],
            ['name' => json_encode(['ar' => 'فرح صادق سعيد علي', 'en' => 'فرح صادق سعيد علي'], JSON_UNESCAPED_UNICODE), 'email' => 'student129@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 5, 'section_id' => 5, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 130],
            ['name' => json_encode(['ar' => 'ليان عبدالعليم علي سيف', 'en' => 'ليان عبدالعليم علي سيف'], JSON_UNESCAPED_UNICODE), 'email' => 'student130@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 5, 'section_id' => 5, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 131],
            ['name' => json_encode(['ar' => 'مرام قابوس سعيد امير', 'en' => 'مرام قابوس سعيد امير'], JSON_UNESCAPED_UNICODE), 'email' => 'student131@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 5, 'section_id' => 5, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 132],
            ['name' => json_encode(['ar' => 'مريم وليد احمد عبدالله سلطان', 'en' => 'مريم وليد احمد عبدالله سلطان'], JSON_UNESCAPED_UNICODE), 'email' => 'student132@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 5, 'section_id' => 5, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 133],
            ['name' => json_encode(['ar' => 'ملاك عبدالرحمن محمد حسن', 'en' => 'ملاك عبدالرحمن محمد حسن'], JSON_UNESCAPED_UNICODE), 'email' => 'student133@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 5, 'section_id' => 5, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 134],
            ['name' => json_encode(['ar' => 'ندى سعيد عبده سعيد', 'en' => 'ندى سعيد عبده سعيد'], JSON_UNESCAPED_UNICODE), 'email' => 'student134@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 5, 'section_id' => 5, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 135],
            ['name' => json_encode(['ar' => 'نورا احمد عبدالرحمن محمد سلطان', 'en' => 'نورا احمد عبدالرحمن محمد سلطان'], JSON_UNESCAPED_UNICODE), 'email' => 'student135@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 5, 'section_id' => 5, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 136],
            ['name' => json_encode(['ar' => 'هديل بندر عبدالجليل عبدالله', 'en' => 'هديل بندر عبدالجليل عبدالله'], JSON_UNESCAPED_UNICODE), 'email' => 'student136@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 5, 'section_id' => 5, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 137],
            ['name' => json_encode(['ar' => 'الطلاب الغائبين', 'en' => 'الطلاب الغائبين'], JSON_UNESCAPED_UNICODE), 'email' => 'student137@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 5, 'section_id' => 5, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 138],
            ['name' => json_encode(['ar' => 'وليد رمزي عبدالقوي ناجي', 'en' => 'وليد رمزي عبدالقوي ناجي'], JSON_UNESCAPED_UNICODE), 'email' => 'student138@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 5, 'section_id' => 5, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 139],
            ['name' => json_encode(['ar' => 'انس فهد عبد العزيز أحمد قائد', 'en' => 'انس فهد عبد العزيز أحمد قائد'], JSON_UNESCAPED_UNICODE), 'email' => 'student139@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 6, 'section_id' => 6, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 140],
            ['name' => json_encode(['ar' => 'انس مالك عبده احمد ناجي', 'en' => 'انس مالك عبده احمد ناجي'], JSON_UNESCAPED_UNICODE), 'email' => 'student140@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 6, 'section_id' => 6, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 141],
            ['name' => json_encode(['ar' => 'جابر فيصل عبدالغني حسن', 'en' => 'جابر فيصل عبدالغني حسن'], JSON_UNESCAPED_UNICODE), 'email' => 'student141@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 6, 'section_id' => 6, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 142],
            ['name' => json_encode(['ar' => 'حمدي نجيب غالب محمد علي', 'en' => 'حمدي نجيب غالب محمد علي'], JSON_UNESCAPED_UNICODE), 'email' => 'student142@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 6, 'section_id' => 6, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 143],
            ['name' => json_encode(['ar' => 'خطاب عبده احمد محمد ناجي', 'en' => 'خطاب عبده احمد محمد ناجي'], JSON_UNESCAPED_UNICODE), 'email' => 'student143@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 6, 'section_id' => 6, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 144],
            ['name' => json_encode(['ar' => 'رضوان محمود حسن غالب', 'en' => 'رضوان محمود حسن غالب'], JSON_UNESCAPED_UNICODE), 'email' => 'student144@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 6, 'section_id' => 6, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 145],
            ['name' => json_encode(['ar' => 'ليث محمد امين حسن علي', 'en' => 'ليث محمد امين حسن علي'], JSON_UNESCAPED_UNICODE), 'email' => 'student145@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 6, 'section_id' => 6, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 146],
            ['name' => json_encode(['ar' => 'مازن معاذ محمد عبده غالب', 'en' => 'مازن معاذ محمد عبده غالب'], JSON_UNESCAPED_UNICODE), 'email' => 'student146@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 6, 'section_id' => 6, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 147],
            ['name' => json_encode(['ar' => 'مبارك رفيع علي ناجي', 'en' => 'مبارك رفيع علي ناجي'], JSON_UNESCAPED_UNICODE), 'email' => 'student147@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 6, 'section_id' => 6, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 148],
            ['name' => json_encode(['ar' => 'محمد عبد القوي سعيد محمد شمسان', 'en' => 'محمد عبد القوي سعيد محمد شمسان'], JSON_UNESCAPED_UNICODE), 'email' => 'student148@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 6, 'section_id' => 6, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 149],
            ['name' => json_encode(['ar' => 'محمد محمد عبد الله علي قائد', 'en' => 'محمد محمد عبد الله علي قائد'], JSON_UNESCAPED_UNICODE), 'email' => 'student149@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 6, 'section_id' => 6, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 150],
            ['name' => json_encode(['ar' => 'محمد فؤاد علي علي', 'en' => 'محمد فؤاد علي علي'], JSON_UNESCAPED_UNICODE), 'email' => 'student150@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 6, 'section_id' => 6, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 151],
            ['name' => json_encode(['ar' => 'مؤيد محمد سعيد ناصر', 'en' => 'مؤيد محمد سعيد ناصر'], JSON_UNESCAPED_UNICODE), 'email' => 'student151@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 6, 'section_id' => 6, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 152],
            ['name' => json_encode(['ar' => 'نزار محمد احمد محمد ناجي', 'en' => 'نزار محمد احمد محمد ناجي'], JSON_UNESCAPED_UNICODE), 'email' => 'student152@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 6, 'section_id' => 6, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 153],
            ['name' => json_encode(['ar' => 'ياسر محمد عبد الوهاب محمد', 'en' => 'ياسر محمد عبد الوهاب محمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student153@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 6, 'section_id' => 6, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 154],
            ['name' => json_encode(['ar' => 'يزن حسين علي عبدالله سلطان', 'en' => 'يزن حسين علي عبدالله سلطان'], JSON_UNESCAPED_UNICODE), 'email' => 'student154@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 6, 'section_id' => 6, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 155],
            ['name' => json_encode(['ar' => 'أضواء مكرم محمد مقبل', 'en' => 'أضواء مكرم محمد مقبل'], JSON_UNESCAPED_UNICODE), 'email' => 'student155@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 6, 'section_id' => 6, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 156],
            ['name' => json_encode(['ar' => 'الاء سمير سعيد ناصر', 'en' => 'الاء سمير سعيد ناصر'], JSON_UNESCAPED_UNICODE), 'email' => 'student156@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 6, 'section_id' => 6, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 157],
            ['name' => json_encode(['ar' => 'امل محمد احمد  محمد مهيوب', 'en' => 'امل محمد احمد  محمد مهيوب'], JSON_UNESCAPED_UNICODE), 'email' => 'student157@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 6, 'section_id' => 6, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 158],
            ['name' => json_encode(['ar' => 'بيان عبده سعيد أمير يحيَ', 'en' => 'بيان عبده سعيد أمير يحيَ'], JSON_UNESCAPED_UNICODE), 'email' => 'student158@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 6, 'section_id' => 6, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 159],
            ['name' => json_encode(['ar' => 'تغريد جار الله احمد محمد مهيوب', 'en' => 'تغريد جار الله احمد محمد مهيوب'], JSON_UNESCAPED_UNICODE), 'email' => 'student159@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 6, 'section_id' => 6, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 160],
            ['name' => json_encode(['ar' => 'زينب وهيب سلطان مهيوب', 'en' => 'زينب وهيب سلطان مهيوب'], JSON_UNESCAPED_UNICODE), 'email' => 'student160@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 6, 'section_id' => 6, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 161],
            ['name' => json_encode(['ar' => 'سارة محمد عبد الوهاب محمد', 'en' => 'سارة محمد عبد الوهاب محمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student161@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 6, 'section_id' => 6, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 162],
            ['name' => json_encode(['ar' => 'سمية معاذ احمد محمد علي', 'en' => 'سمية معاذ احمد محمد علي'], JSON_UNESCAPED_UNICODE), 'email' => 'student162@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 6, 'section_id' => 6, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 163],
            ['name' => json_encode(['ar' => 'فائدة مشرف عبده أحمد', 'en' => 'فائدة مشرف عبده أحمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student163@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 6, 'section_id' => 6, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 164],
            ['name' => json_encode(['ar' => 'فلة عبدالله هاشم أمير يحيى', 'en' => 'فلة عبدالله هاشم أمير يحيى'], JSON_UNESCAPED_UNICODE), 'email' => 'student164@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 6, 'section_id' => 6, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 165],
            ['name' => json_encode(['ar' => 'مريم رشاد حسن محمد شمسان', 'en' => 'مريم رشاد حسن محمد شمسان'], JSON_UNESCAPED_UNICODE), 'email' => 'student165@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 6, 'section_id' => 6, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 166],
            ['name' => json_encode(['ar' => 'ميسون وضاح أحمد محمد قائد', 'en' => 'ميسون وضاح أحمد محمد قائد'], JSON_UNESCAPED_UNICODE), 'email' => 'student166@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 6, 'section_id' => 6, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 167],
            ['name' => json_encode(['ar' => 'هند عبدالرحمن عبدالوهاب محمد', 'en' => 'هند عبدالرحمن عبدالوهاب محمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student167@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 6, 'section_id' => 6, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 168],
            ['name' => json_encode(['ar' => 'الطلاب الراسبون', 'en' => 'الطلاب الراسبون'], JSON_UNESCAPED_UNICODE), 'email' => 'student168@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 6, 'section_id' => 6, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 169],
            ['name' => json_encode(['ar' => 'محمد رامي علي محمد شمسان', 'en' => 'محمد رامي علي محمد شمسان'], JSON_UNESCAPED_UNICODE), 'email' => 'student169@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 6, 'section_id' => 6, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 170],
            ['name' => json_encode(['ar' => 'محمد وسيم امين غالب محمد', 'en' => 'محمد وسيم امين غالب محمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student170@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 6, 'section_id' => 6, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 171],
            ['name' => json_encode(['ar' => 'روى فيصل عبد الوهاب أمير', 'en' => 'روى فيصل عبد الوهاب أمير'], JSON_UNESCAPED_UNICODE), 'email' => 'student171@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 6, 'section_id' => 6, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 172],
            ['name' => json_encode(['ar' => 'زينب فؤاد علي علي', 'en' => 'زينب فؤاد علي علي'], JSON_UNESCAPED_UNICODE), 'email' => 'student172@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 6, 'section_id' => 6, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 173],
            ['name' => json_encode(['ar' => 'سحر عمار احمد محمد مهيوب', 'en' => 'سحر عمار احمد محمد مهيوب'], JSON_UNESCAPED_UNICODE), 'email' => 'student173@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 6, 'section_id' => 6, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 174],
            ['name' => json_encode(['ar' => 'لمياء ماجد احمد علي علي', 'en' => 'لمياء ماجد احمد علي علي'], JSON_UNESCAPED_UNICODE), 'email' => 'student174@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 6, 'section_id' => 6, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 175],
            ['name' => json_encode(['ar' => 'ملاك عزة محمد عبدالجليل ناصر', 'en' => 'ملاك عزة محمد عبدالجليل ناصر'], JSON_UNESCAPED_UNICODE), 'email' => 'student175@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 6, 'section_id' => 6, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 176],
            ['name' => json_encode(['ar' => 'احمد وهب محمد عبدالله قاسم', 'en' => 'احمد وهب محمد عبدالله قاسم'], JSON_UNESCAPED_UNICODE), 'email' => 'student176@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 7, 'section_id' => 7, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 177],
            ['name' => json_encode(['ar' => 'أصيل عبدالرقيب عبدالوهاب أمير', 'en' => 'أصيل عبدالرقيب عبدالوهاب أمير'], JSON_UNESCAPED_UNICODE), 'email' => 'student177@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 7, 'section_id' => 7, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 178],
            ['name' => json_encode(['ar' => 'حامد فهد محمد امير', 'en' => 'حامد فهد محمد امير'], JSON_UNESCAPED_UNICODE), 'email' => 'student178@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 7, 'section_id' => 7, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 179],
            ['name' => json_encode(['ar' => 'سامي صادق سعيد علي', 'en' => 'سامي صادق سعيد علي'], JSON_UNESCAPED_UNICODE), 'email' => 'student179@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 7, 'section_id' => 7, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 180],
            ['name' => json_encode(['ar' => 'سليمان عبد الحق علي سيف', 'en' => 'سليمان عبد الحق علي سيف'], JSON_UNESCAPED_UNICODE), 'email' => 'student180@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 7, 'section_id' => 7, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 181],
            ['name' => json_encode(['ar' => 'عاهد محمد عبدالله مهيوب', 'en' => 'عاهد محمد عبدالله مهيوب'], JSON_UNESCAPED_UNICODE), 'email' => 'student181@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 7, 'section_id' => 7, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 182],
            ['name' => json_encode(['ar' => 'علي حسين علي عبدالله', 'en' => 'علي حسين علي عبدالله'], JSON_UNESCAPED_UNICODE), 'email' => 'student182@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 7, 'section_id' => 7, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 183],
            ['name' => json_encode(['ar' => 'عماد سعيد عبده سعيد', 'en' => 'عماد سعيد عبده سعيد'], JSON_UNESCAPED_UNICODE), 'email' => 'student183@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 7, 'section_id' => 7, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 184],
            ['name' => json_encode(['ar' => 'محمد حسام محمد سرحان مقبل', 'en' => 'محمد حسام محمد سرحان مقبل'], JSON_UNESCAPED_UNICODE), 'email' => 'student184@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 7, 'section_id' => 7, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 185],
            ['name' => json_encode(['ar' => 'محمد رفيع علي ناجي ابراهيم', 'en' => 'محمد رفيع علي ناجي ابراهيم'], JSON_UNESCAPED_UNICODE), 'email' => 'student185@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 7, 'section_id' => 7, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 186],
            ['name' => json_encode(['ar' => 'محمد عبدالحليم عبدالله علي', 'en' => 'محمد عبدالحليم عبدالله علي'], JSON_UNESCAPED_UNICODE), 'email' => 'student186@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 7, 'section_id' => 7, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 187],
            ['name' => json_encode(['ar' => 'محمد عواش سالم حميد', 'en' => 'محمد عواش سالم حميد'], JSON_UNESCAPED_UNICODE), 'email' => 'student187@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 7, 'section_id' => 7, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 188],
            ['name' => json_encode(['ar' => 'معتصم بسام سعيد علي', 'en' => 'معتصم بسام سعيد علي'], JSON_UNESCAPED_UNICODE), 'email' => 'student188@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 7, 'section_id' => 7, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 189],
            ['name' => json_encode(['ar' => 'معتصم عبدالسلام عبد العزيز', 'en' => 'معتصم عبدالسلام عبد العزيز'], JSON_UNESCAPED_UNICODE), 'email' => 'student189@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 7, 'section_id' => 7, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 190],
            ['name' => json_encode(['ar' => 'نصر خليل محمد عبد الله', 'en' => 'نصر خليل محمد عبد الله'], JSON_UNESCAPED_UNICODE), 'email' => 'student190@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 7, 'section_id' => 7, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 191],
            ['name' => json_encode(['ar' => 'وديع زيد سلطان مهيوب', 'en' => 'وديع زيد سلطان مهيوب'], JSON_UNESCAPED_UNICODE), 'email' => 'student191@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 7, 'section_id' => 7, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 192],
            ['name' => json_encode(['ar' => 'وسام مهيوب قاسم احمد', 'en' => 'وسام مهيوب قاسم احمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student192@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 7, 'section_id' => 7, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 193],
            ['name' => json_encode(['ar' => 'يامن ماجد محمد مهيوب سعيد', 'en' => 'يامن ماجد محمد مهيوب سعيد'], JSON_UNESCAPED_UNICODE), 'email' => 'student193@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 7, 'section_id' => 7, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 194],
            ['name' => json_encode(['ar' => 'الاء وليد احمد عبد الله سلطان', 'en' => 'الاء وليد احمد عبد الله سلطان'], JSON_UNESCAPED_UNICODE), 'email' => 'student194@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 7, 'section_id' => 7, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 195],
            ['name' => json_encode(['ar' => 'امنيه عبد العزيز ناجي عبدالله', 'en' => 'امنيه عبد العزيز ناجي عبدالله'], JSON_UNESCAPED_UNICODE), 'email' => 'student195@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 7, 'section_id' => 7, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 196],
            ['name' => json_encode(['ar' => 'توكل سلطان سعيد علي', 'en' => 'توكل سلطان سعيد علي'], JSON_UNESCAPED_UNICODE), 'email' => 'student196@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 7, 'section_id' => 7, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 197],
            ['name' => json_encode(['ar' => 'جنات مبارك محمد محمد هزاع', 'en' => 'جنات مبارك محمد محمد هزاع'], JSON_UNESCAPED_UNICODE), 'email' => 'student197@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 7, 'section_id' => 7, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 198],
            ['name' => json_encode(['ar' => 'جنى عادل محمد مهيوب', 'en' => 'جنى عادل محمد مهيوب'], JSON_UNESCAPED_UNICODE), 'email' => 'student198@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 7, 'section_id' => 7, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 199],
            ['name' => json_encode(['ar' => 'دينا عبده قاسم محمد', 'en' => 'دينا عبده قاسم محمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student199@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 7, 'section_id' => 7, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 200],
            ['name' => json_encode(['ar' => 'رغد فضل قاسم محمد ناجي', 'en' => 'رغد فضل قاسم محمد ناجي'], JSON_UNESCAPED_UNICODE), 'email' => 'student200@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 7, 'section_id' => 7, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 201],
            ['name' => json_encode(['ar' => 'ريماس شكري سرحان احمد', 'en' => 'ريماس شكري سرحان احمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student201@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 7, 'section_id' => 7, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 202],
            ['name' => json_encode(['ar' => 'شهد بلال محمد حمادي', 'en' => 'شهد بلال محمد حمادي'], JSON_UNESCAPED_UNICODE), 'email' => 'student202@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 7, 'section_id' => 7, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 203],
            ['name' => json_encode(['ar' => 'غرام وليد عبد الله مهيوب', 'en' => 'غرام وليد عبد الله مهيوب'], JSON_UNESCAPED_UNICODE), 'email' => 'student203@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 7, 'section_id' => 7, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 204],
            ['name' => json_encode(['ar' => 'مارية عواش سالم حميد', 'en' => 'مارية عواش سالم حميد'], JSON_UNESCAPED_UNICODE), 'email' => 'student204@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 7, 'section_id' => 7, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 205],
            ['name' => json_encode(['ar' => 'ملاك عمر عبدالعزيز ناجي', 'en' => 'ملاك عمر عبدالعزيز ناجي'], JSON_UNESCAPED_UNICODE), 'email' => 'student205@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 7, 'section_id' => 7, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 206],
            ['name' => json_encode(['ar' => 'احمد محمد احمد محمد ناجي', 'en' => 'احمد محمد احمد محمد ناجي'], JSON_UNESCAPED_UNICODE), 'email' => 'student206@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 8, 'section_id' => 8, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 207],
            ['name' => json_encode(['ar' => 'الحارث محمد مهيوب غالب قاسم', 'en' => 'الحارث محمد مهيوب غالب قاسم'], JSON_UNESCAPED_UNICODE), 'email' => 'student207@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 8, 'section_id' => 8, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 208],
            ['name' => json_encode(['ar' => 'انس وضاح قاسم محمد ناجي', 'en' => 'انس وضاح قاسم محمد ناجي'], JSON_UNESCAPED_UNICODE), 'email' => 'student208@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 8, 'section_id' => 8, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 209],
            ['name' => json_encode(['ar' => 'حسين عبدالله عبدالعزيز عبدالله', 'en' => 'حسين عبدالله عبدالعزيز عبدالله'], JSON_UNESCAPED_UNICODE), 'email' => 'student209@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 8, 'section_id' => 8, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 210],
            ['name' => json_encode(['ar' => 'حسين محمد عبده سعيد', 'en' => 'حسين محمد عبده سعيد'], JSON_UNESCAPED_UNICODE), 'email' => 'student210@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 8, 'section_id' => 8, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 211],
            ['name' => json_encode(['ar' => 'خلدون علي سلطان احمد', 'en' => 'خلدون علي سلطان احمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student211@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 8, 'section_id' => 8, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 212],
            ['name' => json_encode(['ar' => 'سيف أحمد سيف قاسم', 'en' => 'سيف أحمد سيف قاسم'], JSON_UNESCAPED_UNICODE), 'email' => 'student212@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 8, 'section_id' => 8, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 213],
            ['name' => json_encode(['ar' => 'عبيده عبدالحق علي سيف غالب', 'en' => 'عبيده عبدالحق علي سيف غالب'], JSON_UNESCAPED_UNICODE), 'email' => 'student213@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 8, 'section_id' => 8, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 214],
            ['name' => json_encode(['ar' => 'عزالدين عبدالعزيز ناجي عبدالله', 'en' => 'عزالدين عبدالعزيز ناجي عبدالله'], JSON_UNESCAPED_UNICODE), 'email' => 'student214@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 8, 'section_id' => 8, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 215],
            ['name' => json_encode(['ar' => 'كريم فؤاد احمد محمد قائد', 'en' => 'كريم فؤاد احمد محمد قائد'], JSON_UNESCAPED_UNICODE), 'email' => 'student215@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 8, 'section_id' => 8, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 216],
            ['name' => json_encode(['ar' => 'محمد عبدالله سعيد احمد', 'en' => 'محمد عبدالله سعيد احمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student216@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 8, 'section_id' => 8, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 217],
            ['name' => json_encode(['ar' => 'محمد عبده علي محمد قائد', 'en' => 'محمد عبده علي محمد قائد'], JSON_UNESCAPED_UNICODE), 'email' => 'student217@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 8, 'section_id' => 8, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 218],
            ['name' => json_encode(['ar' => 'محمد ماجد احمد علي', 'en' => 'محمد ماجد احمد علي'], JSON_UNESCAPED_UNICODE), 'email' => 'student218@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 8, 'section_id' => 8, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 219],
            ['name' => json_encode(['ar' => 'محمد نظير محمود احمد علي', 'en' => 'محمد نظير محمود احمد علي'], JSON_UNESCAPED_UNICODE), 'email' => 'student219@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 8, 'section_id' => 8, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 220],
            ['name' => json_encode(['ar' => 'محمد وسام محمود الحاج عبدالولي', 'en' => 'محمد وسام محمود الحاج عبدالولي'], JSON_UNESCAPED_UNICODE), 'email' => 'student220@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 8, 'section_id' => 8, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 221],
            ['name' => json_encode(['ar' => 'محمدعبدالله عبدالله سعيد طالب', 'en' => 'محمدعبدالله عبدالله سعيد طالب'], JSON_UNESCAPED_UNICODE), 'email' => 'student221@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 8, 'section_id' => 8, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 222],
            ['name' => json_encode(['ar' => 'مختار سلطان سعيد علي', 'en' => 'مختار سلطان سعيد علي'], JSON_UNESCAPED_UNICODE), 'email' => 'student222@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 8, 'section_id' => 8, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 223],
            ['name' => json_encode(['ar' => 'مراد فهد عبدالله سلطان غالب', 'en' => 'مراد فهد عبدالله سلطان غالب'], JSON_UNESCAPED_UNICODE), 'email' => 'student223@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 8, 'section_id' => 8, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 224],
            ['name' => json_encode(['ar' => 'مصطفى عبدالله سلطان غالب', 'en' => 'مصطفى عبدالله سلطان غالب'], JSON_UNESCAPED_UNICODE), 'email' => 'student224@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 8, 'section_id' => 8, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 225],
            ['name' => json_encode(['ar' => 'اشواق توفيق عبده علي', 'en' => 'اشواق توفيق عبده علي'], JSON_UNESCAPED_UNICODE), 'email' => 'student225@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 8, 'section_id' => 8, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 226],
            ['name' => json_encode(['ar' => 'اماني عبد القوي سعيد محمد', 'en' => 'اماني عبد القوي سعيد محمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student226@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 8, 'section_id' => 8, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 227],
            ['name' => json_encode(['ar' => 'ايناس محمد عبدالباري حسن علي', 'en' => 'ايناس محمد عبدالباري حسن علي'], JSON_UNESCAPED_UNICODE), 'email' => 'student227@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 8, 'section_id' => 8, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 228],
            ['name' => json_encode(['ar' => 'آية سميح احمد سعيد قائد', 'en' => 'آية سميح احمد سعيد قائد'], JSON_UNESCAPED_UNICODE), 'email' => 'student228@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 8, 'section_id' => 8, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 229],
            ['name' => json_encode(['ar' => 'ثريا وائل عبدالغني حسن علي', 'en' => 'ثريا وائل عبدالغني حسن علي'], JSON_UNESCAPED_UNICODE), 'email' => 'student229@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 8, 'section_id' => 8, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 230],
            ['name' => json_encode(['ar' => 'خديجه خليل محمد علي محمد', 'en' => 'خديجه خليل محمد علي محمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student230@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 8, 'section_id' => 8, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 231],
            ['name' => json_encode(['ar' => 'رفاء مختارعبدالغفار محمد', 'en' => 'رفاء مختارعبدالغفار محمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student231@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 8, 'section_id' => 8, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 232],
            ['name' => json_encode(['ar' => 'زينب بسام سعيد علي عبدالله', 'en' => 'زينب بسام سعيد علي عبدالله'], JSON_UNESCAPED_UNICODE), 'email' => 'student232@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 8, 'section_id' => 8, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 233],
            ['name' => json_encode(['ar' => 'زينب مطهر عبدالله سلطان', 'en' => 'زينب مطهر عبدالله سلطان'], JSON_UNESCAPED_UNICODE), 'email' => 'student233@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 8, 'section_id' => 8, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 234],
            ['name' => json_encode(['ar' => 'سميه انور عبدالباري حسن علي', 'en' => 'سميه انور عبدالباري حسن علي'], JSON_UNESCAPED_UNICODE), 'email' => 'student234@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 8, 'section_id' => 8, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 235],
            ['name' => json_encode(['ar' => 'عائشه وليد العزي علي عبدالله', 'en' => 'عائشه وليد العزي علي عبدالله'], JSON_UNESCAPED_UNICODE), 'email' => 'student235@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 8, 'section_id' => 8, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 236],
            ['name' => json_encode(['ar' => 'غرام محمد سرحان قاسم', 'en' => 'غرام محمد سرحان قاسم'], JSON_UNESCAPED_UNICODE), 'email' => 'student236@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 8, 'section_id' => 8, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 237],
            ['name' => json_encode(['ar' => 'منال احمد سيف قاسم', 'en' => 'منال احمد سيف قاسم'], JSON_UNESCAPED_UNICODE), 'email' => 'student237@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 8, 'section_id' => 8, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 238],
            ['name' => json_encode(['ar' => 'ولاية عبده محمد احمد غالب', 'en' => 'ولاية عبده محمد احمد غالب'], JSON_UNESCAPED_UNICODE), 'email' => 'student238@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 8, 'section_id' => 8, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 239],
            ['name' => json_encode(['ar' => 'احمد عبدالعليم محمد مهيوب', 'en' => 'احمد عبدالعليم محمد مهيوب'], JSON_UNESCAPED_UNICODE), 'email' => 'student239@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 9, 'section_id' => 9, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 240],
            ['name' => json_encode(['ar' => 'ايمن محمد علي علي قائد', 'en' => 'ايمن محمد علي علي قائد'], JSON_UNESCAPED_UNICODE), 'email' => 'student240@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 9, 'section_id' => 9, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 241],
            ['name' => json_encode(['ar' => 'تامر محبوب محمد عبدالله', 'en' => 'تامر محبوب محمد عبدالله'], JSON_UNESCAPED_UNICODE), 'email' => 'student241@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 9, 'section_id' => 9, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 242],
            ['name' => json_encode(['ar' => 'حامد عبدالرحمن عبدالله محمد احمد حسان', 'en' => 'حامد عبدالرحمن عبدالله محمد احمد حسان'], JSON_UNESCAPED_UNICODE), 'email' => 'student242@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 9, 'section_id' => 9, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 243],
            ['name' => json_encode(['ar' => 'حسين محمد محمدعبدالله النهاري', 'en' => 'حسين محمد محمدعبدالله النهاري'], JSON_UNESCAPED_UNICODE), 'email' => 'student243@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 9, 'section_id' => 9, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 244],
            ['name' => json_encode(['ar' => 'زكي وليد حسن محمد شمسان', 'en' => 'زكي وليد حسن محمد شمسان'], JSON_UNESCAPED_UNICODE), 'email' => 'student244@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 9, 'section_id' => 9, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 245],
            ['name' => json_encode(['ar' => 'صخر عبدالكريم محمد عبدالله', 'en' => 'صخر عبدالكريم محمد عبدالله'], JSON_UNESCAPED_UNICODE), 'email' => 'student245@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 9, 'section_id' => 9, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 246],
            ['name' => json_encode(['ar' => 'عرفات عبدالرقيب عبدالوهاب امير', 'en' => 'عرفات عبدالرقيب عبدالوهاب امير'], JSON_UNESCAPED_UNICODE), 'email' => 'student246@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 9, 'section_id' => 9, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 247],
            ['name' => json_encode(['ar' => 'عزام مروان عبدالملك عبدالله', 'en' => 'عزام مروان عبدالملك عبدالله'], JSON_UNESCAPED_UNICODE), 'email' => 'student247@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 9, 'section_id' => 9, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 248],
            ['name' => json_encode(['ar' => 'عمر محمد عبدالله محمد علي', 'en' => 'عمر محمد عبدالله محمد علي'], JSON_UNESCAPED_UNICODE), 'email' => 'student248@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 9, 'section_id' => 9, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 249],
            ['name' => json_encode(['ar' => 'فراس محمد عبدالله محمد الحاج', 'en' => 'فراس محمد عبدالله محمد الحاج'], JSON_UNESCAPED_UNICODE), 'email' => 'student249@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 9, 'section_id' => 9, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 250],
            ['name' => json_encode(['ar' => 'كريم وائل عبدالغني حسن', 'en' => 'كريم وائل عبدالغني حسن'], JSON_UNESCAPED_UNICODE), 'email' => 'student250@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 9, 'section_id' => 9, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 251],
            ['name' => json_encode(['ar' => 'محمد بدر امين حسن علي', 'en' => 'محمد بدر امين حسن علي'], JSON_UNESCAPED_UNICODE), 'email' => 'student251@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 9, 'section_id' => 9, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 252],
            ['name' => json_encode(['ar' => 'محمد طلال مهيوب محمد', 'en' => 'محمد طلال مهيوب محمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student252@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 9, 'section_id' => 9, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 253],
            ['name' => json_encode(['ar' => 'ماهر محمد سعيد ناصر', 'en' => 'ماهر محمد سعيد ناصر'], JSON_UNESCAPED_UNICODE), 'email' => 'student253@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 9, 'section_id' => 9, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 254],
            ['name' => json_encode(['ar' => 'مراد قابوس سعيد أمير', 'en' => 'مراد قابوس سعيد أمير'], JSON_UNESCAPED_UNICODE), 'email' => 'student254@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 9, 'section_id' => 9, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 255],
            ['name' => json_encode(['ar' => 'مرسل رمزي عبدالقوي ناجي', 'en' => 'مرسل رمزي عبدالقوي ناجي'], JSON_UNESCAPED_UNICODE), 'email' => 'student255@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 9, 'section_id' => 9, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 256],
            ['name' => json_encode(['ar' => 'معتصم محمد احمد مهيوب', 'en' => 'معتصم محمد احمد مهيوب'], JSON_UNESCAPED_UNICODE), 'email' => 'student256@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 9, 'section_id' => 9, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 257],
            ['name' => json_encode(['ar' => 'مؤيد عارف ناجي محمد مهيوب', 'en' => 'مؤيد عارف ناجي محمد مهيوب'], JSON_UNESCAPED_UNICODE), 'email' => 'student257@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 9, 'section_id' => 9, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 258],
            ['name' => json_encode(['ar' => 'ابتهال سعيد ناصر قاسم', 'en' => 'ابتهال سعيد ناصر قاسم'], JSON_UNESCAPED_UNICODE), 'email' => 'student258@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 9, 'section_id' => 9, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 259],
            ['name' => json_encode(['ar' => 'اسراء محمد احمد محمد', 'en' => 'اسراء محمد احمد محمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student259@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 9, 'section_id' => 9, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 260],
            ['name' => json_encode(['ar' => 'انهار عبد الكريم محمد عبد الله', 'en' => 'انهار عبد الكريم محمد عبد الله'], JSON_UNESCAPED_UNICODE), 'email' => 'student260@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 9, 'section_id' => 9, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 261],
            ['name' => json_encode(['ar' => 'ألفت مكرم محمد مقبل ناجي', 'en' => 'ألفت مكرم محمد مقبل ناجي'], JSON_UNESCAPED_UNICODE), 'email' => 'student261@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 9, 'section_id' => 9, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 262],
            ['name' => json_encode(['ar' => 'حماس احمد عبدالعزيز عبدالله علي', 'en' => 'حماس احمد عبدالعزيز عبدالله علي'], JSON_UNESCAPED_UNICODE), 'email' => 'student262@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 9, 'section_id' => 9, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 263],
            ['name' => json_encode(['ar' => 'روى مختار عبدالغفار محمد', 'en' => 'روى مختار عبدالغفار محمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student263@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 9, 'section_id' => 9, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 264],
            ['name' => json_encode(['ar' => 'سلا محمد عبدالوهاب محمد', 'en' => 'سلا محمد عبدالوهاب محمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student264@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 9, 'section_id' => 9, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 265],
            ['name' => json_encode(['ar' => 'سهى محمد عبدالله سعيد علي', 'en' => 'سهى محمد عبدالله سعيد علي'], JSON_UNESCAPED_UNICODE), 'email' => 'student265@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 9, 'section_id' => 9, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 266],
            ['name' => json_encode(['ar' => 'شهد بندر عبدالجليل عبدالله', 'en' => 'شهد بندر عبدالجليل عبدالله'], JSON_UNESCAPED_UNICODE), 'email' => 'student266@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 9, 'section_id' => 9, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 267],
            ['name' => json_encode(['ar' => 'ميرفت عبدالله محمد مقبل', 'en' => 'ميرفت عبدالله محمد مقبل'], JSON_UNESCAPED_UNICODE), 'email' => 'student267@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 9, 'section_id' => 9, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 268],
            ['name' => json_encode(['ar' => 'مروى جميل محمد قاسم', 'en' => 'مروى جميل محمد قاسم'], JSON_UNESCAPED_UNICODE), 'email' => 'student268@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 9, 'section_id' => 9, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 269],
            ['name' => json_encode(['ar' => 'ملاك مالك عبده أحمد ناجي', 'en' => 'ملاك مالك عبده أحمد ناجي'], JSON_UNESCAPED_UNICODE), 'email' => 'student269@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 9, 'section_id' => 9, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 270],
            ['name' => json_encode(['ar' => 'نجيبه زكي محمد عبدالجليل', 'en' => 'نجيبه زكي محمد عبدالجليل'], JSON_UNESCAPED_UNICODE), 'email' => 'student270@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 9, 'section_id' => 9, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 271],
            ['name' => json_encode(['ar' => 'نسيبة فؤاد علي علي محمد', 'en' => 'نسيبة فؤاد علي علي محمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student271@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 9, 'section_id' => 9, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 272],
            ['name' => json_encode(['ar' => 'نهاية محمد عبدالله احمد', 'en' => 'نهاية محمد عبدالله احمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student272@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 9, 'section_id' => 9, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 273],
            ['name' => json_encode(['ar' => 'نوارة وليد علي محمد احمد', 'en' => 'نوارة وليد علي محمد احمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student273@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 9, 'section_id' => 9, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 274],
            ['name' => json_encode(['ar' => 'الطلاب الراسبون', 'en' => 'الطلاب الراسبون'], JSON_UNESCAPED_UNICODE), 'email' => 'student274@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 9, 'section_id' => 9, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 275],
            ['name' => json_encode(['ar' => 'لطيفة مشرف عبده احمد', 'en' => 'لطيفة مشرف عبده احمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student275@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 9, 'section_id' => 9, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 276],
            ['name' => json_encode(['ar' => 'إبراهيم فيصل عبدالغني حسن', 'en' => 'إبراهيم فيصل عبدالغني حسن'], JSON_UNESCAPED_UNICODE), 'email' => 'student276@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 10, 'section_id' => 10, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 277],
            ['name' => json_encode(['ar' => 'إبراهيم مكرم عبدالله سلطان', 'en' => 'إبراهيم مكرم عبدالله سلطان'], JSON_UNESCAPED_UNICODE), 'email' => 'student277@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 10, 'section_id' => 10, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 278],
            ['name' => json_encode(['ar' => 'أحمد محمد سعيد أحمد', 'en' => 'أحمد محمد سعيد أحمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student278@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 10, 'section_id' => 10, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 279],
            ['name' => json_encode(['ar' => 'أسامة أمين محمد علي سيف', 'en' => 'أسامة أمين محمد علي سيف'], JSON_UNESCAPED_UNICODE), 'email' => 'student279@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 10, 'section_id' => 10, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 280],
            ['name' => json_encode(['ar' => 'أكرم سميح أحمد سعيد قائد', 'en' => 'أكرم سميح أحمد سعيد قائد'], JSON_UNESCAPED_UNICODE), 'email' => 'student280@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 10, 'section_id' => 10, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 281],
            ['name' => json_encode(['ar' => 'بشير أحمد حيدرة أحمد', 'en' => 'بشير أحمد حيدرة أحمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student281@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 10, 'section_id' => 10, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 282],
            ['name' => json_encode(['ar' => 'حسام عزت محمد عبدالجليل', 'en' => 'حسام عزت محمد عبدالجليل'], JSON_UNESCAPED_UNICODE), 'email' => 'student282@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 10, 'section_id' => 10, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 283],
            ['name' => json_encode(['ar' => 'خالد زيد سلطان مهيوب قاسم', 'en' => 'خالد زيد سلطان مهيوب قاسم'], JSON_UNESCAPED_UNICODE), 'email' => 'student283@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 10, 'section_id' => 10, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 284],
            ['name' => json_encode(['ar' => 'سهيل عبدالله عبدالعزيز عبدالله', 'en' => 'سهيل عبدالله عبدالعزيز عبدالله'], JSON_UNESCAPED_UNICODE), 'email' => 'student284@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 10, 'section_id' => 10, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 285],
            ['name' => json_encode(['ar' => 'شوقي نشوان هاشم أمير', 'en' => 'شوقي نشوان هاشم أمير'], JSON_UNESCAPED_UNICODE), 'email' => 'student285@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 10, 'section_id' => 10, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 286],
            ['name' => json_encode(['ar' => 'صُهيب أحمد عبدالرحمن محمد', 'en' => 'صُهيب أحمد عبدالرحمن محمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student286@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 10, 'section_id' => 10, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 287],
            ['name' => json_encode(['ar' => 'عبدالناصر سلطان محمد احمد', 'en' => 'عبدالناصر سلطان محمد احمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student287@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 10, 'section_id' => 10, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 288],
            ['name' => json_encode(['ar' => 'قُصي محمد محمد مهيوب قاسم', 'en' => 'قُصي محمد محمد مهيوب قاسم'], JSON_UNESCAPED_UNICODE), 'email' => 'student288@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 10, 'section_id' => 10, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 289],
            ['name' => json_encode(['ar' => 'لؤي توفيق عبده علي قائد', 'en' => 'لؤي توفيق عبده علي قائد'], JSON_UNESCAPED_UNICODE), 'email' => 'student289@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 10, 'section_id' => 10, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 290],
            ['name' => json_encode(['ar' => 'محمد أحمد محمد عبده غالب', 'en' => 'محمد أحمد محمد عبده غالب'], JSON_UNESCAPED_UNICODE), 'email' => 'student290@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 10, 'section_id' => 10, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 291],
            ['name' => json_encode(['ar' => 'محمد عبدالعزيز محمد حمادي', 'en' => 'محمد عبدالعزيز محمد حمادي'], JSON_UNESCAPED_UNICODE), 'email' => 'student291@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 10, 'section_id' => 10, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 292],
            ['name' => json_encode(['ar' => 'محمد علي عبدالله أحمد محمد', 'en' => 'محمد علي عبدالله أحمد محمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student292@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 10, 'section_id' => 10, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 293],
            ['name' => json_encode(['ar' => 'محمد وضاح أحمد محمد قائد', 'en' => 'محمد وضاح أحمد محمد قائد'], JSON_UNESCAPED_UNICODE), 'email' => 'student293@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 10, 'section_id' => 10, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 294],
            ['name' => json_encode(['ar' => 'وسام مبارك محمد محمد هزاع', 'en' => 'وسام مبارك محمد محمد هزاع'], JSON_UNESCAPED_UNICODE), 'email' => 'student294@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 10, 'section_id' => 10, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 295],
            ['name' => json_encode(['ar' => 'أرزاق خليل عبدالقوي محمد', 'en' => 'أرزاق خليل عبدالقوي محمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student295@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 10, 'section_id' => 10, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 296],
            ['name' => json_encode(['ar' => 'أسيل عبدالله عبدالله سعيد طالب', 'en' => 'أسيل عبدالله عبدالله سعيد طالب'], JSON_UNESCAPED_UNICODE), 'email' => 'student296@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 10, 'section_id' => 10, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 297],
            ['name' => json_encode(['ar' => 'تهاني سعيد محمد شمسان', 'en' => 'تهاني سعيد محمد شمسان'], JSON_UNESCAPED_UNICODE), 'email' => 'student297@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 10, 'section_id' => 10, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 298],
            ['name' => json_encode(['ar' => 'تيسير سعيد عبده سعيد', 'en' => 'تيسير سعيد عبده سعيد'], JSON_UNESCAPED_UNICODE), 'email' => 'student298@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 10, 'section_id' => 10, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 299],
            ['name' => json_encode(['ar' => 'تيماء عبدالعزيز ناجي عبدالله', 'en' => 'تيماء عبدالعزيز ناجي عبدالله'], JSON_UNESCAPED_UNICODE), 'email' => 'student299@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 10, 'section_id' => 10, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 300],
            ['name' => json_encode(['ar' => 'دلال رامي علي محمد شمسان', 'en' => 'دلال رامي علي محمد شمسان'], JSON_UNESCAPED_UNICODE), 'email' => 'student300@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 10, 'section_id' => 10, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 301],
            ['name' => json_encode(['ar' => 'رابعة عبدالله سعيد أحمد', 'en' => 'رابعة عبدالله سعيد أحمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student301@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 10, 'section_id' => 10, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 302],
            ['name' => json_encode(['ar' => 'ساجدة محمد سعيد أحمد', 'en' => 'ساجدة محمد سعيد أحمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student302@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 3, 'Classroom_id' => 10, 'section_id' => 10, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 303],
            ['name' => json_encode(['ar' => 'امل وحيد عبدالعزيز ناصر', 'en' => 'امل وحيد عبدالعزيز ناصر'], JSON_UNESCAPED_UNICODE), 'email' => 'student303@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 4, 'Classroom_id' => 11, 'section_id' => 11, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 304],
            ['name' => json_encode(['ar' => 'آيه وليد احمد عبدالله سلطان', 'en' => 'آيه وليد احمد عبدالله سلطان'], JSON_UNESCAPED_UNICODE), 'email' => 'student304@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 4, 'Classroom_id' => 11, 'section_id' => 11, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 305],
            ['name' => json_encode(['ar' => 'بثينة عزت محمد عبدالجليل ناصر', 'en' => 'بثينة عزت محمد عبدالجليل ناصر'], JSON_UNESCAPED_UNICODE), 'email' => 'student305@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 4, 'Classroom_id' => 11, 'section_id' => 11, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 306],
            ['name' => json_encode(['ar' => 'بسمله فؤاد احمد محمد قائد', 'en' => 'بسمله فؤاد احمد محمد قائد'], JSON_UNESCAPED_UNICODE), 'email' => 'student306@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 4, 'Classroom_id' => 11, 'section_id' => 11, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 307],
            ['name' => json_encode(['ar' => 'رئاف عبدالسلام علي ناصر', 'en' => 'رئاف عبدالسلام علي ناصر'], JSON_UNESCAPED_UNICODE), 'email' => 'student307@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 4, 'Classroom_id' => 11, 'section_id' => 11, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 308],
            ['name' => json_encode(['ar' => 'رغد وليد عبدالله مهيوب حمادي', 'en' => 'رغد وليد عبدالله مهيوب حمادي'], JSON_UNESCAPED_UNICODE), 'email' => 'student308@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 4, 'Classroom_id' => 11, 'section_id' => 11, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 309],
            ['name' => json_encode(['ar' => 'عائشة جميل محمد قاسم محمد', 'en' => 'عائشة جميل محمد قاسم محمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student309@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 4, 'Classroom_id' => 11, 'section_id' => 11, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 310],
            ['name' => json_encode(['ar' => 'عائشة عبدالباسط احمد محمد علي', 'en' => 'عائشة عبدالباسط احمد محمد علي'], JSON_UNESCAPED_UNICODE), 'email' => 'student310@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 4, 'Classroom_id' => 11, 'section_id' => 11, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 311],
            ['name' => json_encode(['ar' => 'غادة علي سلطان احمد', 'en' => 'غادة علي سلطان احمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student311@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 4, 'Classroom_id' => 11, 'section_id' => 11, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 312],
            ['name' => json_encode(['ar' => 'هدى بندر عبدالجليل عبدالله سلطان', 'en' => 'هدى بندر عبدالجليل عبدالله سلطان'], JSON_UNESCAPED_UNICODE), 'email' => 'student312@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 4, 'Classroom_id' => 11, 'section_id' => 11, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 313],
            ['name' => json_encode(['ar' => 'ورده  كامل حسن علي عبده', 'en' => 'ورده  كامل حسن علي عبده'], JSON_UNESCAPED_UNICODE), 'email' => 'student313@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 4, 'Classroom_id' => 11, 'section_id' => 11, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 314],
            ['name' => json_encode(['ar' => 'ابرار بندر محمد احمد', 'en' => 'ابرار بندر محمد احمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student314@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 4, 'Classroom_id' => 12, 'section_id' => 12, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 315],
            ['name' => json_encode(['ar' => 'ألاء فاروق سرحان أحمد', 'en' => 'ألاء فاروق سرحان أحمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student315@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 4, 'Classroom_id' => 12, 'section_id' => 12, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 316],
            ['name' => json_encode(['ar' => 'أميرة محمد عبده مهيوب قاسم', 'en' => 'أميرة محمد عبده مهيوب قاسم'], JSON_UNESCAPED_UNICODE), 'email' => 'student316@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 4, 'Classroom_id' => 12, 'section_id' => 12, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 317],
            ['name' => json_encode(['ar' => 'أميمة سعيد عبده سعيد', 'en' => 'أميمة سعيد عبده سعيد'], JSON_UNESCAPED_UNICODE), 'email' => 'student317@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 4, 'Classroom_id' => 12, 'section_id' => 12, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 318],
            ['name' => json_encode(['ar' => 'تسنيم احمد عبده مقبل', 'en' => 'تسنيم احمد عبده مقبل'], JSON_UNESCAPED_UNICODE), 'email' => 'student318@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 4, 'Classroom_id' => 12, 'section_id' => 12, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 319],
            ['name' => json_encode(['ar' => 'حماس نبيل احمد علي العبيدي', 'en' => 'حماس نبيل احمد علي العبيدي'], JSON_UNESCAPED_UNICODE), 'email' => 'student319@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 4, 'Classroom_id' => 12, 'section_id' => 12, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 320],
            ['name' => json_encode(['ar' => 'خديجة أحمد علي سيف غالب', 'en' => 'خديجة أحمد علي سيف غالب'], JSON_UNESCAPED_UNICODE), 'email' => 'student320@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 4, 'Classroom_id' => 12, 'section_id' => 12, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 321],
            ['name' => json_encode(['ar' => 'رغد عبدالرقيب ناجي أحمد', 'en' => 'رغد عبدالرقيب ناجي أحمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student321@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 4, 'Classroom_id' => 12, 'section_id' => 12, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 322],
            ['name' => json_encode(['ar' => 'رفيقة عبدالقادر عبده أحمد', 'en' => 'رفيقة عبدالقادر عبده أحمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student322@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 4, 'Classroom_id' => 12, 'section_id' => 12, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 323],
            ['name' => json_encode(['ar' => 'روعة عبده سعيد امير', 'en' => 'روعة عبده سعيد امير'], JSON_UNESCAPED_UNICODE), 'email' => 'student323@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 4, 'Classroom_id' => 12, 'section_id' => 12, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 324],
            ['name' => json_encode(['ar' => 'روعة وضاح محمد قاسم سيف', 'en' => 'روعة وضاح محمد قاسم سيف'], JSON_UNESCAPED_UNICODE), 'email' => 'student324@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 4, 'Classroom_id' => 12, 'section_id' => 12, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 325],
            ['name' => json_encode(['ar' => 'زينب وليد حسن محمد شمسان', 'en' => 'زينب وليد حسن محمد شمسان'], JSON_UNESCAPED_UNICODE), 'email' => 'student325@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 4, 'Classroom_id' => 12, 'section_id' => 12, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 326],
            ['name' => json_encode(['ar' => 'ظفار سلطان قاسم إسماعيل', 'en' => 'ظفار سلطان قاسم إسماعيل'], JSON_UNESCAPED_UNICODE), 'email' => 'student326@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 4, 'Classroom_id' => 12, 'section_id' => 12, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 327],
            ['name' => json_encode(['ar' => 'كفى معاذ محمد عبده غالب', 'en' => 'كفى معاذ محمد عبده غالب'], JSON_UNESCAPED_UNICODE), 'email' => 'student327@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 4, 'Classroom_id' => 12, 'section_id' => 12, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 328],
            ['name' => json_encode(['ar' => 'مروى احمد محمد فائد', 'en' => 'مروى احمد محمد فائد'], JSON_UNESCAPED_UNICODE), 'email' => 'student328@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 4, 'Classroom_id' => 12, 'section_id' => 12, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 329],
            ['name' => json_encode(['ar' => 'منى فضل عبدالعزيز احمد', 'en' => 'منى فضل عبدالعزيز احمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student329@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 4, 'Classroom_id' => 12, 'section_id' => 12, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 330],
            ['name' => json_encode(['ar' => 'نسرين محمود حسن غالب', 'en' => 'نسرين محمود حسن غالب'], JSON_UNESCAPED_UNICODE), 'email' => 'student330@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 4, 'Classroom_id' => 12, 'section_id' => 12, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 331],
            ['name' => json_encode(['ar' => 'هبة عبدالدائم عبدالعزيز احمد', 'en' => 'هبة عبدالدائم عبدالعزيز احمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student331@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 4, 'Classroom_id' => 12, 'section_id' => 12, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 332],
            ['name' => json_encode(['ar' => 'هند فؤاد علي علي', 'en' => 'هند فؤاد علي علي'], JSON_UNESCAPED_UNICODE), 'email' => 'student332@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 2, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 4, 'Classroom_id' => 12, 'section_id' => 12, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('students')->updateOrInsert(
            ['id' => 333],
            ['name' => json_encode(['ar' => 'هنود عبدالجبار محمد احمد', 'en' => 'هنود عبدالجبار محمد احمد'], JSON_UNESCAPED_UNICODE), 'email' => 'student333@madrasati.app', 'password' => Hash::make('12345678'), 'gender_id' => 1, 'nationalitie_id' => 1, 'blood_id' => 1, 'Date_Birth' => '2010-01-01', 'Grade_id' => 4, 'Classroom_id' => 12, 'section_id' => 12, 'parent_id' => 1, 'academic_year' => '2023/2024', 'created_at' => now(), 'updated_at' => now()]
        );

        // ========================================
        // 5. الدرجات (Degrees)
        // ========================================
        DB::table('degrees')->truncate();
        DB::table('degrees')->insert([
            'student_id' => 1, 'quizze_id' => 1, 'question_id' => 1, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 1, 'quizze_id' => 2, 'question_id' => 2, 'score' => 93.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 1, 'quizze_id' => 3, 'question_id' => 3, 'score' => 77.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 1, 'quizze_id' => 5, 'question_id' => 5, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 1, 'quizze_id' => 6, 'question_id' => 6, 'score' => 82.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 1, 'quizze_id' => 7, 'question_id' => 7, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 2, 'quizze_id' => 1, 'question_id' => 1, 'score' => 96.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 2, 'quizze_id' => 2, 'question_id' => 2, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 2, 'quizze_id' => 3, 'question_id' => 3, 'score' => 92.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 2, 'quizze_id' => 5, 'question_id' => 5, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 2, 'quizze_id' => 6, 'question_id' => 6, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 20.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 2, 'quizze_id' => 7, 'question_id' => 7, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 3, 'quizze_id' => 1, 'question_id' => 1, 'score' => 71.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 3, 'quizze_id' => 2, 'question_id' => 2, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 3, 'quizze_id' => 3, 'question_id' => 3, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 22.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 3, 'quizze_id' => 5, 'question_id' => 5, 'score' => 61.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 3, 'quizze_id' => 6, 'question_id' => 6, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 23.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 3, 'quizze_id' => 7, 'question_id' => 7, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 4, 'quizze_id' => 1, 'question_id' => 1, 'score' => 78.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 4, 'quizze_id' => 2, 'question_id' => 2, 'score' => 79.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 4, 'quizze_id' => 3, 'question_id' => 3, 'score' => 62.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 4, 'quizze_id' => 5, 'question_id' => 5, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 4, 'quizze_id' => 6, 'question_id' => 6, 'score' => 85.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 4, 'quizze_id' => 7, 'question_id' => 7, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 5, 'quizze_id' => 1, 'question_id' => 1, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 5, 'quizze_id' => 2, 'question_id' => 2, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 5, 'quizze_id' => 3, 'question_id' => 3, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 5, 'quizze_id' => 5, 'question_id' => 5, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 5, 'quizze_id' => 6, 'question_id' => 6, 'score' => 85.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 5, 'quizze_id' => 7, 'question_id' => 7, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 6, 'quizze_id' => 1, 'question_id' => 1, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 6, 'quizze_id' => 2, 'question_id' => 2, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 6, 'quizze_id' => 3, 'question_id' => 3, 'score' => 75.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 6, 'quizze_id' => 5, 'question_id' => 5, 'score' => 78.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 6, 'quizze_id' => 6, 'question_id' => 6, 'score' => 62.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 6, 'quizze_id' => 7, 'question_id' => 7, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 7, 'quizze_id' => 1, 'question_id' => 1, 'score' => 98.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 7, 'quizze_id' => 2, 'question_id' => 2, 'score' => 81.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 7, 'quizze_id' => 3, 'question_id' => 3, 'score' => 92.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 7, 'quizze_id' => 5, 'question_id' => 5, 'score' => 92.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 7, 'quizze_id' => 6, 'question_id' => 6, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 7, 'quizze_id' => 7, 'question_id' => 7, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 8, 'quizze_id' => 1, 'question_id' => 1, 'score' => 94.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 8, 'quizze_id' => 2, 'question_id' => 2, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 8, 'quizze_id' => 3, 'question_id' => 3, 'score' => 93.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 8, 'quizze_id' => 5, 'question_id' => 5, 'score' => 93.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 8, 'quizze_id' => 6, 'question_id' => 6, 'score' => 54.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 20.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 8, 'quizze_id' => 7, 'question_id' => 7, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 9, 'quizze_id' => 1, 'question_id' => 1, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 9, 'quizze_id' => 2, 'question_id' => 2, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 9, 'quizze_id' => 3, 'question_id' => 3, 'score' => 75.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 9, 'quizze_id' => 5, 'question_id' => 5, 'score' => 73.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 9, 'quizze_id' => 6, 'question_id' => 6, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 9, 'quizze_id' => 7, 'question_id' => 7, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 10, 'quizze_id' => 1, 'question_id' => 1, 'score' => 64.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 10, 'quizze_id' => 2, 'question_id' => 2, 'score' => 72.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 10, 'quizze_id' => 3, 'question_id' => 3, 'score' => 56.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 24.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 10, 'quizze_id' => 5, 'question_id' => 5, 'score' => 73.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 10, 'quizze_id' => 6, 'question_id' => 6, 'score' => 94.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 10, 'quizze_id' => 7, 'question_id' => 7, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الروضة 2 - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 13, 'quizze_id' => 11, 'question_id' => 11, 'score' => 84.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 13, 'quizze_id' => 12, 'question_id' => 12, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 13, 'quizze_id' => 13, 'question_id' => 13, 'score' => 77.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 13, 'quizze_id' => 15, 'question_id' => 15, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 13, 'quizze_id' => 16, 'question_id' => 16, 'score' => 75.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 13, 'quizze_id' => 17, 'question_id' => 17, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 14, 'quizze_id' => 11, 'question_id' => 11, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 14, 'quizze_id' => 12, 'question_id' => 12, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 14, 'quizze_id' => 13, 'question_id' => 13, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 14, 'quizze_id' => 15, 'question_id' => 15, 'score' => 84.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 14, 'quizze_id' => 16, 'question_id' => 16, 'score' => 78.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 14, 'quizze_id' => 17, 'question_id' => 17, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 15, 'quizze_id' => 11, 'question_id' => 11, 'score' => 84.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 15, 'quizze_id' => 12, 'question_id' => 12, 'score' => 86.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 15, 'quizze_id' => 13, 'question_id' => 13, 'score' => 77.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 15, 'quizze_id' => 15, 'question_id' => 15, 'score' => 84.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 15, 'quizze_id' => 16, 'question_id' => 16, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 15, 'quizze_id' => 17, 'question_id' => 17, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 16, 'quizze_id' => 11, 'question_id' => 11, 'score' => 71.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 16, 'quizze_id' => 12, 'question_id' => 12, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 16, 'quizze_id' => 13, 'question_id' => 13, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 16, 'quizze_id' => 15, 'question_id' => 15, 'score' => 66.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 16, 'quizze_id' => 16, 'question_id' => 16, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 16, 'quizze_id' => 17, 'question_id' => 17, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 17, 'quizze_id' => 11, 'question_id' => 11, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 17, 'quizze_id' => 12, 'question_id' => 12, 'score' => 75.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 17, 'quizze_id' => 13, 'question_id' => 13, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 17, 'quizze_id' => 15, 'question_id' => 15, 'score' => 77.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 17, 'quizze_id' => 16, 'question_id' => 16, 'score' => 70.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 17, 'quizze_id' => 17, 'question_id' => 17, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 18, 'quizze_id' => 11, 'question_id' => 11, 'score' => 82.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 18, 'quizze_id' => 12, 'question_id' => 12, 'score' => 72.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 18, 'quizze_id' => 13, 'question_id' => 13, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 18, 'quizze_id' => 15, 'question_id' => 15, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 18, 'quizze_id' => 16, 'question_id' => 16, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 18, 'quizze_id' => 17, 'question_id' => 17, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 19, 'quizze_id' => 11, 'question_id' => 11, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 19, 'quizze_id' => 12, 'question_id' => 12, 'score' => 86.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 19, 'quizze_id' => 13, 'question_id' => 13, 'score' => 92.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 19, 'quizze_id' => 15, 'question_id' => 15, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 19, 'quizze_id' => 16, 'question_id' => 16, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 19, 'quizze_id' => 17, 'question_id' => 17, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 20, 'quizze_id' => 11, 'question_id' => 11, 'score' => 72.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 20, 'quizze_id' => 12, 'question_id' => 12, 'score' => 64.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 20, 'quizze_id' => 13, 'question_id' => 13, 'score' => 51.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 20, 'quizze_id' => 15, 'question_id' => 15, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 20, 'quizze_id' => 16, 'question_id' => 16, 'score' => 56.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 20, 'quizze_id' => 17, 'question_id' => 17, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 21, 'quizze_id' => 11, 'question_id' => 11, 'score' => 93.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 21, 'quizze_id' => 12, 'question_id' => 12, 'score' => 93.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 21, 'quizze_id' => 13, 'question_id' => 13, 'score' => 93.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 21, 'quizze_id' => 15, 'question_id' => 15, 'score' => 93.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 21, 'quizze_id' => 16, 'question_id' => 16, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 21, 'quizze_id' => 17, 'question_id' => 17, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 22, 'quizze_id' => 11, 'question_id' => 11, 'score' => 59.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 22, 'quizze_id' => 12, 'question_id' => 12, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 12.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 22, 'quizze_id' => 13, 'question_id' => 13, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 12.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 22, 'quizze_id' => 14, 'question_id' => 14, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 22, 'quizze_id' => 15, 'question_id' => 15, 'score' => 81.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 22, 'quizze_id' => 16, 'question_id' => 16, 'score' => 77.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 22, 'quizze_id' => 17, 'question_id' => 17, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 23, 'quizze_id' => 11, 'question_id' => 11, 'score' => 72.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 23, 'quizze_id' => 12, 'question_id' => 12, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 23, 'quizze_id' => 13, 'question_id' => 13, 'score' => 63.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 23, 'quizze_id' => 15, 'question_id' => 15, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 23, 'quizze_id' => 16, 'question_id' => 16, 'score' => 56.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 23, 'quizze_id' => 17, 'question_id' => 17, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 24, 'quizze_id' => 11, 'question_id' => 11, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 24, 'quizze_id' => 12, 'question_id' => 12, 'score' => 64.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 24, 'quizze_id' => 13, 'question_id' => 13, 'score' => 61.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 24, 'quizze_id' => 15, 'question_id' => 15, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 24, 'quizze_id' => 16, 'question_id' => 16, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 24, 'quizze_id' => 17, 'question_id' => 17, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 25, 'quizze_id' => 11, 'question_id' => 11, 'score' => 66.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 25, 'quizze_id' => 12, 'question_id' => 12, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 25, 'quizze_id' => 13, 'question_id' => 13, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 25, 'quizze_id' => 15, 'question_id' => 15, 'score' => 70.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 25, 'quizze_id' => 16, 'question_id' => 16, 'score' => 60.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 25, 'quizze_id' => 17, 'question_id' => 17, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 26, 'quizze_id' => 11, 'question_id' => 11, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 26, 'quizze_id' => 12, 'question_id' => 12, 'score' => 63.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 26, 'quizze_id' => 13, 'question_id' => 13, 'score' => 59.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 26, 'quizze_id' => 15, 'question_id' => 15, 'score' => 61.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 26, 'quizze_id' => 16, 'question_id' => 16, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 26, 'quizze_id' => 17, 'question_id' => 17, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 27, 'quizze_id' => 11, 'question_id' => 11, 'score' => 62.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 27, 'quizze_id' => 12, 'question_id' => 12, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 20.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 27, 'quizze_id' => 13, 'question_id' => 13, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 15.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 27, 'quizze_id' => 15, 'question_id' => 15, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 15.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 27, 'quizze_id' => 16, 'question_id' => 16, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 15.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 27, 'quizze_id' => 17, 'question_id' => 17, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 28, 'quizze_id' => 11, 'question_id' => 11, 'score' => 59.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 24.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 28, 'quizze_id' => 12, 'question_id' => 12, 'score' => 64.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 28, 'quizze_id' => 13, 'question_id' => 13, 'score' => 55.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 24.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 28, 'quizze_id' => 15, 'question_id' => 15, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 28, 'quizze_id' => 16, 'question_id' => 16, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 22.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 28, 'quizze_id' => 17, 'question_id' => 17, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 29, 'quizze_id' => 11, 'question_id' => 11, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 29, 'quizze_id' => 12, 'question_id' => 12, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 29, 'quizze_id' => 13, 'question_id' => 13, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 29, 'quizze_id' => 15, 'question_id' => 15, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 29, 'quizze_id' => 16, 'question_id' => 16, 'score' => 85.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 29, 'quizze_id' => 17, 'question_id' => 17, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 30, 'quizze_id' => 11, 'question_id' => 11, 'score' => 55.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 24.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 30, 'quizze_id' => 12, 'question_id' => 12, 'score' => 51.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 30, 'quizze_id' => 13, 'question_id' => 13, 'score' => 51.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 30, 'quizze_id' => 15, 'question_id' => 15, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 30, 'quizze_id' => 16, 'question_id' => 16, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 30, 'quizze_id' => 17, 'question_id' => 17, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 31, 'quizze_id' => 11, 'question_id' => 11, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 31, 'quizze_id' => 12, 'question_id' => 12, 'score' => 67.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 31, 'quizze_id' => 13, 'question_id' => 13, 'score' => 56.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 31, 'quizze_id' => 15, 'question_id' => 15, 'score' => 60.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 31, 'quizze_id' => 16, 'question_id' => 16, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 31, 'quizze_id' => 17, 'question_id' => 17, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 32, 'quizze_id' => 11, 'question_id' => 11, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 32, 'quizze_id' => 12, 'question_id' => 12, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 32, 'quizze_id' => 13, 'question_id' => 13, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 32, 'quizze_id' => 15, 'question_id' => 15, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 32, 'quizze_id' => 16, 'question_id' => 16, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 32, 'quizze_id' => 17, 'question_id' => 17, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 33, 'quizze_id' => 11, 'question_id' => 11, 'score' => 97.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 33, 'quizze_id' => 12, 'question_id' => 12, 'score' => 98.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 33, 'quizze_id' => 13, 'question_id' => 13, 'score' => 96.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 33, 'quizze_id' => 15, 'question_id' => 15, 'score' => 96.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 33, 'quizze_id' => 16, 'question_id' => 16, 'score' => 96.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 34, 'quizze_id' => 11, 'question_id' => 11, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 22.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 34, 'quizze_id' => 12, 'question_id' => 12, 'score' => 51.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 22.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 34, 'quizze_id' => 13, 'question_id' => 13, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 22.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 34, 'quizze_id' => 14, 'question_id' => 14, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 34, 'quizze_id' => 15, 'question_id' => 15, 'score' => 51.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 34, 'quizze_id' => 16, 'question_id' => 16, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 20.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 34, 'quizze_id' => 17, 'question_id' => 17, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 35, 'quizze_id' => 11, 'question_id' => 11, 'score' => 60.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 35, 'quizze_id' => 12, 'question_id' => 12, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 35, 'quizze_id' => 13, 'question_id' => 13, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 22.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 35, 'quizze_id' => 14, 'question_id' => 14, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 35, 'quizze_id' => 15, 'question_id' => 15, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 35, 'quizze_id' => 16, 'question_id' => 16, 'score' => 71.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 35, 'quizze_id' => 17, 'question_id' => 17, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 36, 'quizze_id' => 11, 'question_id' => 11, 'score' => 82.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 36, 'quizze_id' => 12, 'question_id' => 12, 'score' => 78.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 36, 'quizze_id' => 13, 'question_id' => 13, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 36, 'quizze_id' => 15, 'question_id' => 15, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 36, 'quizze_id' => 16, 'question_id' => 16, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 36, 'quizze_id' => 17, 'question_id' => 17, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 37, 'quizze_id' => 11, 'question_id' => 11, 'score' => 75.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 37, 'quizze_id' => 12, 'question_id' => 12, 'score' => 72.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 37, 'quizze_id' => 13, 'question_id' => 13, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 37, 'quizze_id' => 15, 'question_id' => 15, 'score' => 78.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 37, 'quizze_id' => 16, 'question_id' => 16, 'score' => 77.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 37, 'quizze_id' => 17, 'question_id' => 17, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 38, 'quizze_id' => 11, 'question_id' => 11, 'score' => 85.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 38, 'quizze_id' => 12, 'question_id' => 12, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 38, 'quizze_id' => 13, 'question_id' => 13, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 38, 'quizze_id' => 14, 'question_id' => 14, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 38, 'quizze_id' => 15, 'question_id' => 15, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 38, 'quizze_id' => 16, 'question_id' => 16, 'score' => 93.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 38, 'quizze_id' => 17, 'question_id' => 17, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 39, 'quizze_id' => 11, 'question_id' => 11, 'score' => 54.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 39, 'quizze_id' => 12, 'question_id' => 12, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 20.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 39, 'quizze_id' => 13, 'question_id' => 13, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 23.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 39, 'quizze_id' => 14, 'question_id' => 14, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 39, 'quizze_id' => 15, 'question_id' => 15, 'score' => 60.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 39, 'quizze_id' => 16, 'question_id' => 16, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 39, 'quizze_id' => 17, 'question_id' => 17, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 40, 'quizze_id' => 11, 'question_id' => 11, 'score' => 49.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 20.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 40, 'quizze_id' => 12, 'question_id' => 12, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 18.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 40, 'quizze_id' => 13, 'question_id' => 13, 'score' => 43.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 18.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 40, 'quizze_id' => 15, 'question_id' => 15, 'score' => 37.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 10.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 40, 'quizze_id' => 16, 'question_id' => 16, 'score' => 42.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 16.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 40, 'quizze_id' => 17, 'question_id' => 17, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 41, 'quizze_id' => 11, 'question_id' => 11, 'score' => 45.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 20.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 41, 'quizze_id' => 12, 'question_id' => 12, 'score' => 31.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 21.0 | فصل ثاني: 10.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 41, 'quizze_id' => 13, 'question_id' => 13, 'score' => 29.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 19.0 | فصل ثاني: 10.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 41, 'quizze_id' => 15, 'question_id' => 15, 'score' => 30.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 20.0 | فصل ثاني: 10.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 41, 'quizze_id' => 16, 'question_id' => 16, 'score' => 34.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 22.0 | فصل ثاني: 12.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 41, 'quizze_id' => 17, 'question_id' => 17, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 42, 'quizze_id' => 11, 'question_id' => 11, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 24.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 42, 'quizze_id' => 12, 'question_id' => 12, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 42, 'quizze_id' => 13, 'question_id' => 13, 'score' => 49.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 23.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 42, 'quizze_id' => 15, 'question_id' => 15, 'score' => 46.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 19.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 42, 'quizze_id' => 16, 'question_id' => 16, 'score' => 56.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 42, 'quizze_id' => 17, 'question_id' => 17, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 43, 'quizze_id' => 11, 'question_id' => 11, 'score' => 36.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 16.0 | فصل ثاني: 20.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 43, 'quizze_id' => 12, 'question_id' => 12, 'score' => 25.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 18.0 | فصل ثاني: 7.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 43, 'quizze_id' => 13, 'question_id' => 13, 'score' => 24.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 18.0 | فصل ثاني: 6.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 43, 'quizze_id' => 15, 'question_id' => 15, 'score' => 26.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 18.0 | فصل ثاني: 8.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 43, 'quizze_id' => 16, 'question_id' => 16, 'score' => 26.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 18.0 | فصل ثاني: 8.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 43, 'quizze_id' => 17, 'question_id' => 17, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 44, 'quizze_id' => 11, 'question_id' => 11, 'score' => 45.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 20.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 44, 'quizze_id' => 12, 'question_id' => 12, 'score' => 45.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 20.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 44, 'quizze_id' => 13, 'question_id' => 13, 'score' => 48.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 23.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 44, 'quizze_id' => 15, 'question_id' => 15, 'score' => 54.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 44, 'quizze_id' => 16, 'question_id' => 16, 'score' => 48.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 23.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 45, 'quizze_id' => 11, 'question_id' => 11, 'score' => 40.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 15.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 45, 'quizze_id' => 12, 'question_id' => 12, 'score' => 40.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 15.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 45, 'quizze_id' => 13, 'question_id' => 13, 'score' => 40.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 13.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 45, 'quizze_id' => 15, 'question_id' => 15, 'score' => 46.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 20.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 45, 'quizze_id' => 16, 'question_id' => 16, 'score' => 40.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 15.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 46, 'quizze_id' => 11, 'question_id' => 11, 'score' => 45.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 15.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 46, 'quizze_id' => 12, 'question_id' => 12, 'score' => 42.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 15.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 46, 'quizze_id' => 13, 'question_id' => 13, 'score' => 41.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 12.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 46, 'quizze_id' => 14, 'question_id' => 14, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 46, 'quizze_id' => 15, 'question_id' => 15, 'score' => 55.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 17.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 46, 'quizze_id' => 16, 'question_id' => 16, 'score' => 51.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 24.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 46, 'quizze_id' => 17, 'question_id' => 17, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 47, 'quizze_id' => 11, 'question_id' => 11, 'score' => 35.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 15.0 | فصل ثاني: 20.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 47, 'quizze_id' => 12, 'question_id' => 12, 'score' => 30.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 15.0 | فصل ثاني: 15.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 47, 'quizze_id' => 13, 'question_id' => 13, 'score' => 31.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 13.0 | فصل ثاني: 18.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 47, 'quizze_id' => 15, 'question_id' => 15, 'score' => 28.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 13.0 | فصل ثاني: 15.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 47, 'quizze_id' => 16, 'question_id' => 16, 'score' => 30.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 15.0 | فصل ثاني: 15.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 47, 'quizze_id' => 17, 'question_id' => 17, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 48, 'quizze_id' => 11, 'question_id' => 11, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 48, 'quizze_id' => 12, 'question_id' => 12, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 48, 'quizze_id' => 13, 'question_id' => 13, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 48, 'quizze_id' => 14, 'question_id' => 14, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 48, 'quizze_id' => 15, 'question_id' => 15, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 48, 'quizze_id' => 16, 'question_id' => 16, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 48, 'quizze_id' => 17, 'question_id' => 17, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 50, 'quizze_id' => 21, 'question_id' => 21, 'score' => 97.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 50, 'quizze_id' => 22, 'question_id' => 22, 'score' => 98.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 50, 'quizze_id' => 23, 'question_id' => 23, 'score' => 98.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 50, 'quizze_id' => 25, 'question_id' => 25, 'score' => 98.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 50, 'quizze_id' => 26, 'question_id' => 26, 'score' => 97.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 50, 'quizze_id' => 27, 'question_id' => 27, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 51, 'quizze_id' => 21, 'question_id' => 21, 'score' => 93.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 51, 'quizze_id' => 22, 'question_id' => 22, 'score' => 93.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 51, 'quizze_id' => 23, 'question_id' => 23, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 51, 'quizze_id' => 25, 'question_id' => 25, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 51, 'quizze_id' => 26, 'question_id' => 26, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 51, 'quizze_id' => 27, 'question_id' => 27, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 52, 'quizze_id' => 21, 'question_id' => 21, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 52, 'quizze_id' => 22, 'question_id' => 22, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 52, 'quizze_id' => 23, 'question_id' => 23, 'score' => 84.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 52, 'quizze_id' => 25, 'question_id' => 25, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 52, 'quizze_id' => 26, 'question_id' => 26, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 52, 'quizze_id' => 27, 'question_id' => 27, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 53, 'quizze_id' => 21, 'question_id' => 21, 'score' => 72.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 53, 'quizze_id' => 22, 'question_id' => 22, 'score' => 72.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 53, 'quizze_id' => 23, 'question_id' => 23, 'score' => 72.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 53, 'quizze_id' => 25, 'question_id' => 25, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 53, 'quizze_id' => 26, 'question_id' => 26, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 53, 'quizze_id' => 27, 'question_id' => 27, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 54, 'quizze_id' => 21, 'question_id' => 21, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 54, 'quizze_id' => 22, 'question_id' => 22, 'score' => 96.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 54, 'quizze_id' => 23, 'question_id' => 23, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 54, 'quizze_id' => 25, 'question_id' => 25, 'score' => 98.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 54, 'quizze_id' => 26, 'question_id' => 26, 'score' => 96.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 54, 'quizze_id' => 27, 'question_id' => 27, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 55, 'quizze_id' => 21, 'question_id' => 21, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 55, 'quizze_id' => 22, 'question_id' => 22, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 55, 'quizze_id' => 23, 'question_id' => 23, 'score' => 85.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 55, 'quizze_id' => 25, 'question_id' => 25, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 55, 'quizze_id' => 26, 'question_id' => 26, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 55, 'quizze_id' => 27, 'question_id' => 27, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 56, 'quizze_id' => 21, 'question_id' => 21, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 56, 'quizze_id' => 22, 'question_id' => 22, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 56, 'quizze_id' => 23, 'question_id' => 23, 'score' => 56.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 56, 'quizze_id' => 25, 'question_id' => 25, 'score' => 71.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 56, 'quizze_id' => 26, 'question_id' => 26, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 56, 'quizze_id' => 27, 'question_id' => 27, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 57, 'quizze_id' => 21, 'question_id' => 21, 'score' => 59.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 57, 'quizze_id' => 22, 'question_id' => 22, 'score' => 64.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 57, 'quizze_id' => 23, 'question_id' => 23, 'score' => 64.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 57, 'quizze_id' => 25, 'question_id' => 25, 'score' => 61.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 57, 'quizze_id' => 26, 'question_id' => 26, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 57, 'quizze_id' => 27, 'question_id' => 27, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 58, 'quizze_id' => 21, 'question_id' => 21, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 58, 'quizze_id' => 22, 'question_id' => 22, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 58, 'quizze_id' => 23, 'question_id' => 23, 'score' => 94.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 58, 'quizze_id' => 25, 'question_id' => 25, 'score' => 92.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 58, 'quizze_id' => 26, 'question_id' => 26, 'score' => 93.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 58, 'quizze_id' => 27, 'question_id' => 27, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 59, 'quizze_id' => 21, 'question_id' => 21, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 59, 'quizze_id' => 22, 'question_id' => 22, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 59, 'quizze_id' => 23, 'question_id' => 23, 'score' => 64.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 59, 'quizze_id' => 25, 'question_id' => 25, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 59, 'quizze_id' => 26, 'question_id' => 26, 'score' => 81.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 59, 'quizze_id' => 27, 'question_id' => 27, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 60, 'quizze_id' => 21, 'question_id' => 21, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 60, 'quizze_id' => 22, 'question_id' => 22, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 60, 'quizze_id' => 23, 'question_id' => 23, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 60, 'quizze_id' => 25, 'question_id' => 25, 'score' => 94.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 60, 'quizze_id' => 26, 'question_id' => 26, 'score' => 93.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 60, 'quizze_id' => 27, 'question_id' => 27, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 61, 'quizze_id' => 21, 'question_id' => 21, 'score' => 70.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 61, 'quizze_id' => 22, 'question_id' => 22, 'score' => 70.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 61, 'quizze_id' => 23, 'question_id' => 23, 'score' => 72.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 61, 'quizze_id' => 25, 'question_id' => 25, 'score' => 79.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 61, 'quizze_id' => 26, 'question_id' => 26, 'score' => 77.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 61, 'quizze_id' => 27, 'question_id' => 27, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 62, 'quizze_id' => 21, 'question_id' => 21, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 62, 'quizze_id' => 22, 'question_id' => 22, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 62, 'quizze_id' => 23, 'question_id' => 23, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 62, 'quizze_id' => 25, 'question_id' => 25, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 62, 'quizze_id' => 26, 'question_id' => 26, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 62, 'quizze_id' => 27, 'question_id' => 27, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 63, 'quizze_id' => 21, 'question_id' => 21, 'score' => 62.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 63, 'quizze_id' => 22, 'question_id' => 22, 'score' => 62.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 63, 'quizze_id' => 23, 'question_id' => 23, 'score' => 60.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 63, 'quizze_id' => 25, 'question_id' => 25, 'score' => 98.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 61.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 63, 'quizze_id' => 26, 'question_id' => 26, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 63, 'quizze_id' => 27, 'question_id' => 27, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 64, 'quizze_id' => 21, 'question_id' => 21, 'score' => 77.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 64, 'quizze_id' => 22, 'question_id' => 22, 'score' => 79.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 64, 'quizze_id' => 23, 'question_id' => 23, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 64, 'quizze_id' => 25, 'question_id' => 25, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 64, 'quizze_id' => 26, 'question_id' => 26, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 64, 'quizze_id' => 27, 'question_id' => 27, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 65, 'quizze_id' => 21, 'question_id' => 21, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 65, 'quizze_id' => 22, 'question_id' => 22, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 65, 'quizze_id' => 23, 'question_id' => 23, 'score' => 82.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 65, 'quizze_id' => 25, 'question_id' => 25, 'score' => 77.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 65, 'quizze_id' => 26, 'question_id' => 26, 'score' => 82.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 65, 'quizze_id' => 27, 'question_id' => 27, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 66, 'quizze_id' => 21, 'question_id' => 21, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 66, 'quizze_id' => 22, 'question_id' => 22, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 66, 'quizze_id' => 23, 'question_id' => 23, 'score' => 82.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 66, 'quizze_id' => 25, 'question_id' => 25, 'score' => 86.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 66, 'quizze_id' => 26, 'question_id' => 26, 'score' => 91.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 66, 'quizze_id' => 27, 'question_id' => 27, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 67, 'quizze_id' => 21, 'question_id' => 21, 'score' => 93.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 67, 'quizze_id' => 22, 'question_id' => 22, 'score' => 93.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 67, 'quizze_id' => 23, 'question_id' => 23, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 67, 'quizze_id' => 25, 'question_id' => 25, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 67, 'quizze_id' => 26, 'question_id' => 26, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 67, 'quizze_id' => 27, 'question_id' => 27, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 68, 'quizze_id' => 21, 'question_id' => 21, 'score' => 85.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 68, 'quizze_id' => 22, 'question_id' => 22, 'score' => 86.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 68, 'quizze_id' => 23, 'question_id' => 23, 'score' => 91.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 68, 'quizze_id' => 25, 'question_id' => 25, 'score' => 86.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 68, 'quizze_id' => 26, 'question_id' => 26, 'score' => 85.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 68, 'quizze_id' => 27, 'question_id' => 27, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 69, 'quizze_id' => 21, 'question_id' => 21, 'score' => 96.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 69, 'quizze_id' => 22, 'question_id' => 22, 'score' => 96.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 69, 'quizze_id' => 23, 'question_id' => 23, 'score' => 96.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 69, 'quizze_id' => 25, 'question_id' => 25, 'score' => 94.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 69, 'quizze_id' => 26, 'question_id' => 26, 'score' => 98.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 69, 'quizze_id' => 27, 'question_id' => 27, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 70, 'quizze_id' => 21, 'question_id' => 21, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 70, 'quizze_id' => 22, 'question_id' => 22, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 70, 'quizze_id' => 23, 'question_id' => 23, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 70, 'quizze_id' => 25, 'question_id' => 25, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 70, 'quizze_id' => 26, 'question_id' => 26, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 70, 'quizze_id' => 27, 'question_id' => 27, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 71, 'quizze_id' => 21, 'question_id' => 21, 'score' => 92.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 71, 'quizze_id' => 22, 'question_id' => 22, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 71, 'quizze_id' => 23, 'question_id' => 23, 'score' => 82.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 71, 'quizze_id' => 25, 'question_id' => 25, 'score' => 86.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 71, 'quizze_id' => 26, 'question_id' => 26, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 71, 'quizze_id' => 27, 'question_id' => 27, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 72, 'quizze_id' => 21, 'question_id' => 21, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 72, 'quizze_id' => 22, 'question_id' => 22, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 72, 'quizze_id' => 23, 'question_id' => 23, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 72, 'quizze_id' => 25, 'question_id' => 25, 'score' => 97.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 72, 'quizze_id' => 26, 'question_id' => 26, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 72, 'quizze_id' => 27, 'question_id' => 27, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 73, 'quizze_id' => 21, 'question_id' => 21, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 73, 'quizze_id' => 22, 'question_id' => 22, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 73, 'quizze_id' => 23, 'question_id' => 23, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 73, 'quizze_id' => 25, 'question_id' => 25, 'score' => 97.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 73, 'quizze_id' => 26, 'question_id' => 26, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 73, 'quizze_id' => 27, 'question_id' => 27, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 74, 'quizze_id' => 31, 'question_id' => 31, 'score' => 92.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 74, 'quizze_id' => 32, 'question_id' => 32, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 74, 'quizze_id' => 33, 'question_id' => 33, 'score' => 93.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 74, 'quizze_id' => 35, 'question_id' => 35, 'score' => 96.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 74, 'quizze_id' => 36, 'question_id' => 36, 'score' => 92.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 74, 'quizze_id' => 37, 'question_id' => 37, 'score' => 97.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 75, 'quizze_id' => 31, 'question_id' => 31, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 75, 'quizze_id' => 32, 'question_id' => 32, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 75, 'quizze_id' => 33, 'question_id' => 33, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 75, 'quizze_id' => 35, 'question_id' => 35, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 75, 'quizze_id' => 36, 'question_id' => 36, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 75, 'quizze_id' => 37, 'question_id' => 37, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 76, 'quizze_id' => 31, 'question_id' => 31, 'score' => 44.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 24.0 | فصل ثاني: 20.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 76, 'quizze_id' => 32, 'question_id' => 32, 'score' => 42.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 22.0 | فصل ثاني: 20.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 76, 'quizze_id' => 33, 'question_id' => 33, 'score' => 47.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 22.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 76, 'quizze_id' => 35, 'question_id' => 35, 'score' => 35.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 23.0 | فصل ثاني: 12.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 76, 'quizze_id' => 36, 'question_id' => 36, 'score' => 45.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 20.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 76, 'quizze_id' => 37, 'question_id' => 37, 'score' => 32.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 19.0 | فصل ثاني: 13.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 77, 'quizze_id' => 31, 'question_id' => 31, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 77, 'quizze_id' => 32, 'question_id' => 32, 'score' => 94.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 77, 'quizze_id' => 33, 'question_id' => 33, 'score' => 96.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 77, 'quizze_id' => 35, 'question_id' => 35, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 77, 'quizze_id' => 36, 'question_id' => 36, 'score' => 96.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 77, 'quizze_id' => 37, 'question_id' => 37, 'score' => 98.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 78, 'quizze_id' => 31, 'question_id' => 31, 'score' => 51.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 22.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 78, 'quizze_id' => 32, 'question_id' => 32, 'score' => 49.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 20.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 78, 'quizze_id' => 33, 'question_id' => 33, 'score' => 54.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 22.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 78, 'quizze_id' => 35, 'question_id' => 35, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 78, 'quizze_id' => 36, 'question_id' => 36, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 20.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 78, 'quizze_id' => 37, 'question_id' => 37, 'score' => 51.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 19.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 79, 'quizze_id' => 31, 'question_id' => 31, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 79, 'quizze_id' => 32, 'question_id' => 32, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 79, 'quizze_id' => 33, 'question_id' => 33, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 79, 'quizze_id' => 35, 'question_id' => 35, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 79, 'quizze_id' => 36, 'question_id' => 36, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 79, 'quizze_id' => 37, 'question_id' => 37, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 80, 'quizze_id' => 31, 'question_id' => 31, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 80, 'quizze_id' => 32, 'question_id' => 32, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 80, 'quizze_id' => 33, 'question_id' => 33, 'score' => 91.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 80, 'quizze_id' => 35, 'question_id' => 35, 'score' => 85.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 80, 'quizze_id' => 36, 'question_id' => 36, 'score' => 86.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 80, 'quizze_id' => 37, 'question_id' => 37, 'score' => 73.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 81, 'quizze_id' => 31, 'question_id' => 31, 'score' => 62.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 81, 'quizze_id' => 32, 'question_id' => 32, 'score' => 61.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 81, 'quizze_id' => 33, 'question_id' => 33, 'score' => 62.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 81, 'quizze_id' => 35, 'question_id' => 35, 'score' => 60.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 81, 'quizze_id' => 36, 'question_id' => 36, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 81, 'quizze_id' => 37, 'question_id' => 37, 'score' => 70.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 82, 'quizze_id' => 31, 'question_id' => 31, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 82, 'quizze_id' => 32, 'question_id' => 32, 'score' => 81.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 82, 'quizze_id' => 33, 'question_id' => 33, 'score' => 81.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 82, 'quizze_id' => 35, 'question_id' => 35, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 82, 'quizze_id' => 36, 'question_id' => 36, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 82, 'quizze_id' => 37, 'question_id' => 37, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 83, 'quizze_id' => 31, 'question_id' => 31, 'score' => 97.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 83, 'quizze_id' => 32, 'question_id' => 32, 'score' => 96.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 83, 'quizze_id' => 33, 'question_id' => 33, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 83, 'quizze_id' => 35, 'question_id' => 35, 'score' => 94.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 83, 'quizze_id' => 36, 'question_id' => 36, 'score' => 97.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 83, 'quizze_id' => 37, 'question_id' => 37, 'score' => 99.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 84, 'quizze_id' => 31, 'question_id' => 31, 'score' => 96.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 84, 'quizze_id' => 32, 'question_id' => 32, 'score' => 94.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 84, 'quizze_id' => 33, 'question_id' => 33, 'score' => 97.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 84, 'quizze_id' => 35, 'question_id' => 35, 'score' => 93.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 84, 'quizze_id' => 36, 'question_id' => 36, 'score' => 97.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 84, 'quizze_id' => 37, 'question_id' => 37, 'score' => 99.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 85, 'quizze_id' => 31, 'question_id' => 31, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 85, 'quizze_id' => 32, 'question_id' => 32, 'score' => 91.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 85, 'quizze_id' => 33, 'question_id' => 33, 'score' => 92.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 85, 'quizze_id' => 35, 'question_id' => 35, 'score' => 84.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 85, 'quizze_id' => 36, 'question_id' => 36, 'score' => 91.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 85, 'quizze_id' => 37, 'question_id' => 37, 'score' => 73.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 86, 'quizze_id' => 31, 'question_id' => 31, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 86, 'quizze_id' => 32, 'question_id' => 32, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 86, 'quizze_id' => 33, 'question_id' => 33, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 86, 'quizze_id' => 35, 'question_id' => 35, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 86, 'quizze_id' => 36, 'question_id' => 36, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 86, 'quizze_id' => 37, 'question_id' => 37, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 87, 'quizze_id' => 31, 'question_id' => 31, 'score' => 56.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 87, 'quizze_id' => 32, 'question_id' => 32, 'score' => 55.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 87, 'quizze_id' => 33, 'question_id' => 33, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 87, 'quizze_id' => 35, 'question_id' => 35, 'score' => 71.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 87, 'quizze_id' => 36, 'question_id' => 36, 'score' => 61.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 87, 'quizze_id' => 37, 'question_id' => 37, 'score' => 63.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 88, 'quizze_id' => 31, 'question_id' => 31, 'score' => 70.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 88, 'quizze_id' => 32, 'question_id' => 32, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 15.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 88, 'quizze_id' => 33, 'question_id' => 33, 'score' => 78.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 88, 'quizze_id' => 35, 'question_id' => 35, 'score' => 43.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 10.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 88, 'quizze_id' => 36, 'question_id' => 36, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 10.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 88, 'quizze_id' => 37, 'question_id' => 37, 'score' => 45.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 10.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 89, 'quizze_id' => 31, 'question_id' => 31, 'score' => 70.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 89, 'quizze_id' => 32, 'question_id' => 32, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 89, 'quizze_id' => 33, 'question_id' => 33, 'score' => 78.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 89, 'quizze_id' => 35, 'question_id' => 35, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 89, 'quizze_id' => 36, 'question_id' => 36, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 89, 'quizze_id' => 37, 'question_id' => 37, 'score' => 81.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 90, 'quizze_id' => 31, 'question_id' => 31, 'score' => 47.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 22.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 90, 'quizze_id' => 32, 'question_id' => 32, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 24.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 90, 'quizze_id' => 33, 'question_id' => 33, 'score' => 47.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 22.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 90, 'quizze_id' => 35, 'question_id' => 35, 'score' => 42.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 15.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 90, 'quizze_id' => 36, 'question_id' => 36, 'score' => 54.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 24.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 90, 'quizze_id' => 37, 'question_id' => 37, 'score' => 43.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 15.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 91, 'quizze_id' => 31, 'question_id' => 31, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 91, 'quizze_id' => 32, 'question_id' => 32, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 91, 'quizze_id' => 33, 'question_id' => 33, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 91, 'quizze_id' => 35, 'question_id' => 35, 'score' => 73.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 91, 'quizze_id' => 36, 'question_id' => 36, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 91, 'quizze_id' => 37, 'question_id' => 37, 'score' => 73.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 92, 'quizze_id' => 31, 'question_id' => 31, 'score' => 85.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 92, 'quizze_id' => 32, 'question_id' => 32, 'score' => 85.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 92, 'quizze_id' => 33, 'question_id' => 33, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 92, 'quizze_id' => 35, 'question_id' => 35, 'score' => 70.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 92, 'quizze_id' => 36, 'question_id' => 36, 'score' => 85.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 92, 'quizze_id' => 37, 'question_id' => 37, 'score' => 81.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 93, 'quizze_id' => 31, 'question_id' => 31, 'score' => 84.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 93, 'quizze_id' => 32, 'question_id' => 32, 'score' => 81.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 93, 'quizze_id' => 33, 'question_id' => 33, 'score' => 79.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 93, 'quizze_id' => 35, 'question_id' => 35, 'score' => 78.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 93, 'quizze_id' => 36, 'question_id' => 36, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 93, 'quizze_id' => 37, 'question_id' => 37, 'score' => 81.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 94, 'quizze_id' => 31, 'question_id' => 31, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 94, 'quizze_id' => 32, 'question_id' => 32, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 94, 'quizze_id' => 33, 'question_id' => 33, 'score' => 92.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 94, 'quizze_id' => 35, 'question_id' => 35, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 94, 'quizze_id' => 36, 'question_id' => 36, 'score' => 91.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 94, 'quizze_id' => 37, 'question_id' => 37, 'score' => 94.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 95, 'quizze_id' => 31, 'question_id' => 31, 'score' => 75.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 95, 'quizze_id' => 32, 'question_id' => 32, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 95, 'quizze_id' => 33, 'question_id' => 33, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 95, 'quizze_id' => 35, 'question_id' => 35, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 95, 'quizze_id' => 36, 'question_id' => 36, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 95, 'quizze_id' => 37, 'question_id' => 37, 'score' => 82.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 96, 'quizze_id' => 31, 'question_id' => 31, 'score' => 62.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 96, 'quizze_id' => 32, 'question_id' => 32, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 96, 'quizze_id' => 33, 'question_id' => 33, 'score' => 63.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 96, 'quizze_id' => 35, 'question_id' => 35, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 96, 'quizze_id' => 36, 'question_id' => 36, 'score' => 81.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 96, 'quizze_id' => 37, 'question_id' => 37, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 97, 'quizze_id' => 31, 'question_id' => 31, 'score' => 93.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 97, 'quizze_id' => 32, 'question_id' => 32, 'score' => 94.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 97, 'quizze_id' => 33, 'question_id' => 33, 'score' => 92.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 97, 'quizze_id' => 35, 'question_id' => 35, 'score' => 79.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 97, 'quizze_id' => 36, 'question_id' => 36, 'score' => 96.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 97, 'quizze_id' => 37, 'question_id' => 37, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 98, 'quizze_id' => 31, 'question_id' => 31, 'score' => 92.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 98, 'quizze_id' => 32, 'question_id' => 32, 'score' => 92.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 98, 'quizze_id' => 33, 'question_id' => 33, 'score' => 96.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 98, 'quizze_id' => 35, 'question_id' => 35, 'score' => 99.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 98, 'quizze_id' => 36, 'question_id' => 36, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 98, 'quizze_id' => 37, 'question_id' => 37, 'score' => 99.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 99, 'quizze_id' => 31, 'question_id' => 31, 'score' => 54.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 24.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 99, 'quizze_id' => 32, 'question_id' => 32, 'score' => 59.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 99, 'quizze_id' => 33, 'question_id' => 33, 'score' => 55.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 99, 'quizze_id' => 35, 'question_id' => 35, 'score' => 55.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 99, 'quizze_id' => 36, 'question_id' => 36, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 99, 'quizze_id' => 37, 'question_id' => 37, 'score' => 54.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 24.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 100, 'quizze_id' => 31, 'question_id' => 31, 'score' => 71.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 100, 'quizze_id' => 32, 'question_id' => 32, 'score' => 72.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 100, 'quizze_id' => 33, 'question_id' => 33, 'score' => 72.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 100, 'quizze_id' => 35, 'question_id' => 35, 'score' => 79.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 100, 'quizze_id' => 36, 'question_id' => 36, 'score' => 84.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 100, 'quizze_id' => 37, 'question_id' => 37, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 101, 'quizze_id' => 31, 'question_id' => 31, 'score' => 44.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 24.0 | فصل ثاني: 20.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 101, 'quizze_id' => 32, 'question_id' => 32, 'score' => 48.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 20.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 101, 'quizze_id' => 33, 'question_id' => 33, 'score' => 44.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 22.0 | فصل ثاني: 22.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 101, 'quizze_id' => 35, 'question_id' => 35, 'score' => 49.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 23.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 101, 'quizze_id' => 36, 'question_id' => 36, 'score' => 51.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 22.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 101, 'quizze_id' => 37, 'question_id' => 37, 'score' => 64.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 102, 'quizze_id' => 31, 'question_id' => 31, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 102, 'quizze_id' => 32, 'question_id' => 32, 'score' => 77.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 102, 'quizze_id' => 33, 'question_id' => 33, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 102, 'quizze_id' => 35, 'question_id' => 35, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 102, 'quizze_id' => 36, 'question_id' => 36, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 102, 'quizze_id' => 37, 'question_id' => 37, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 103, 'quizze_id' => 31, 'question_id' => 31, 'score' => 41.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 15.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 103, 'quizze_id' => 32, 'question_id' => 32, 'score' => 29.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 17.0 | فصل ثاني: 12.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 103, 'quizze_id' => 33, 'question_id' => 33, 'score' => 39.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 10.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 103, 'quizze_id' => 35, 'question_id' => 35, 'score' => 39.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 11.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 103, 'quizze_id' => 36, 'question_id' => 36, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 17.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 103, 'quizze_id' => 37, 'question_id' => 37, 'score' => 48.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 23.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 104, 'quizze_id' => 31, 'question_id' => 31, 'score' => 77.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 104, 'quizze_id' => 32, 'question_id' => 32, 'score' => 79.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 104, 'quizze_id' => 33, 'question_id' => 33, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 104, 'quizze_id' => 35, 'question_id' => 35, 'score' => 82.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 104, 'quizze_id' => 36, 'question_id' => 36, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 104, 'quizze_id' => 37, 'question_id' => 37, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 105, 'quizze_id' => 31, 'question_id' => 31, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 105, 'quizze_id' => 32, 'question_id' => 32, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 105, 'quizze_id' => 33, 'question_id' => 33, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 105, 'quizze_id' => 35, 'question_id' => 35, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 105, 'quizze_id' => 36, 'question_id' => 36, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 105, 'quizze_id' => 37, 'question_id' => 37, 'score' => 81.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثالث - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 106, 'quizze_id' => 41, 'question_id' => 41, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 106, 'quizze_id' => 42, 'question_id' => 42, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 106, 'quizze_id' => 43, 'question_id' => 43, 'score' => 97.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 106, 'quizze_id' => 44, 'question_id' => 44, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 106, 'quizze_id' => 45, 'question_id' => 45, 'score' => 72.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 106, 'quizze_id' => 46, 'question_id' => 46, 'score' => 86.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 106, 'quizze_id' => 47, 'question_id' => 47, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 107, 'quizze_id' => 41, 'question_id' => 41, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 107, 'quizze_id' => 42, 'question_id' => 42, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 107, 'quizze_id' => 43, 'question_id' => 43, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 107, 'quizze_id' => 44, 'question_id' => 44, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 107, 'quizze_id' => 45, 'question_id' => 45, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 107, 'quizze_id' => 46, 'question_id' => 46, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 107, 'quizze_id' => 47, 'question_id' => 47, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 108, 'quizze_id' => 41, 'question_id' => 41, 'score' => 55.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 108, 'quizze_id' => 42, 'question_id' => 42, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 108, 'quizze_id' => 43, 'question_id' => 43, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 108, 'quizze_id' => 44, 'question_id' => 44, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 108, 'quizze_id' => 45, 'question_id' => 45, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 22.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 108, 'quizze_id' => 46, 'question_id' => 46, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 19.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 108, 'quizze_id' => 47, 'question_id' => 47, 'score' => 56.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 24.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 109, 'quizze_id' => 41, 'question_id' => 41, 'score' => 82.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 109, 'quizze_id' => 42, 'question_id' => 42, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 109, 'quizze_id' => 43, 'question_id' => 43, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 109, 'quizze_id' => 44, 'question_id' => 44, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 109, 'quizze_id' => 45, 'question_id' => 45, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 109, 'quizze_id' => 46, 'question_id' => 46, 'score' => 70.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 109, 'quizze_id' => 47, 'question_id' => 47, 'score' => 79.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 110, 'quizze_id' => 41, 'question_id' => 41, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 110, 'quizze_id' => 42, 'question_id' => 42, 'score' => 54.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 23.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 110, 'quizze_id' => 43, 'question_id' => 43, 'score' => 78.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 110, 'quizze_id' => 44, 'question_id' => 44, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 110, 'quizze_id' => 45, 'question_id' => 45, 'score' => 55.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 110, 'quizze_id' => 46, 'question_id' => 46, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 110, 'quizze_id' => 47, 'question_id' => 47, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 111, 'quizze_id' => 41, 'question_id' => 41, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 111, 'quizze_id' => 42, 'question_id' => 42, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 111, 'quizze_id' => 43, 'question_id' => 43, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 111, 'quizze_id' => 44, 'question_id' => 44, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 111, 'quizze_id' => 45, 'question_id' => 45, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 22.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 111, 'quizze_id' => 46, 'question_id' => 46, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 111, 'quizze_id' => 47, 'question_id' => 47, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 112, 'quizze_id' => 41, 'question_id' => 41, 'score' => 92.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 112, 'quizze_id' => 42, 'question_id' => 42, 'score' => 91.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 112, 'quizze_id' => 43, 'question_id' => 43, 'score' => 98.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 112, 'quizze_id' => 44, 'question_id' => 44, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 112, 'quizze_id' => 45, 'question_id' => 45, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 112, 'quizze_id' => 46, 'question_id' => 46, 'score' => 85.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 112, 'quizze_id' => 47, 'question_id' => 47, 'score' => 84.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 113, 'quizze_id' => 41, 'question_id' => 41, 'score' => 54.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 23.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 113, 'quizze_id' => 42, 'question_id' => 42, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 20.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 113, 'quizze_id' => 43, 'question_id' => 43, 'score' => 78.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 113, 'quizze_id' => 44, 'question_id' => 44, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 113, 'quizze_id' => 45, 'question_id' => 45, 'score' => 56.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 24.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 113, 'quizze_id' => 46, 'question_id' => 46, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 24.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 113, 'quizze_id' => 47, 'question_id' => 47, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 22.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 114, 'quizze_id' => 41, 'question_id' => 41, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 114, 'quizze_id' => 42, 'question_id' => 42, 'score' => 77.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 114, 'quizze_id' => 43, 'question_id' => 43, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 114, 'quizze_id' => 44, 'question_id' => 44, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 114, 'quizze_id' => 45, 'question_id' => 45, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 114, 'quizze_id' => 46, 'question_id' => 46, 'score' => 70.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 114, 'quizze_id' => 47, 'question_id' => 47, 'score' => 93.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 115, 'quizze_id' => 41, 'question_id' => 41, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 115, 'quizze_id' => 42, 'question_id' => 42, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 115, 'quizze_id' => 43, 'question_id' => 43, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 115, 'quizze_id' => 44, 'question_id' => 44, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 115, 'quizze_id' => 45, 'question_id' => 45, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 22.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 115, 'quizze_id' => 46, 'question_id' => 46, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 115, 'quizze_id' => 47, 'question_id' => 47, 'score' => 67.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 116, 'quizze_id' => 41, 'question_id' => 41, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 116, 'quizze_id' => 42, 'question_id' => 42, 'score' => 63.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 116, 'quizze_id' => 43, 'question_id' => 43, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 116, 'quizze_id' => 44, 'question_id' => 44, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 116, 'quizze_id' => 45, 'question_id' => 45, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 116, 'quizze_id' => 46, 'question_id' => 46, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 23.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 116, 'quizze_id' => 47, 'question_id' => 47, 'score' => 55.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 24.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 117, 'quizze_id' => 41, 'question_id' => 41, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 20.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 117, 'quizze_id' => 42, 'question_id' => 42, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 117, 'quizze_id' => 43, 'question_id' => 43, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 117, 'quizze_id' => 44, 'question_id' => 44, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 117, 'quizze_id' => 45, 'question_id' => 45, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 117, 'quizze_id' => 46, 'question_id' => 46, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 21.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 117, 'quizze_id' => 47, 'question_id' => 47, 'score' => 67.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 118, 'quizze_id' => 41, 'question_id' => 41, 'score' => 75.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 118, 'quizze_id' => 42, 'question_id' => 42, 'score' => 67.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 118, 'quizze_id' => 43, 'question_id' => 43, 'score' => 78.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 118, 'quizze_id' => 44, 'question_id' => 44, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 118, 'quizze_id' => 45, 'question_id' => 45, 'score' => 64.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 118, 'quizze_id' => 46, 'question_id' => 46, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 24.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 118, 'quizze_id' => 47, 'question_id' => 47, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 119, 'quizze_id' => 41, 'question_id' => 41, 'score' => 92.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 119, 'quizze_id' => 42, 'question_id' => 42, 'score' => 93.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 119, 'quizze_id' => 43, 'question_id' => 43, 'score' => 98.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 119, 'quizze_id' => 44, 'question_id' => 44, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 119, 'quizze_id' => 45, 'question_id' => 45, 'score' => 96.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 119, 'quizze_id' => 46, 'question_id' => 46, 'score' => 93.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 119, 'quizze_id' => 47, 'question_id' => 47, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 120, 'quizze_id' => 41, 'question_id' => 41, 'score' => 51.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 23.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 120, 'quizze_id' => 42, 'question_id' => 42, 'score' => 51.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 21.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 120, 'quizze_id' => 43, 'question_id' => 43, 'score' => 70.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 120, 'quizze_id' => 44, 'question_id' => 44, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 120, 'quizze_id' => 45, 'question_id' => 45, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 22.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 120, 'quizze_id' => 46, 'question_id' => 46, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 17.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 120, 'quizze_id' => 47, 'question_id' => 47, 'score' => 63.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 121, 'quizze_id' => 41, 'question_id' => 41, 'score' => 70.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 121, 'quizze_id' => 42, 'question_id' => 42, 'score' => 63.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 121, 'quizze_id' => 43, 'question_id' => 43, 'score' => 82.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 121, 'quizze_id' => 44, 'question_id' => 44, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 121, 'quizze_id' => 45, 'question_id' => 45, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 20.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 121, 'quizze_id' => 46, 'question_id' => 46, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 24.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 121, 'quizze_id' => 47, 'question_id' => 47, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 122, 'quizze_id' => 41, 'question_id' => 41, 'score' => 60.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 21.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 122, 'quizze_id' => 42, 'question_id' => 42, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 122, 'quizze_id' => 43, 'question_id' => 43, 'score' => 67.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 122, 'quizze_id' => 44, 'question_id' => 44, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 122, 'quizze_id' => 45, 'question_id' => 45, 'score' => 66.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 122, 'quizze_id' => 46, 'question_id' => 46, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 22.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 122, 'quizze_id' => 47, 'question_id' => 47, 'score' => 71.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 123, 'quizze_id' => 41, 'question_id' => 41, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 123, 'quizze_id' => 42, 'question_id' => 42, 'score' => 85.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 123, 'quizze_id' => 43, 'question_id' => 43, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 123, 'quizze_id' => 44, 'question_id' => 44, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 123, 'quizze_id' => 45, 'question_id' => 45, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 123, 'quizze_id' => 46, 'question_id' => 46, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 123, 'quizze_id' => 47, 'question_id' => 47, 'score' => 78.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 124, 'quizze_id' => 41, 'question_id' => 41, 'score' => 86.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 124, 'quizze_id' => 42, 'question_id' => 42, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 124, 'quizze_id' => 43, 'question_id' => 43, 'score' => 85.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 124, 'quizze_id' => 44, 'question_id' => 44, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 124, 'quizze_id' => 45, 'question_id' => 45, 'score' => 61.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 124, 'quizze_id' => 46, 'question_id' => 46, 'score' => 64.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 124, 'quizze_id' => 47, 'question_id' => 47, 'score' => 73.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 125, 'quizze_id' => 41, 'question_id' => 41, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 23.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 125, 'quizze_id' => 42, 'question_id' => 42, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 125, 'quizze_id' => 43, 'question_id' => 43, 'score' => 61.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 125, 'quizze_id' => 44, 'question_id' => 44, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 125, 'quizze_id' => 45, 'question_id' => 45, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 19.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 125, 'quizze_id' => 46, 'question_id' => 46, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 125, 'quizze_id' => 47, 'question_id' => 47, 'score' => 55.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 126, 'quizze_id' => 41, 'question_id' => 41, 'score' => 75.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 126, 'quizze_id' => 42, 'question_id' => 42, 'score' => 85.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 126, 'quizze_id' => 43, 'question_id' => 43, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 126, 'quizze_id' => 44, 'question_id' => 44, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 126, 'quizze_id' => 45, 'question_id' => 45, 'score' => 81.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 126, 'quizze_id' => 46, 'question_id' => 46, 'score' => 70.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 126, 'quizze_id' => 47, 'question_id' => 47, 'score' => 78.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 127, 'quizze_id' => 41, 'question_id' => 41, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 23.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 127, 'quizze_id' => 42, 'question_id' => 42, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 127, 'quizze_id' => 43, 'question_id' => 43, 'score' => 62.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 127, 'quizze_id' => 44, 'question_id' => 44, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 127, 'quizze_id' => 45, 'question_id' => 45, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 23.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 127, 'quizze_id' => 46, 'question_id' => 46, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 17.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 127, 'quizze_id' => 47, 'question_id' => 47, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 23.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 128, 'quizze_id' => 41, 'question_id' => 41, 'score' => 81.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 128, 'quizze_id' => 42, 'question_id' => 42, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 128, 'quizze_id' => 43, 'question_id' => 43, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 128, 'quizze_id' => 44, 'question_id' => 44, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 128, 'quizze_id' => 45, 'question_id' => 45, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 128, 'quizze_id' => 46, 'question_id' => 46, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 21.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 128, 'quizze_id' => 47, 'question_id' => 47, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 129, 'quizze_id' => 41, 'question_id' => 41, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 22.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 129, 'quizze_id' => 42, 'question_id' => 42, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 18.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 129, 'quizze_id' => 43, 'question_id' => 43, 'score' => 71.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 129, 'quizze_id' => 44, 'question_id' => 44, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 129, 'quizze_id' => 45, 'question_id' => 45, 'score' => 55.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 22.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 129, 'quizze_id' => 46, 'question_id' => 46, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 22.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 129, 'quizze_id' => 47, 'question_id' => 47, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 23.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 130, 'quizze_id' => 41, 'question_id' => 41, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 130, 'quizze_id' => 42, 'question_id' => 42, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 130, 'quizze_id' => 43, 'question_id' => 43, 'score' => 82.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 130, 'quizze_id' => 44, 'question_id' => 44, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 130, 'quizze_id' => 45, 'question_id' => 45, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 130, 'quizze_id' => 46, 'question_id' => 46, 'score' => 78.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 130, 'quizze_id' => 47, 'question_id' => 47, 'score' => 71.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 131, 'quizze_id' => 41, 'question_id' => 41, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 13.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 131, 'quizze_id' => 42, 'question_id' => 42, 'score' => 61.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 131, 'quizze_id' => 43, 'question_id' => 43, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 131, 'quizze_id' => 44, 'question_id' => 44, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 131, 'quizze_id' => 45, 'question_id' => 45, 'score' => 66.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 131, 'quizze_id' => 46, 'question_id' => 46, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 23.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 131, 'quizze_id' => 47, 'question_id' => 47, 'score' => 61.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 132, 'quizze_id' => 41, 'question_id' => 41, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 132, 'quizze_id' => 42, 'question_id' => 42, 'score' => 91.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 132, 'quizze_id' => 43, 'question_id' => 43, 'score' => 98.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 132, 'quizze_id' => 44, 'question_id' => 44, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 132, 'quizze_id' => 45, 'question_id' => 45, 'score' => 84.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 132, 'quizze_id' => 46, 'question_id' => 46, 'score' => 86.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 132, 'quizze_id' => 47, 'question_id' => 47, 'score' => 82.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 133, 'quizze_id' => 41, 'question_id' => 41, 'score' => 77.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 133, 'quizze_id' => 42, 'question_id' => 42, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 133, 'quizze_id' => 43, 'question_id' => 43, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 133, 'quizze_id' => 44, 'question_id' => 44, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 133, 'quizze_id' => 45, 'question_id' => 45, 'score' => 64.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 133, 'quizze_id' => 46, 'question_id' => 46, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 20.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 133, 'quizze_id' => 47, 'question_id' => 47, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 134, 'quizze_id' => 41, 'question_id' => 41, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 134, 'quizze_id' => 42, 'question_id' => 42, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 134, 'quizze_id' => 43, 'question_id' => 43, 'score' => 73.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 134, 'quizze_id' => 44, 'question_id' => 44, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 134, 'quizze_id' => 45, 'question_id' => 45, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 23.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 134, 'quizze_id' => 46, 'question_id' => 46, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 22.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 134, 'quizze_id' => 47, 'question_id' => 47, 'score' => 67.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 135, 'quizze_id' => 41, 'question_id' => 41, 'score' => 82.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 135, 'quizze_id' => 42, 'question_id' => 42, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 135, 'quizze_id' => 43, 'question_id' => 43, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 135, 'quizze_id' => 44, 'question_id' => 44, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 135, 'quizze_id' => 45, 'question_id' => 45, 'score' => 78.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 135, 'quizze_id' => 46, 'question_id' => 46, 'score' => 73.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 135, 'quizze_id' => 47, 'question_id' => 47, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 136, 'quizze_id' => 41, 'question_id' => 41, 'score' => 86.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 136, 'quizze_id' => 42, 'question_id' => 42, 'score' => 78.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 136, 'quizze_id' => 43, 'question_id' => 43, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 136, 'quizze_id' => 44, 'question_id' => 44, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 136, 'quizze_id' => 45, 'question_id' => 45, 'score' => 82.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 136, 'quizze_id' => 46, 'question_id' => 46, 'score' => 66.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 136, 'quizze_id' => 47, 'question_id' => 47, 'score' => 77.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 137, 'quizze_id' => 41, 'question_id' => 41, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 137, 'quizze_id' => 42, 'question_id' => 42, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 137, 'quizze_id' => 43, 'question_id' => 43, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 137, 'quizze_id' => 44, 'question_id' => 44, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 137, 'quizze_id' => 45, 'question_id' => 45, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 137, 'quizze_id' => 46, 'question_id' => 46, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 137, 'quizze_id' => 47, 'question_id' => 47, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 138, 'quizze_id' => 44, 'question_id' => 44, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الرابع - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 139, 'quizze_id' => 51, 'question_id' => 51, 'score' => 86.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 139, 'quizze_id' => 52, 'question_id' => 52, 'score' => 77.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 139, 'quizze_id' => 53, 'question_id' => 53, 'score' => 77.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 139, 'quizze_id' => 54, 'question_id' => 54, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 139, 'quizze_id' => 55, 'question_id' => 55, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 139, 'quizze_id' => 56, 'question_id' => 56, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 139, 'quizze_id' => 57, 'question_id' => 57, 'score' => 67.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 140, 'quizze_id' => 51, 'question_id' => 51, 'score' => 75.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 140, 'quizze_id' => 52, 'question_id' => 52, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 140, 'quizze_id' => 53, 'question_id' => 53, 'score' => 55.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 140, 'quizze_id' => 54, 'question_id' => 54, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 140, 'quizze_id' => 55, 'question_id' => 55, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 22.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 140, 'quizze_id' => 56, 'question_id' => 56, 'score' => 62.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 140, 'quizze_id' => 57, 'question_id' => 57, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 141, 'quizze_id' => 51, 'question_id' => 51, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 24.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 141, 'quizze_id' => 52, 'question_id' => 52, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 23.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 141, 'quizze_id' => 53, 'question_id' => 53, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 21.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 141, 'quizze_id' => 54, 'question_id' => 54, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 141, 'quizze_id' => 55, 'question_id' => 55, 'score' => 56.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 24.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 141, 'quizze_id' => 56, 'question_id' => 56, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 23.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 141, 'quizze_id' => 57, 'question_id' => 57, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 24.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 142, 'quizze_id' => 51, 'question_id' => 51, 'score' => 82.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 142, 'quizze_id' => 52, 'question_id' => 52, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 142, 'quizze_id' => 53, 'question_id' => 53, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 142, 'quizze_id' => 54, 'question_id' => 54, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 142, 'quizze_id' => 55, 'question_id' => 55, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 142, 'quizze_id' => 56, 'question_id' => 56, 'score' => 85.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 142, 'quizze_id' => 57, 'question_id' => 57, 'score' => 71.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 143, 'quizze_id' => 51, 'question_id' => 51, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 143, 'quizze_id' => 52, 'question_id' => 52, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 143, 'quizze_id' => 53, 'question_id' => 53, 'score' => 92.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 143, 'quizze_id' => 54, 'question_id' => 54, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 143, 'quizze_id' => 55, 'question_id' => 55, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 143, 'quizze_id' => 56, 'question_id' => 56, 'score' => 75.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 143, 'quizze_id' => 57, 'question_id' => 57, 'score' => 66.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 144, 'quizze_id' => 51, 'question_id' => 51, 'score' => 82.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 144, 'quizze_id' => 52, 'question_id' => 52, 'score' => 82.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 144, 'quizze_id' => 53, 'question_id' => 53, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 144, 'quizze_id' => 54, 'question_id' => 54, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 144, 'quizze_id' => 55, 'question_id' => 55, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 144, 'quizze_id' => 56, 'question_id' => 56, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 144, 'quizze_id' => 57, 'question_id' => 57, 'score' => 71.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 145, 'quizze_id' => 51, 'question_id' => 51, 'score' => 91.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 145, 'quizze_id' => 52, 'question_id' => 52, 'score' => 98.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 145, 'quizze_id' => 53, 'question_id' => 53, 'score' => 86.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 145, 'quizze_id' => 54, 'question_id' => 54, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 145, 'quizze_id' => 55, 'question_id' => 55, 'score' => 82.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 145, 'quizze_id' => 56, 'question_id' => 56, 'score' => 92.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 145, 'quizze_id' => 57, 'question_id' => 57, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 146, 'quizze_id' => 51, 'question_id' => 51, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 146, 'quizze_id' => 52, 'question_id' => 52, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 21.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 146, 'quizze_id' => 53, 'question_id' => 53, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 22.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 146, 'quizze_id' => 54, 'question_id' => 54, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 146, 'quizze_id' => 55, 'question_id' => 55, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 24.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 146, 'quizze_id' => 56, 'question_id' => 56, 'score' => 54.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 15.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 146, 'quizze_id' => 57, 'question_id' => 57, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 22.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 147, 'quizze_id' => 51, 'question_id' => 51, 'score' => 94.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 147, 'quizze_id' => 52, 'question_id' => 52, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 147, 'quizze_id' => 53, 'question_id' => 53, 'score' => 98.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 147, 'quizze_id' => 54, 'question_id' => 54, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 147, 'quizze_id' => 55, 'question_id' => 55, 'score' => 85.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 147, 'quizze_id' => 56, 'question_id' => 56, 'score' => 93.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 147, 'quizze_id' => 57, 'question_id' => 57, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 148, 'quizze_id' => 51, 'question_id' => 51, 'score' => 93.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 148, 'quizze_id' => 52, 'question_id' => 52, 'score' => 96.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 148, 'quizze_id' => 53, 'question_id' => 53, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 148, 'quizze_id' => 54, 'question_id' => 54, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 148, 'quizze_id' => 55, 'question_id' => 55, 'score' => 96.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 148, 'quizze_id' => 56, 'question_id' => 56, 'score' => 92.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 148, 'quizze_id' => 57, 'question_id' => 57, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 149, 'quizze_id' => 51, 'question_id' => 51, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 149, 'quizze_id' => 52, 'question_id' => 52, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 149, 'quizze_id' => 53, 'question_id' => 53, 'score' => 72.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 149, 'quizze_id' => 54, 'question_id' => 54, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 149, 'quizze_id' => 55, 'question_id' => 55, 'score' => 78.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 149, 'quizze_id' => 56, 'question_id' => 56, 'score' => 75.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 149, 'quizze_id' => 57, 'question_id' => 57, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 150, 'quizze_id' => 51, 'question_id' => 51, 'score' => 61.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 150, 'quizze_id' => 52, 'question_id' => 52, 'score' => 59.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 150, 'quizze_id' => 53, 'question_id' => 53, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 19.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 150, 'quizze_id' => 54, 'question_id' => 54, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 150, 'quizze_id' => 55, 'question_id' => 55, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 150, 'quizze_id' => 56, 'question_id' => 56, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 24.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 150, 'quizze_id' => 57, 'question_id' => 57, 'score' => 51.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 23.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 151, 'quizze_id' => 51, 'question_id' => 51, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 151, 'quizze_id' => 52, 'question_id' => 52, 'score' => 77.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 151, 'quizze_id' => 53, 'question_id' => 53, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 151, 'quizze_id' => 54, 'question_id' => 54, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 151, 'quizze_id' => 55, 'question_id' => 55, 'score' => 77.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 151, 'quizze_id' => 56, 'question_id' => 56, 'score' => 81.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 151, 'quizze_id' => 57, 'question_id' => 57, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 152, 'quizze_id' => 51, 'question_id' => 51, 'score' => 96.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 152, 'quizze_id' => 52, 'question_id' => 52, 'score' => 94.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 152, 'quizze_id' => 53, 'question_id' => 53, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 152, 'quizze_id' => 54, 'question_id' => 54, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 152, 'quizze_id' => 55, 'question_id' => 55, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 152, 'quizze_id' => 56, 'question_id' => 56, 'score' => 94.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 152, 'quizze_id' => 57, 'question_id' => 57, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 153, 'quizze_id' => 51, 'question_id' => 51, 'score' => 96.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 153, 'quizze_id' => 52, 'question_id' => 52, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 153, 'quizze_id' => 53, 'question_id' => 53, 'score' => 93.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 153, 'quizze_id' => 54, 'question_id' => 54, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 153, 'quizze_id' => 55, 'question_id' => 55, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 153, 'quizze_id' => 56, 'question_id' => 56, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 153, 'quizze_id' => 57, 'question_id' => 57, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 154, 'quizze_id' => 51, 'question_id' => 51, 'score' => 85.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 154, 'quizze_id' => 52, 'question_id' => 52, 'score' => 85.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 154, 'quizze_id' => 53, 'question_id' => 53, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 154, 'quizze_id' => 54, 'question_id' => 54, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 154, 'quizze_id' => 55, 'question_id' => 55, 'score' => 72.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 154, 'quizze_id' => 56, 'question_id' => 56, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 154, 'quizze_id' => 57, 'question_id' => 57, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 155, 'quizze_id' => 51, 'question_id' => 51, 'score' => 55.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 23.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 155, 'quizze_id' => 52, 'question_id' => 52, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 155, 'quizze_id' => 53, 'question_id' => 53, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 16.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 155, 'quizze_id' => 54, 'question_id' => 54, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 155, 'quizze_id' => 55, 'question_id' => 55, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 24.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 155, 'quizze_id' => 56, 'question_id' => 56, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 22.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 155, 'quizze_id' => 57, 'question_id' => 57, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 24.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 156, 'quizze_id' => 51, 'question_id' => 51, 'score' => 78.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 156, 'quizze_id' => 52, 'question_id' => 52, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 156, 'quizze_id' => 53, 'question_id' => 53, 'score' => 55.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 23.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 156, 'quizze_id' => 54, 'question_id' => 54, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 156, 'quizze_id' => 55, 'question_id' => 55, 'score' => 60.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 156, 'quizze_id' => 56, 'question_id' => 56, 'score' => 51.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 156, 'quizze_id' => 57, 'question_id' => 57, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 157, 'quizze_id' => 51, 'question_id' => 51, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 157, 'quizze_id' => 52, 'question_id' => 52, 'score' => 51.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 24.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 157, 'quizze_id' => 53, 'question_id' => 53, 'score' => 54.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 24.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 157, 'quizze_id' => 54, 'question_id' => 54, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 157, 'quizze_id' => 55, 'question_id' => 55, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 14.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 157, 'quizze_id' => 56, 'question_id' => 56, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 22.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 157, 'quizze_id' => 57, 'question_id' => 57, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 158, 'quizze_id' => 51, 'question_id' => 51, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 158, 'quizze_id' => 52, 'question_id' => 52, 'score' => 70.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 158, 'quizze_id' => 53, 'question_id' => 53, 'score' => 62.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 158, 'quizze_id' => 54, 'question_id' => 54, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 158, 'quizze_id' => 55, 'question_id' => 55, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 24.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 158, 'quizze_id' => 56, 'question_id' => 56, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 158, 'quizze_id' => 57, 'question_id' => 57, 'score' => 61.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 159, 'quizze_id' => 51, 'question_id' => 51, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 159, 'quizze_id' => 52, 'question_id' => 52, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 159, 'quizze_id' => 53, 'question_id' => 53, 'score' => 67.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 159, 'quizze_id' => 54, 'question_id' => 54, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 159, 'quizze_id' => 55, 'question_id' => 55, 'score' => 60.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 159, 'quizze_id' => 56, 'question_id' => 56, 'score' => 67.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 159, 'quizze_id' => 57, 'question_id' => 57, 'score' => 72.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 160, 'quizze_id' => 51, 'question_id' => 51, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 160, 'quizze_id' => 52, 'question_id' => 52, 'score' => 94.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 160, 'quizze_id' => 53, 'question_id' => 53, 'score' => 99.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 160, 'quizze_id' => 54, 'question_id' => 54, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 160, 'quizze_id' => 55, 'question_id' => 55, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 160, 'quizze_id' => 56, 'question_id' => 56, 'score' => 97.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 160, 'quizze_id' => 57, 'question_id' => 57, 'score' => 96.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 161, 'quizze_id' => 51, 'question_id' => 51, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 161, 'quizze_id' => 52, 'question_id' => 52, 'score' => 85.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 161, 'quizze_id' => 53, 'question_id' => 53, 'score' => 91.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 161, 'quizze_id' => 54, 'question_id' => 54, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 161, 'quizze_id' => 55, 'question_id' => 55, 'score' => 77.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 161, 'quizze_id' => 56, 'question_id' => 56, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 161, 'quizze_id' => 57, 'question_id' => 57, 'score' => 81.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 162, 'quizze_id' => 51, 'question_id' => 51, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 162, 'quizze_id' => 52, 'question_id' => 52, 'score' => 93.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 162, 'quizze_id' => 53, 'question_id' => 53, 'score' => 99.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 162, 'quizze_id' => 54, 'question_id' => 54, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 162, 'quizze_id' => 55, 'question_id' => 55, 'score' => 77.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 162, 'quizze_id' => 56, 'question_id' => 56, 'score' => 91.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 162, 'quizze_id' => 57, 'question_id' => 57, 'score' => 84.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 163, 'quizze_id' => 51, 'question_id' => 51, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 163, 'quizze_id' => 52, 'question_id' => 52, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 163, 'quizze_id' => 53, 'question_id' => 53, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 163, 'quizze_id' => 54, 'question_id' => 54, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 163, 'quizze_id' => 55, 'question_id' => 55, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 15.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 163, 'quizze_id' => 56, 'question_id' => 56, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 163, 'quizze_id' => 57, 'question_id' => 57, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 164, 'quizze_id' => 51, 'question_id' => 51, 'score' => 60.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 164, 'quizze_id' => 52, 'question_id' => 52, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 23.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 164, 'quizze_id' => 53, 'question_id' => 53, 'score' => 51.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 22.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 164, 'quizze_id' => 54, 'question_id' => 54, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 164, 'quizze_id' => 55, 'question_id' => 55, 'score' => 56.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 24.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 164, 'quizze_id' => 56, 'question_id' => 56, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 19.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 164, 'quizze_id' => 57, 'question_id' => 57, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 23.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 165, 'quizze_id' => 51, 'question_id' => 51, 'score' => 93.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 165, 'quizze_id' => 52, 'question_id' => 52, 'score' => 93.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 165, 'quizze_id' => 53, 'question_id' => 53, 'score' => 98.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 165, 'quizze_id' => 54, 'question_id' => 54, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 165, 'quizze_id' => 55, 'question_id' => 55, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 165, 'quizze_id' => 56, 'question_id' => 56, 'score' => 94.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 165, 'quizze_id' => 57, 'question_id' => 57, 'score' => 84.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 166, 'quizze_id' => 51, 'question_id' => 51, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 166, 'quizze_id' => 52, 'question_id' => 52, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 166, 'quizze_id' => 53, 'question_id' => 53, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 166, 'quizze_id' => 54, 'question_id' => 54, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 166, 'quizze_id' => 55, 'question_id' => 55, 'score' => 59.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 24.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 166, 'quizze_id' => 56, 'question_id' => 56, 'score' => 73.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 166, 'quizze_id' => 57, 'question_id' => 57, 'score' => 70.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 167, 'quizze_id' => 51, 'question_id' => 51, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 167, 'quizze_id' => 52, 'question_id' => 52, 'score' => 91.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 167, 'quizze_id' => 53, 'question_id' => 53, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 167, 'quizze_id' => 54, 'question_id' => 54, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 167, 'quizze_id' => 55, 'question_id' => 55, 'score' => 82.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 167, 'quizze_id' => 56, 'question_id' => 56, 'score' => 77.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 167, 'quizze_id' => 57, 'question_id' => 57, 'score' => 77.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 168, 'quizze_id' => 51, 'question_id' => 51, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 168, 'quizze_id' => 52, 'question_id' => 52, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 168, 'quizze_id' => 53, 'question_id' => 53, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 168, 'quizze_id' => 54, 'question_id' => 54, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 168, 'quizze_id' => 55, 'question_id' => 55, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 168, 'quizze_id' => 56, 'question_id' => 56, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 168, 'quizze_id' => 57, 'question_id' => 57, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 169, 'quizze_id' => 51, 'question_id' => 51, 'score' => 40.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 12.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 169, 'quizze_id' => 52, 'question_id' => 52, 'score' => 45.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 18.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 169, 'quizze_id' => 53, 'question_id' => 53, 'score' => 36.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 9.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 169, 'quizze_id' => 54, 'question_id' => 54, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 169, 'quizze_id' => 55, 'question_id' => 55, 'score' => 33.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 19.0 | فصل ثاني: 14.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 169, 'quizze_id' => 56, 'question_id' => 56, 'score' => 37.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 22.0 | فصل ثاني: 15.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 169, 'quizze_id' => 57, 'question_id' => 57, 'score' => 41.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 20.0 | فصل ثاني: 21.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 170, 'quizze_id' => 51, 'question_id' => 51, 'score' => 42.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 14.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 170, 'quizze_id' => 52, 'question_id' => 52, 'score' => 46.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 15.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 170, 'quizze_id' => 53, 'question_id' => 53, 'score' => 34.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 9.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 170, 'quizze_id' => 54, 'question_id' => 54, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 170, 'quizze_id' => 55, 'question_id' => 55, 'score' => 41.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 24.0 | فصل ثاني: 17.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 170, 'quizze_id' => 56, 'question_id' => 56, 'score' => 31.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 5.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 170, 'quizze_id' => 57, 'question_id' => 57, 'score' => 38.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 9.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 171, 'quizze_id' => 51, 'question_id' => 51, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 18.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 171, 'quizze_id' => 52, 'question_id' => 52, 'score' => 51.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 21.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 171, 'quizze_id' => 53, 'question_id' => 53, 'score' => 22.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 13.0 | فصل ثاني: 9.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 171, 'quizze_id' => 54, 'question_id' => 54, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 171, 'quizze_id' => 55, 'question_id' => 55, 'score' => 29.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 13.0 | فصل ثاني: 16.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 171, 'quizze_id' => 56, 'question_id' => 56, 'score' => 32.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 20.0 | فصل ثاني: 12.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 171, 'quizze_id' => 57, 'question_id' => 57, 'score' => 45.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 21.0 | فصل ثاني: 24.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 172, 'quizze_id' => 51, 'question_id' => 51, 'score' => 59.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 172, 'quizze_id' => 52, 'question_id' => 52, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 172, 'quizze_id' => 53, 'question_id' => 53, 'score' => 26.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 14.0 | فصل ثاني: 12.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 172, 'quizze_id' => 54, 'question_id' => 54, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 172, 'quizze_id' => 55, 'question_id' => 55, 'score' => 51.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 23.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 172, 'quizze_id' => 56, 'question_id' => 56, 'score' => 36.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 17.0 | فصل ثاني: 19.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 172, 'quizze_id' => 57, 'question_id' => 57, 'score' => 45.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 20.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 173, 'quizze_id' => 51, 'question_id' => 51, 'score' => 54.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 173, 'quizze_id' => 52, 'question_id' => 52, 'score' => 60.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 173, 'quizze_id' => 53, 'question_id' => 53, 'score' => 36.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 16.0 | فصل ثاني: 20.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 173, 'quizze_id' => 54, 'question_id' => 54, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 173, 'quizze_id' => 55, 'question_id' => 55, 'score' => 32.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 20.0 | فصل ثاني: 12.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 173, 'quizze_id' => 56, 'question_id' => 56, 'score' => 43.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 23.0 | فصل ثاني: 20.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 173, 'quizze_id' => 57, 'question_id' => 57, 'score' => 43.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 23.0 | فصل ثاني: 20.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 174, 'quizze_id' => 51, 'question_id' => 51, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 23.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 174, 'quizze_id' => 52, 'question_id' => 52, 'score' => 47.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 19.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 174, 'quizze_id' => 53, 'question_id' => 53, 'score' => 35.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 18.0 | فصل ثاني: 17.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 174, 'quizze_id' => 54, 'question_id' => 54, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 174, 'quizze_id' => 55, 'question_id' => 55, 'score' => 42.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 24.0 | فصل ثاني: 18.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 174, 'quizze_id' => 56, 'question_id' => 56, 'score' => 39.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 16.0 | فصل ثاني: 23.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 174, 'quizze_id' => 57, 'question_id' => 57, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 23.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 175, 'quizze_id' => 51, 'question_id' => 51, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 175, 'quizze_id' => 52, 'question_id' => 52, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 175, 'quizze_id' => 53, 'question_id' => 53, 'score' => 31.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 11.0 | فصل ثاني: 20.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 175, 'quizze_id' => 54, 'question_id' => 54, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 175, 'quizze_id' => 55, 'question_id' => 55, 'score' => 40.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 21.0 | فصل ثاني: 19.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 175, 'quizze_id' => 56, 'question_id' => 56, 'score' => 36.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 21.0 | فصل ثاني: 15.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 175, 'quizze_id' => 57, 'question_id' => 57, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الخامس - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 176, 'quizze_id' => 61, 'question_id' => 61, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 176, 'quizze_id' => 62, 'question_id' => 62, 'score' => 62.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 176, 'quizze_id' => 63, 'question_id' => 63, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 176, 'quizze_id' => 64, 'question_id' => 64, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 176, 'quizze_id' => 65, 'question_id' => 65, 'score' => 67.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 176, 'quizze_id' => 66, 'question_id' => 66, 'score' => 51.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 24.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 176, 'quizze_id' => 67, 'question_id' => 67, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 20.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 177, 'quizze_id' => 61, 'question_id' => 61, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 177, 'quizze_id' => 62, 'question_id' => 62, 'score' => 71.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 177, 'quizze_id' => 63, 'question_id' => 63, 'score' => 85.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 177, 'quizze_id' => 64, 'question_id' => 64, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 177, 'quizze_id' => 65, 'question_id' => 65, 'score' => 64.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 177, 'quizze_id' => 66, 'question_id' => 66, 'score' => 84.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 177, 'quizze_id' => 67, 'question_id' => 67, 'score' => 72.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 178, 'quizze_id' => 61, 'question_id' => 61, 'score' => 92.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 178, 'quizze_id' => 62, 'question_id' => 62, 'score' => 97.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 178, 'quizze_id' => 63, 'question_id' => 63, 'score' => 94.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 178, 'quizze_id' => 64, 'question_id' => 64, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 178, 'quizze_id' => 65, 'question_id' => 65, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 178, 'quizze_id' => 66, 'question_id' => 66, 'score' => 91.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 178, 'quizze_id' => 67, 'question_id' => 67, 'score' => 94.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 179, 'quizze_id' => 61, 'question_id' => 61, 'score' => 85.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 179, 'quizze_id' => 62, 'question_id' => 62, 'score' => 81.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 179, 'quizze_id' => 63, 'question_id' => 63, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 179, 'quizze_id' => 64, 'question_id' => 64, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 179, 'quizze_id' => 65, 'question_id' => 65, 'score' => 72.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 179, 'quizze_id' => 66, 'question_id' => 66, 'score' => 64.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 179, 'quizze_id' => 67, 'question_id' => 67, 'score' => 71.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 180, 'quizze_id' => 61, 'question_id' => 61, 'score' => 81.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 180, 'quizze_id' => 62, 'question_id' => 62, 'score' => 79.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 180, 'quizze_id' => 63, 'question_id' => 63, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 180, 'quizze_id' => 64, 'question_id' => 64, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 180, 'quizze_id' => 65, 'question_id' => 65, 'score' => 70.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 180, 'quizze_id' => 66, 'question_id' => 66, 'score' => 64.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 180, 'quizze_id' => 67, 'question_id' => 67, 'score' => 71.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 181, 'quizze_id' => 61, 'question_id' => 61, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 181, 'quizze_id' => 62, 'question_id' => 62, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 181, 'quizze_id' => 63, 'question_id' => 63, 'score' => 81.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 181, 'quizze_id' => 64, 'question_id' => 64, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 181, 'quizze_id' => 65, 'question_id' => 65, 'score' => 70.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 181, 'quizze_id' => 66, 'question_id' => 66, 'score' => 78.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 181, 'quizze_id' => 67, 'question_id' => 67, 'score' => 82.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 182, 'quizze_id' => 61, 'question_id' => 61, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 182, 'quizze_id' => 62, 'question_id' => 62, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 182, 'quizze_id' => 63, 'question_id' => 63, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 182, 'quizze_id' => 64, 'question_id' => 64, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 182, 'quizze_id' => 65, 'question_id' => 65, 'score' => 78.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 182, 'quizze_id' => 66, 'question_id' => 66, 'score' => 72.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 182, 'quizze_id' => 67, 'question_id' => 67, 'score' => 79.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 183, 'quizze_id' => 61, 'question_id' => 61, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 17.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 183, 'quizze_id' => 62, 'question_id' => 62, 'score' => 56.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 183, 'quizze_id' => 63, 'question_id' => 63, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 24.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 183, 'quizze_id' => 64, 'question_id' => 64, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 183, 'quizze_id' => 65, 'question_id' => 65, 'score' => 61.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 183, 'quizze_id' => 66, 'question_id' => 66, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 22.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 183, 'quizze_id' => 67, 'question_id' => 67, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 20.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 184, 'quizze_id' => 61, 'question_id' => 61, 'score' => 70.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 184, 'quizze_id' => 62, 'question_id' => 62, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 184, 'quizze_id' => 63, 'question_id' => 63, 'score' => 60.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 184, 'quizze_id' => 64, 'question_id' => 64, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 184, 'quizze_id' => 65, 'question_id' => 65, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 184, 'quizze_id' => 66, 'question_id' => 66, 'score' => 64.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 184, 'quizze_id' => 67, 'question_id' => 67, 'score' => 86.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 185, 'quizze_id' => 61, 'question_id' => 61, 'score' => 92.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 185, 'quizze_id' => 62, 'question_id' => 62, 'score' => 98.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 185, 'quizze_id' => 63, 'question_id' => 63, 'score' => 92.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 185, 'quizze_id' => 64, 'question_id' => 64, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 185, 'quizze_id' => 65, 'question_id' => 65, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 185, 'quizze_id' => 66, 'question_id' => 66, 'score' => 91.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 185, 'quizze_id' => 67, 'question_id' => 67, 'score' => 92.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 186, 'quizze_id' => 61, 'question_id' => 61, 'score' => 71.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 186, 'quizze_id' => 62, 'question_id' => 62, 'score' => 63.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 186, 'quizze_id' => 63, 'question_id' => 63, 'score' => 67.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 186, 'quizze_id' => 64, 'question_id' => 64, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 186, 'quizze_id' => 65, 'question_id' => 65, 'score' => 61.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 186, 'quizze_id' => 66, 'question_id' => 66, 'score' => 59.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 186, 'quizze_id' => 67, 'question_id' => 67, 'score' => 72.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 187, 'quizze_id' => 61, 'question_id' => 61, 'score' => 86.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 187, 'quizze_id' => 62, 'question_id' => 62, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 187, 'quizze_id' => 63, 'question_id' => 63, 'score' => 82.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 187, 'quizze_id' => 64, 'question_id' => 64, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 187, 'quizze_id' => 65, 'question_id' => 65, 'score' => 70.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 187, 'quizze_id' => 66, 'question_id' => 66, 'score' => 79.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 187, 'quizze_id' => 67, 'question_id' => 67, 'score' => 97.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 188, 'quizze_id' => 61, 'question_id' => 61, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 188, 'quizze_id' => 62, 'question_id' => 62, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 188, 'quizze_id' => 63, 'question_id' => 63, 'score' => 79.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 188, 'quizze_id' => 64, 'question_id' => 64, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 188, 'quizze_id' => 65, 'question_id' => 65, 'score' => 66.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 188, 'quizze_id' => 66, 'question_id' => 66, 'score' => 55.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 23.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 188, 'quizze_id' => 67, 'question_id' => 67, 'score' => 71.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 189, 'quizze_id' => 61, 'question_id' => 61, 'score' => 84.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 189, 'quizze_id' => 62, 'question_id' => 62, 'score' => 66.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 189, 'quizze_id' => 63, 'question_id' => 63, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 189, 'quizze_id' => 64, 'question_id' => 64, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 189, 'quizze_id' => 65, 'question_id' => 65, 'score' => 63.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 189, 'quizze_id' => 66, 'question_id' => 66, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 24.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 189, 'quizze_id' => 67, 'question_id' => 67, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 190, 'quizze_id' => 61, 'question_id' => 61, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 190, 'quizze_id' => 62, 'question_id' => 62, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 190, 'quizze_id' => 63, 'question_id' => 63, 'score' => 60.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 190, 'quizze_id' => 64, 'question_id' => 64, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 190, 'quizze_id' => 65, 'question_id' => 65, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 190, 'quizze_id' => 66, 'question_id' => 66, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 22.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 190, 'quizze_id' => 67, 'question_id' => 67, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 22.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 191, 'quizze_id' => 61, 'question_id' => 61, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 191, 'quizze_id' => 62, 'question_id' => 62, 'score' => 99.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 191, 'quizze_id' => 63, 'question_id' => 63, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 191, 'quizze_id' => 64, 'question_id' => 64, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 191, 'quizze_id' => 65, 'question_id' => 65, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 191, 'quizze_id' => 66, 'question_id' => 66, 'score' => 98.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 191, 'quizze_id' => 67, 'question_id' => 67, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 192, 'quizze_id' => 61, 'question_id' => 61, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 192, 'quizze_id' => 62, 'question_id' => 62, 'score' => 81.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 192, 'quizze_id' => 63, 'question_id' => 63, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 192, 'quizze_id' => 64, 'question_id' => 64, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 192, 'quizze_id' => 65, 'question_id' => 65, 'score' => 62.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 192, 'quizze_id' => 66, 'question_id' => 66, 'score' => 70.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 192, 'quizze_id' => 67, 'question_id' => 67, 'score' => 84.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 193, 'quizze_id' => 61, 'question_id' => 61, 'score' => 86.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 193, 'quizze_id' => 62, 'question_id' => 62, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 193, 'quizze_id' => 63, 'question_id' => 63, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 193, 'quizze_id' => 64, 'question_id' => 64, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 193, 'quizze_id' => 65, 'question_id' => 65, 'score' => 82.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 193, 'quizze_id' => 66, 'question_id' => 66, 'score' => 78.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 193, 'quizze_id' => 67, 'question_id' => 67, 'score' => 91.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 194, 'quizze_id' => 61, 'question_id' => 61, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 194, 'quizze_id' => 62, 'question_id' => 62, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 194, 'quizze_id' => 63, 'question_id' => 63, 'score' => 79.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 194, 'quizze_id' => 64, 'question_id' => 64, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 194, 'quizze_id' => 65, 'question_id' => 65, 'score' => 64.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 194, 'quizze_id' => 66, 'question_id' => 66, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 194, 'quizze_id' => 67, 'question_id' => 67, 'score' => 84.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 195, 'quizze_id' => 61, 'question_id' => 61, 'score' => 73.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 195, 'quizze_id' => 62, 'question_id' => 62, 'score' => 54.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 195, 'quizze_id' => 63, 'question_id' => 63, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 195, 'quizze_id' => 64, 'question_id' => 64, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 195, 'quizze_id' => 65, 'question_id' => 65, 'score' => 60.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 195, 'quizze_id' => 66, 'question_id' => 66, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 22.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 195, 'quizze_id' => 67, 'question_id' => 67, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 21.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 196, 'quizze_id' => 61, 'question_id' => 61, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 24.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 196, 'quizze_id' => 62, 'question_id' => 62, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 24.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 196, 'quizze_id' => 63, 'question_id' => 63, 'score' => 55.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 196, 'quizze_id' => 64, 'question_id' => 64, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 196, 'quizze_id' => 65, 'question_id' => 65, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 196, 'quizze_id' => 66, 'question_id' => 66, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 24.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 196, 'quizze_id' => 67, 'question_id' => 67, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 197, 'quizze_id' => 61, 'question_id' => 61, 'score' => 91.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 197, 'quizze_id' => 62, 'question_id' => 62, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 197, 'quizze_id' => 63, 'question_id' => 63, 'score' => 85.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 197, 'quizze_id' => 64, 'question_id' => 64, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 197, 'quizze_id' => 65, 'question_id' => 65, 'score' => 67.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 197, 'quizze_id' => 66, 'question_id' => 66, 'score' => 79.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 197, 'quizze_id' => 67, 'question_id' => 67, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 198, 'quizze_id' => 61, 'question_id' => 61, 'score' => 91.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 198, 'quizze_id' => 62, 'question_id' => 62, 'score' => 99.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 198, 'quizze_id' => 63, 'question_id' => 63, 'score' => 91.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 198, 'quizze_id' => 64, 'question_id' => 64, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 198, 'quizze_id' => 65, 'question_id' => 65, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 198, 'quizze_id' => 66, 'question_id' => 66, 'score' => 91.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 198, 'quizze_id' => 67, 'question_id' => 67, 'score' => 99.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 199, 'quizze_id' => 61, 'question_id' => 61, 'score' => 82.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 199, 'quizze_id' => 62, 'question_id' => 62, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 199, 'quizze_id' => 63, 'question_id' => 63, 'score' => 78.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 199, 'quizze_id' => 64, 'question_id' => 64, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 199, 'quizze_id' => 65, 'question_id' => 65, 'score' => 64.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 199, 'quizze_id' => 66, 'question_id' => 66, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 199, 'quizze_id' => 67, 'question_id' => 67, 'score' => 77.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 200, 'quizze_id' => 61, 'question_id' => 61, 'score' => 78.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 200, 'quizze_id' => 62, 'question_id' => 62, 'score' => 86.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 200, 'quizze_id' => 63, 'question_id' => 63, 'score' => 75.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 200, 'quizze_id' => 64, 'question_id' => 64, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 200, 'quizze_id' => 65, 'question_id' => 65, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 200, 'quizze_id' => 66, 'question_id' => 66, 'score' => 73.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 200, 'quizze_id' => 67, 'question_id' => 67, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 201, 'quizze_id' => 61, 'question_id' => 61, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 201, 'quizze_id' => 62, 'question_id' => 62, 'score' => 98.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 201, 'quizze_id' => 63, 'question_id' => 63, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 201, 'quizze_id' => 64, 'question_id' => 64, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 201, 'quizze_id' => 65, 'question_id' => 65, 'score' => 96.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 201, 'quizze_id' => 66, 'question_id' => 66, 'score' => 97.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 201, 'quizze_id' => 67, 'question_id' => 67, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 202, 'quizze_id' => 61, 'question_id' => 61, 'score' => 92.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 202, 'quizze_id' => 62, 'question_id' => 62, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 202, 'quizze_id' => 63, 'question_id' => 63, 'score' => 97.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 202, 'quizze_id' => 64, 'question_id' => 64, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 202, 'quizze_id' => 65, 'question_id' => 65, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 202, 'quizze_id' => 66, 'question_id' => 66, 'score' => 93.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 202, 'quizze_id' => 67, 'question_id' => 67, 'score' => 99.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 203, 'quizze_id' => 61, 'question_id' => 61, 'score' => 78.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 203, 'quizze_id' => 62, 'question_id' => 62, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 203, 'quizze_id' => 63, 'question_id' => 63, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 203, 'quizze_id' => 64, 'question_id' => 64, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 203, 'quizze_id' => 65, 'question_id' => 65, 'score' => 72.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 203, 'quizze_id' => 66, 'question_id' => 66, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 203, 'quizze_id' => 67, 'question_id' => 67, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 204, 'quizze_id' => 61, 'question_id' => 61, 'score' => 82.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 204, 'quizze_id' => 62, 'question_id' => 62, 'score' => 79.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 204, 'quizze_id' => 63, 'question_id' => 63, 'score' => 75.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 204, 'quizze_id' => 64, 'question_id' => 64, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 204, 'quizze_id' => 65, 'question_id' => 65, 'score' => 62.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 204, 'quizze_id' => 66, 'question_id' => 66, 'score' => 59.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 23.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 204, 'quizze_id' => 67, 'question_id' => 67, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 205, 'quizze_id' => 61, 'question_id' => 61, 'score' => 71.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 205, 'quizze_id' => 62, 'question_id' => 62, 'score' => 59.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 205, 'quizze_id' => 63, 'question_id' => 63, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 205, 'quizze_id' => 64, 'question_id' => 64, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 205, 'quizze_id' => 65, 'question_id' => 65, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 205, 'quizze_id' => 66, 'question_id' => 66, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 24.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 205, 'quizze_id' => 67, 'question_id' => 67, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السادس - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 206, 'quizze_id' => 71, 'question_id' => 71, 'score' => 96.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 206, 'quizze_id' => 72, 'question_id' => 72, 'score' => 96.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 206, 'quizze_id' => 73, 'question_id' => 73, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 206, 'quizze_id' => 74, 'question_id' => 74, 'score' => 96.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 206, 'quizze_id' => 75, 'question_id' => 75, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 206, 'quizze_id' => 76, 'question_id' => 76, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 206, 'quizze_id' => 77, 'question_id' => 77, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 207, 'quizze_id' => 71, 'question_id' => 71, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 207, 'quizze_id' => 72, 'question_id' => 72, 'score' => 85.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 207, 'quizze_id' => 73, 'question_id' => 73, 'score' => 84.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 207, 'quizze_id' => 74, 'question_id' => 74, 'score' => 86.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 207, 'quizze_id' => 75, 'question_id' => 75, 'score' => 67.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 207, 'quizze_id' => 76, 'question_id' => 76, 'score' => 75.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 207, 'quizze_id' => 77, 'question_id' => 77, 'score' => 73.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 208, 'quizze_id' => 71, 'question_id' => 71, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 208, 'quizze_id' => 72, 'question_id' => 72, 'score' => 79.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 208, 'quizze_id' => 73, 'question_id' => 73, 'score' => 73.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 208, 'quizze_id' => 74, 'question_id' => 74, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 208, 'quizze_id' => 75, 'question_id' => 75, 'score' => 66.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 208, 'quizze_id' => 76, 'question_id' => 76, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 208, 'quizze_id' => 77, 'question_id' => 77, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 209, 'quizze_id' => 71, 'question_id' => 71, 'score' => 92.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 209, 'quizze_id' => 72, 'question_id' => 72, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 209, 'quizze_id' => 73, 'question_id' => 73, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 209, 'quizze_id' => 74, 'question_id' => 74, 'score' => 92.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 209, 'quizze_id' => 75, 'question_id' => 75, 'score' => 73.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 209, 'quizze_id' => 76, 'question_id' => 76, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 209, 'quizze_id' => 77, 'question_id' => 77, 'score' => 85.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 210, 'quizze_id' => 71, 'question_id' => 71, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 210, 'quizze_id' => 72, 'question_id' => 72, 'score' => 62.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 210, 'quizze_id' => 73, 'question_id' => 73, 'score' => 51.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 24.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 210, 'quizze_id' => 74, 'question_id' => 74, 'score' => 67.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 210, 'quizze_id' => 75, 'question_id' => 75, 'score' => 62.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 210, 'quizze_id' => 76, 'question_id' => 76, 'score' => 56.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 210, 'quizze_id' => 77, 'question_id' => 77, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 24.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 211, 'quizze_id' => 71, 'question_id' => 71, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 21.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 211, 'quizze_id' => 72, 'question_id' => 72, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 211, 'quizze_id' => 73, 'question_id' => 73, 'score' => 64.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 211, 'quizze_id' => 74, 'question_id' => 74, 'score' => 70.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 211, 'quizze_id' => 75, 'question_id' => 75, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 211, 'quizze_id' => 76, 'question_id' => 76, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 211, 'quizze_id' => 77, 'question_id' => 77, 'score' => 54.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 21.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 212, 'quizze_id' => 71, 'question_id' => 71, 'score' => 61.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 212, 'quizze_id' => 72, 'question_id' => 72, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 212, 'quizze_id' => 73, 'question_id' => 73, 'score' => 63.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 212, 'quizze_id' => 74, 'question_id' => 74, 'score' => 77.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 212, 'quizze_id' => 75, 'question_id' => 75, 'score' => 62.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 212, 'quizze_id' => 76, 'question_id' => 76, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 212, 'quizze_id' => 77, 'question_id' => 77, 'score' => 64.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 213, 'quizze_id' => 71, 'question_id' => 71, 'score' => 79.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 213, 'quizze_id' => 72, 'question_id' => 72, 'score' => 84.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 213, 'quizze_id' => 73, 'question_id' => 73, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 213, 'quizze_id' => 74, 'question_id' => 74, 'score' => 78.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 213, 'quizze_id' => 75, 'question_id' => 75, 'score' => 61.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 213, 'quizze_id' => 76, 'question_id' => 76, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 213, 'quizze_id' => 77, 'question_id' => 77, 'score' => 66.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 214, 'quizze_id' => 71, 'question_id' => 71, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 214, 'quizze_id' => 72, 'question_id' => 72, 'score' => 71.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 214, 'quizze_id' => 73, 'question_id' => 73, 'score' => 75.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 214, 'quizze_id' => 74, 'question_id' => 74, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 214, 'quizze_id' => 75, 'question_id' => 75, 'score' => 60.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 214, 'quizze_id' => 76, 'question_id' => 76, 'score' => 62.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 214, 'quizze_id' => 77, 'question_id' => 77, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 215, 'quizze_id' => 71, 'question_id' => 71, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 215, 'quizze_id' => 72, 'question_id' => 72, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 215, 'quizze_id' => 73, 'question_id' => 73, 'score' => 86.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 215, 'quizze_id' => 74, 'question_id' => 74, 'score' => 82.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 215, 'quizze_id' => 75, 'question_id' => 75, 'score' => 66.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 215, 'quizze_id' => 76, 'question_id' => 76, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 215, 'quizze_id' => 77, 'question_id' => 77, 'score' => 78.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 216, 'quizze_id' => 71, 'question_id' => 71, 'score' => 61.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 216, 'quizze_id' => 72, 'question_id' => 72, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 216, 'quizze_id' => 73, 'question_id' => 73, 'score' => 60.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 216, 'quizze_id' => 74, 'question_id' => 74, 'score' => 63.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 216, 'quizze_id' => 75, 'question_id' => 75, 'score' => 62.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 216, 'quizze_id' => 76, 'question_id' => 76, 'score' => 67.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 216, 'quizze_id' => 77, 'question_id' => 77, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 24.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 217, 'quizze_id' => 71, 'question_id' => 71, 'score' => 81.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 217, 'quizze_id' => 72, 'question_id' => 72, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 217, 'quizze_id' => 73, 'question_id' => 73, 'score' => 81.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 217, 'quizze_id' => 74, 'question_id' => 74, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 217, 'quizze_id' => 75, 'question_id' => 75, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 217, 'quizze_id' => 76, 'question_id' => 76, 'score' => 84.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 217, 'quizze_id' => 77, 'question_id' => 77, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 218, 'quizze_id' => 71, 'question_id' => 71, 'score' => 67.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 218, 'quizze_id' => 72, 'question_id' => 72, 'score' => 75.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 218, 'quizze_id' => 73, 'question_id' => 73, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 218, 'quizze_id' => 74, 'question_id' => 74, 'score' => 67.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 218, 'quizze_id' => 75, 'question_id' => 75, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 218, 'quizze_id' => 76, 'question_id' => 76, 'score' => 61.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 218, 'quizze_id' => 77, 'question_id' => 77, 'score' => 61.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 219, 'quizze_id' => 71, 'question_id' => 71, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 219, 'quizze_id' => 72, 'question_id' => 72, 'score' => 92.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 219, 'quizze_id' => 73, 'question_id' => 73, 'score' => 81.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 219, 'quizze_id' => 74, 'question_id' => 74, 'score' => 79.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 219, 'quizze_id' => 75, 'question_id' => 75, 'score' => 81.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 219, 'quizze_id' => 76, 'question_id' => 76, 'score' => 82.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 219, 'quizze_id' => 77, 'question_id' => 77, 'score' => 77.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 220, 'quizze_id' => 71, 'question_id' => 71, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 220, 'quizze_id' => 72, 'question_id' => 72, 'score' => 70.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 220, 'quizze_id' => 73, 'question_id' => 73, 'score' => 60.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 220, 'quizze_id' => 74, 'question_id' => 74, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 220, 'quizze_id' => 75, 'question_id' => 75, 'score' => 64.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 220, 'quizze_id' => 76, 'question_id' => 76, 'score' => 63.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 220, 'quizze_id' => 77, 'question_id' => 77, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 221, 'quizze_id' => 71, 'question_id' => 71, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 221, 'quizze_id' => 72, 'question_id' => 72, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 221, 'quizze_id' => 73, 'question_id' => 73, 'score' => 77.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 221, 'quizze_id' => 74, 'question_id' => 74, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 221, 'quizze_id' => 75, 'question_id' => 75, 'score' => 70.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 221, 'quizze_id' => 76, 'question_id' => 76, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 221, 'quizze_id' => 77, 'question_id' => 77, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 222, 'quizze_id' => 71, 'question_id' => 71, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 21.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 222, 'quizze_id' => 72, 'question_id' => 72, 'score' => 73.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 222, 'quizze_id' => 73, 'question_id' => 73, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 222, 'quizze_id' => 74, 'question_id' => 74, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 222, 'quizze_id' => 75, 'question_id' => 75, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 222, 'quizze_id' => 76, 'question_id' => 76, 'score' => 56.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 222, 'quizze_id' => 77, 'question_id' => 77, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 223, 'quizze_id' => 71, 'question_id' => 71, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 223, 'quizze_id' => 72, 'question_id' => 72, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 223, 'quizze_id' => 73, 'question_id' => 73, 'score' => 78.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 223, 'quizze_id' => 74, 'question_id' => 74, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 223, 'quizze_id' => 75, 'question_id' => 75, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 223, 'quizze_id' => 76, 'question_id' => 76, 'score' => 77.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 223, 'quizze_id' => 77, 'question_id' => 77, 'score' => 72.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 224, 'quizze_id' => 71, 'question_id' => 71, 'score' => 63.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 224, 'quizze_id' => 72, 'question_id' => 72, 'score' => 71.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 224, 'quizze_id' => 73, 'question_id' => 73, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 224, 'quizze_id' => 74, 'question_id' => 74, 'score' => 78.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 224, 'quizze_id' => 75, 'question_id' => 75, 'score' => 61.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 224, 'quizze_id' => 76, 'question_id' => 76, 'score' => 67.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 224, 'quizze_id' => 77, 'question_id' => 77, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 23.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 225, 'quizze_id' => 71, 'question_id' => 71, 'score' => 71.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 225, 'quizze_id' => 72, 'question_id' => 72, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 225, 'quizze_id' => 73, 'question_id' => 73, 'score' => 82.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 225, 'quizze_id' => 74, 'question_id' => 74, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 225, 'quizze_id' => 75, 'question_id' => 75, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 225, 'quizze_id' => 76, 'question_id' => 76, 'score' => 72.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 225, 'quizze_id' => 77, 'question_id' => 77, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 22.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 226, 'quizze_id' => 71, 'question_id' => 71, 'score' => 93.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 226, 'quizze_id' => 72, 'question_id' => 72, 'score' => 94.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 226, 'quizze_id' => 73, 'question_id' => 73, 'score' => 94.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 226, 'quizze_id' => 74, 'question_id' => 74, 'score' => 91.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 226, 'quizze_id' => 75, 'question_id' => 75, 'score' => 77.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 226, 'quizze_id' => 76, 'question_id' => 76, 'score' => 91.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 226, 'quizze_id' => 77, 'question_id' => 77, 'score' => 75.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 227, 'quizze_id' => 71, 'question_id' => 71, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 227, 'quizze_id' => 72, 'question_id' => 72, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 227, 'quizze_id' => 73, 'question_id' => 73, 'score' => 70.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 227, 'quizze_id' => 74, 'question_id' => 74, 'score' => 73.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 227, 'quizze_id' => 75, 'question_id' => 75, 'score' => 70.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 227, 'quizze_id' => 76, 'question_id' => 76, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 227, 'quizze_id' => 77, 'question_id' => 77, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 228, 'quizze_id' => 71, 'question_id' => 71, 'score' => 72.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 228, 'quizze_id' => 72, 'question_id' => 72, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 228, 'quizze_id' => 73, 'question_id' => 73, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 228, 'quizze_id' => 74, 'question_id' => 74, 'score' => 81.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 228, 'quizze_id' => 75, 'question_id' => 75, 'score' => 67.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 228, 'quizze_id' => 76, 'question_id' => 76, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 228, 'quizze_id' => 77, 'question_id' => 77, 'score' => 62.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 229, 'quizze_id' => 71, 'question_id' => 71, 'score' => 85.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 229, 'quizze_id' => 72, 'question_id' => 72, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 229, 'quizze_id' => 73, 'question_id' => 73, 'score' => 77.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 229, 'quizze_id' => 74, 'question_id' => 74, 'score' => 86.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 229, 'quizze_id' => 75, 'question_id' => 75, 'score' => 66.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 229, 'quizze_id' => 76, 'question_id' => 76, 'score' => 70.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 229, 'quizze_id' => 77, 'question_id' => 77, 'score' => 73.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 230, 'quizze_id' => 71, 'question_id' => 71, 'score' => 81.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 230, 'quizze_id' => 72, 'question_id' => 72, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 230, 'quizze_id' => 73, 'question_id' => 73, 'score' => 63.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 230, 'quizze_id' => 74, 'question_id' => 74, 'score' => 73.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 230, 'quizze_id' => 75, 'question_id' => 75, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 230, 'quizze_id' => 76, 'question_id' => 76, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 230, 'quizze_id' => 77, 'question_id' => 77, 'score' => 67.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 231, 'quizze_id' => 71, 'question_id' => 71, 'score' => 67.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 231, 'quizze_id' => 72, 'question_id' => 72, 'score' => 71.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 231, 'quizze_id' => 73, 'question_id' => 73, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 24.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 231, 'quizze_id' => 74, 'question_id' => 74, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 231, 'quizze_id' => 75, 'question_id' => 75, 'score' => 63.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 231, 'quizze_id' => 76, 'question_id' => 76, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 231, 'quizze_id' => 77, 'question_id' => 77, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 232, 'quizze_id' => 71, 'question_id' => 71, 'score' => 51.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 22.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 232, 'quizze_id' => 72, 'question_id' => 72, 'score' => 62.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 232, 'quizze_id' => 73, 'question_id' => 73, 'score' => 71.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 232, 'quizze_id' => 74, 'question_id' => 74, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 232, 'quizze_id' => 75, 'question_id' => 75, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 232, 'quizze_id' => 76, 'question_id' => 76, 'score' => 59.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 232, 'quizze_id' => 77, 'question_id' => 77, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 233, 'quizze_id' => 71, 'question_id' => 71, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 233, 'quizze_id' => 72, 'question_id' => 72, 'score' => 73.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 233, 'quizze_id' => 73, 'question_id' => 73, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 233, 'quizze_id' => 74, 'question_id' => 74, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 233, 'quizze_id' => 75, 'question_id' => 75, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 233, 'quizze_id' => 76, 'question_id' => 76, 'score' => 62.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 233, 'quizze_id' => 77, 'question_id' => 77, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 234, 'quizze_id' => 71, 'question_id' => 71, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 234, 'quizze_id' => 72, 'question_id' => 72, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 234, 'quizze_id' => 73, 'question_id' => 73, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 234, 'quizze_id' => 74, 'question_id' => 74, 'score' => 75.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 234, 'quizze_id' => 75, 'question_id' => 75, 'score' => 71.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 234, 'quizze_id' => 76, 'question_id' => 76, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 234, 'quizze_id' => 77, 'question_id' => 77, 'score' => 56.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 235, 'quizze_id' => 71, 'question_id' => 71, 'score' => 91.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 235, 'quizze_id' => 72, 'question_id' => 72, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 235, 'quizze_id' => 73, 'question_id' => 73, 'score' => 85.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 235, 'quizze_id' => 74, 'question_id' => 74, 'score' => 86.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 235, 'quizze_id' => 75, 'question_id' => 75, 'score' => 77.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 235, 'quizze_id' => 76, 'question_id' => 76, 'score' => 78.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 235, 'quizze_id' => 77, 'question_id' => 77, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 236, 'quizze_id' => 71, 'question_id' => 71, 'score' => 54.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 19.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 236, 'quizze_id' => 72, 'question_id' => 72, 'score' => 63.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 236, 'quizze_id' => 73, 'question_id' => 73, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 22.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 236, 'quizze_id' => 74, 'question_id' => 74, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 236, 'quizze_id' => 75, 'question_id' => 75, 'score' => 66.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 236, 'quizze_id' => 76, 'question_id' => 76, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 236, 'quizze_id' => 77, 'question_id' => 77, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 24.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 237, 'quizze_id' => 71, 'question_id' => 71, 'score' => 71.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 237, 'quizze_id' => 72, 'question_id' => 72, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 237, 'quizze_id' => 73, 'question_id' => 73, 'score' => 73.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 237, 'quizze_id' => 74, 'question_id' => 74, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 237, 'quizze_id' => 75, 'question_id' => 75, 'score' => 66.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 237, 'quizze_id' => 76, 'question_id' => 76, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 237, 'quizze_id' => 77, 'question_id' => 77, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 24.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 238, 'quizze_id' => 71, 'question_id' => 71, 'score' => 85.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 238, 'quizze_id' => 72, 'question_id' => 72, 'score' => 75.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 238, 'quizze_id' => 73, 'question_id' => 73, 'score' => 82.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 238, 'quizze_id' => 74, 'question_id' => 74, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 238, 'quizze_id' => 75, 'question_id' => 75, 'score' => 67.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 238, 'quizze_id' => 76, 'question_id' => 76, 'score' => 63.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 238, 'quizze_id' => 77, 'question_id' => 77, 'score' => 60.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'السابع - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 239, 'quizze_id' => 81, 'question_id' => 81, 'score' => 98.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 239, 'quizze_id' => 82, 'question_id' => 82, 'score' => 94.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 239, 'quizze_id' => 83, 'question_id' => 83, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 239, 'quizze_id' => 84, 'question_id' => 84, 'score' => 94.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 239, 'quizze_id' => 85, 'question_id' => 85, 'score' => 99.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 239, 'quizze_id' => 86, 'question_id' => 86, 'score' => 97.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 239, 'quizze_id' => 87, 'question_id' => 87, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 240, 'quizze_id' => 81, 'question_id' => 81, 'score' => 70.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 240, 'quizze_id' => 82, 'question_id' => 82, 'score' => 71.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 240, 'quizze_id' => 83, 'question_id' => 83, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 240, 'quizze_id' => 84, 'question_id' => 84, 'score' => 75.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 240, 'quizze_id' => 85, 'question_id' => 85, 'score' => 64.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 240, 'quizze_id' => 86, 'question_id' => 86, 'score' => 56.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 240, 'quizze_id' => 87, 'question_id' => 87, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 241, 'quizze_id' => 81, 'question_id' => 81, 'score' => 81.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 241, 'quizze_id' => 82, 'question_id' => 82, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 241, 'quizze_id' => 83, 'question_id' => 83, 'score' => 73.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 241, 'quizze_id' => 84, 'question_id' => 84, 'score' => 72.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 241, 'quizze_id' => 85, 'question_id' => 85, 'score' => 66.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 241, 'quizze_id' => 86, 'question_id' => 86, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 241, 'quizze_id' => 87, 'question_id' => 87, 'score' => 79.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 242, 'quizze_id' => 81, 'question_id' => 81, 'score' => 51.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 24.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 242, 'quizze_id' => 82, 'question_id' => 82, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 242, 'quizze_id' => 83, 'question_id' => 83, 'score' => 56.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 242, 'quizze_id' => 84, 'question_id' => 84, 'score' => 71.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 242, 'quizze_id' => 85, 'question_id' => 85, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 21.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 242, 'quizze_id' => 86, 'question_id' => 86, 'score' => 55.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 242, 'quizze_id' => 87, 'question_id' => 87, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 24.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 243, 'quizze_id' => 81, 'question_id' => 81, 'score' => 77.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 243, 'quizze_id' => 82, 'question_id' => 82, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 243, 'quizze_id' => 83, 'question_id' => 83, 'score' => 66.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 243, 'quizze_id' => 84, 'question_id' => 84, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 243, 'quizze_id' => 85, 'question_id' => 85, 'score' => 55.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 243, 'quizze_id' => 86, 'question_id' => 86, 'score' => 66.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 243, 'quizze_id' => 87, 'question_id' => 87, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 244, 'quizze_id' => 81, 'question_id' => 81, 'score' => 71.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 244, 'quizze_id' => 82, 'question_id' => 82, 'score' => 75.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 244, 'quizze_id' => 83, 'question_id' => 83, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 244, 'quizze_id' => 84, 'question_id' => 84, 'score' => 66.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 244, 'quizze_id' => 85, 'question_id' => 85, 'score' => 55.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 244, 'quizze_id' => 86, 'question_id' => 86, 'score' => 66.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 244, 'quizze_id' => 87, 'question_id' => 87, 'score' => 62.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 245, 'quizze_id' => 81, 'question_id' => 81, 'score' => 99.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 245, 'quizze_id' => 82, 'question_id' => 82, 'score' => 98.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 245, 'quizze_id' => 83, 'question_id' => 83, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 245, 'quizze_id' => 84, 'question_id' => 84, 'score' => 94.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 245, 'quizze_id' => 85, 'question_id' => 85, 'score' => 97.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 245, 'quizze_id' => 86, 'question_id' => 86, 'score' => 99.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 245, 'quizze_id' => 87, 'question_id' => 87, 'score' => 94.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 246, 'quizze_id' => 81, 'question_id' => 81, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 246, 'quizze_id' => 82, 'question_id' => 82, 'score' => 70.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 246, 'quizze_id' => 83, 'question_id' => 83, 'score' => 60.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 246, 'quizze_id' => 84, 'question_id' => 84, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 246, 'quizze_id' => 85, 'question_id' => 85, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 246, 'quizze_id' => 86, 'question_id' => 86, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 246, 'quizze_id' => 87, 'question_id' => 87, 'score' => 62.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 247, 'quizze_id' => 81, 'question_id' => 81, 'score' => 72.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 247, 'quizze_id' => 82, 'question_id' => 82, 'score' => 78.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 247, 'quizze_id' => 83, 'question_id' => 83, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 247, 'quizze_id' => 84, 'question_id' => 84, 'score' => 77.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 247, 'quizze_id' => 85, 'question_id' => 85, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 247, 'quizze_id' => 86, 'question_id' => 86, 'score' => 64.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 247, 'quizze_id' => 87, 'question_id' => 87, 'score' => 66.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 248, 'quizze_id' => 81, 'question_id' => 81, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 248, 'quizze_id' => 82, 'question_id' => 82, 'score' => 54.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 248, 'quizze_id' => 83, 'question_id' => 83, 'score' => 63.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 248, 'quizze_id' => 84, 'question_id' => 84, 'score' => 67.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 248, 'quizze_id' => 85, 'question_id' => 85, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 22.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 248, 'quizze_id' => 86, 'question_id' => 86, 'score' => 55.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 248, 'quizze_id' => 87, 'question_id' => 87, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 23.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 249, 'quizze_id' => 81, 'question_id' => 81, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 249, 'quizze_id' => 82, 'question_id' => 82, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 249, 'quizze_id' => 83, 'question_id' => 83, 'score' => 91.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 249, 'quizze_id' => 84, 'question_id' => 84, 'score' => 91.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 249, 'quizze_id' => 85, 'question_id' => 85, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 249, 'quizze_id' => 86, 'question_id' => 86, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 249, 'quizze_id' => 87, 'question_id' => 87, 'score' => 86.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 250, 'quizze_id' => 81, 'question_id' => 81, 'score' => 72.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 250, 'quizze_id' => 82, 'question_id' => 82, 'score' => 61.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 250, 'quizze_id' => 83, 'question_id' => 83, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 250, 'quizze_id' => 84, 'question_id' => 84, 'score' => 72.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 250, 'quizze_id' => 85, 'question_id' => 85, 'score' => 60.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 250, 'quizze_id' => 86, 'question_id' => 86, 'score' => 56.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 250, 'quizze_id' => 87, 'question_id' => 87, 'score' => 54.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 251, 'quizze_id' => 81, 'question_id' => 81, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 251, 'quizze_id' => 82, 'question_id' => 82, 'score' => 85.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 251, 'quizze_id' => 83, 'question_id' => 83, 'score' => 82.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 251, 'quizze_id' => 84, 'question_id' => 84, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 251, 'quizze_id' => 85, 'question_id' => 85, 'score' => 64.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 251, 'quizze_id' => 86, 'question_id' => 86, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 251, 'quizze_id' => 87, 'question_id' => 87, 'score' => 84.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 252, 'quizze_id' => 81, 'question_id' => 81, 'score' => 86.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 252, 'quizze_id' => 82, 'question_id' => 82, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 252, 'quizze_id' => 83, 'question_id' => 83, 'score' => 79.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 252, 'quizze_id' => 84, 'question_id' => 84, 'score' => 82.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 252, 'quizze_id' => 85, 'question_id' => 85, 'score' => 77.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 252, 'quizze_id' => 86, 'question_id' => 86, 'score' => 79.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 252, 'quizze_id' => 87, 'question_id' => 87, 'score' => 78.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 253, 'quizze_id' => 81, 'question_id' => 81, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 253, 'quizze_id' => 82, 'question_id' => 82, 'score' => 66.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 253, 'quizze_id' => 83, 'question_id' => 83, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 253, 'quizze_id' => 84, 'question_id' => 84, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 253, 'quizze_id' => 85, 'question_id' => 85, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 253, 'quizze_id' => 86, 'question_id' => 86, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 253, 'quizze_id' => 87, 'question_id' => 87, 'score' => 66.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 254, 'quizze_id' => 81, 'question_id' => 81, 'score' => 70.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 254, 'quizze_id' => 82, 'question_id' => 82, 'score' => 63.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 254, 'quizze_id' => 83, 'question_id' => 83, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 254, 'quizze_id' => 84, 'question_id' => 84, 'score' => 62.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 254, 'quizze_id' => 85, 'question_id' => 85, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 254, 'quizze_id' => 86, 'question_id' => 86, 'score' => 56.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 254, 'quizze_id' => 87, 'question_id' => 87, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 255, 'quizze_id' => 81, 'question_id' => 81, 'score' => 56.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 24.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 255, 'quizze_id' => 82, 'question_id' => 82, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 255, 'quizze_id' => 83, 'question_id' => 83, 'score' => 61.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 255, 'quizze_id' => 84, 'question_id' => 84, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 255, 'quizze_id' => 85, 'question_id' => 85, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 255, 'quizze_id' => 86, 'question_id' => 86, 'score' => 62.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 255, 'quizze_id' => 87, 'question_id' => 87, 'score' => 60.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 256, 'quizze_id' => 81, 'question_id' => 81, 'score' => 82.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 256, 'quizze_id' => 82, 'question_id' => 82, 'score' => 91.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 256, 'quizze_id' => 83, 'question_id' => 83, 'score' => 94.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 256, 'quizze_id' => 84, 'question_id' => 84, 'score' => 96.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 256, 'quizze_id' => 85, 'question_id' => 85, 'score' => 93.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 256, 'quizze_id' => 86, 'question_id' => 86, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 256, 'quizze_id' => 87, 'question_id' => 87, 'score' => 82.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 257, 'quizze_id' => 81, 'question_id' => 81, 'score' => 54.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 23.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 257, 'quizze_id' => 82, 'question_id' => 82, 'score' => 54.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 257, 'quizze_id' => 83, 'question_id' => 83, 'score' => 59.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 257, 'quizze_id' => 84, 'question_id' => 84, 'score' => 59.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 257, 'quizze_id' => 85, 'question_id' => 85, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 257, 'quizze_id' => 86, 'question_id' => 86, 'score' => 56.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 257, 'quizze_id' => 87, 'question_id' => 87, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 258, 'quizze_id' => 81, 'question_id' => 81, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 23.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 258, 'quizze_id' => 82, 'question_id' => 82, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 21.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 258, 'quizze_id' => 83, 'question_id' => 83, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 23.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 258, 'quizze_id' => 84, 'question_id' => 84, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 258, 'quizze_id' => 85, 'question_id' => 85, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 258, 'quizze_id' => 86, 'question_id' => 86, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 258, 'quizze_id' => 87, 'question_id' => 87, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 259, 'quizze_id' => 81, 'question_id' => 81, 'score' => 85.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 259, 'quizze_id' => 82, 'question_id' => 82, 'score' => 85.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 259, 'quizze_id' => 83, 'question_id' => 83, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 259, 'quizze_id' => 84, 'question_id' => 84, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 259, 'quizze_id' => 85, 'question_id' => 85, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 259, 'quizze_id' => 86, 'question_id' => 86, 'score' => 84.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 259, 'quizze_id' => 87, 'question_id' => 87, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 260, 'quizze_id' => 81, 'question_id' => 81, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 260, 'quizze_id' => 82, 'question_id' => 82, 'score' => 94.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 260, 'quizze_id' => 83, 'question_id' => 83, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 260, 'quizze_id' => 84, 'question_id' => 84, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 260, 'quizze_id' => 85, 'question_id' => 85, 'score' => 92.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 260, 'quizze_id' => 86, 'question_id' => 86, 'score' => 91.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 260, 'quizze_id' => 87, 'question_id' => 87, 'score' => 79.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 261, 'quizze_id' => 81, 'question_id' => 81, 'score' => 59.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 261, 'quizze_id' => 82, 'question_id' => 82, 'score' => 66.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 261, 'quizze_id' => 83, 'question_id' => 83, 'score' => 82.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 261, 'quizze_id' => 84, 'question_id' => 84, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 261, 'quizze_id' => 85, 'question_id' => 85, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 261, 'quizze_id' => 86, 'question_id' => 86, 'score' => 67.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 261, 'quizze_id' => 87, 'question_id' => 87, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 262, 'quizze_id' => 81, 'question_id' => 81, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 262, 'quizze_id' => 82, 'question_id' => 82, 'score' => 54.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 262, 'quizze_id' => 83, 'question_id' => 83, 'score' => 56.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 262, 'quizze_id' => 84, 'question_id' => 84, 'score' => 72.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 262, 'quizze_id' => 85, 'question_id' => 85, 'score' => 51.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 24.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 262, 'quizze_id' => 86, 'question_id' => 86, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 21.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 262, 'quizze_id' => 87, 'question_id' => 87, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 263, 'quizze_id' => 81, 'question_id' => 81, 'score' => 56.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 263, 'quizze_id' => 82, 'question_id' => 82, 'score' => 75.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 263, 'quizze_id' => 83, 'question_id' => 83, 'score' => 59.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 263, 'quizze_id' => 84, 'question_id' => 84, 'score' => 61.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 263, 'quizze_id' => 85, 'question_id' => 85, 'score' => 55.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 263, 'quizze_id' => 86, 'question_id' => 86, 'score' => 56.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 263, 'quizze_id' => 87, 'question_id' => 87, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 264, 'quizze_id' => 81, 'question_id' => 81, 'score' => 71.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 264, 'quizze_id' => 82, 'question_id' => 82, 'score' => 81.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 264, 'quizze_id' => 83, 'question_id' => 83, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 264, 'quizze_id' => 84, 'question_id' => 84, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 264, 'quizze_id' => 85, 'question_id' => 85, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 18.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 264, 'quizze_id' => 86, 'question_id' => 86, 'score' => 81.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 264, 'quizze_id' => 87, 'question_id' => 87, 'score' => 62.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 265, 'quizze_id' => 81, 'question_id' => 81, 'score' => 64.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 265, 'quizze_id' => 82, 'question_id' => 82, 'score' => 70.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 265, 'quizze_id' => 83, 'question_id' => 83, 'score' => 59.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 265, 'quizze_id' => 84, 'question_id' => 84, 'score' => 62.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 265, 'quizze_id' => 85, 'question_id' => 85, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 24.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 265, 'quizze_id' => 86, 'question_id' => 86, 'score' => 64.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 265, 'quizze_id' => 87, 'question_id' => 87, 'score' => 54.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 266, 'quizze_id' => 81, 'question_id' => 81, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 266, 'quizze_id' => 82, 'question_id' => 82, 'score' => 67.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 266, 'quizze_id' => 83, 'question_id' => 83, 'score' => 62.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 266, 'quizze_id' => 84, 'question_id' => 84, 'score' => 71.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 266, 'quizze_id' => 85, 'question_id' => 85, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 266, 'quizze_id' => 86, 'question_id' => 86, 'score' => 62.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 266, 'quizze_id' => 87, 'question_id' => 87, 'score' => 62.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 267, 'quizze_id' => 81, 'question_id' => 81, 'score' => 51.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 267, 'quizze_id' => 82, 'question_id' => 82, 'score' => 59.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 267, 'quizze_id' => 83, 'question_id' => 83, 'score' => 56.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 267, 'quizze_id' => 84, 'question_id' => 84, 'score' => 56.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 267, 'quizze_id' => 85, 'question_id' => 85, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 267, 'quizze_id' => 86, 'question_id' => 86, 'score' => 55.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 267, 'quizze_id' => 87, 'question_id' => 87, 'score' => 54.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 268, 'quizze_id' => 81, 'question_id' => 81, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 268, 'quizze_id' => 82, 'question_id' => 82, 'score' => 92.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 268, 'quizze_id' => 83, 'question_id' => 83, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 268, 'quizze_id' => 84, 'question_id' => 84, 'score' => 82.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 268, 'quizze_id' => 85, 'question_id' => 85, 'score' => 84.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 268, 'quizze_id' => 86, 'question_id' => 86, 'score' => 91.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 268, 'quizze_id' => 87, 'question_id' => 87, 'score' => 81.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 269, 'quizze_id' => 81, 'question_id' => 81, 'score' => 73.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 269, 'quizze_id' => 82, 'question_id' => 82, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 269, 'quizze_id' => 83, 'question_id' => 83, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 269, 'quizze_id' => 84, 'question_id' => 84, 'score' => 79.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 269, 'quizze_id' => 85, 'question_id' => 85, 'score' => 55.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 269, 'quizze_id' => 86, 'question_id' => 86, 'score' => 75.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 269, 'quizze_id' => 87, 'question_id' => 87, 'score' => 72.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 270, 'quizze_id' => 81, 'question_id' => 81, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 270, 'quizze_id' => 82, 'question_id' => 82, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 270, 'quizze_id' => 83, 'question_id' => 83, 'score' => 79.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 270, 'quizze_id' => 84, 'question_id' => 84, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 270, 'quizze_id' => 85, 'question_id' => 85, 'score' => 79.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 270, 'quizze_id' => 86, 'question_id' => 86, 'score' => 82.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 270, 'quizze_id' => 87, 'question_id' => 87, 'score' => 85.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 271, 'quizze_id' => 81, 'question_id' => 81, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 21.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 271, 'quizze_id' => 82, 'question_id' => 82, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 271, 'quizze_id' => 83, 'question_id' => 83, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 24.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 271, 'quizze_id' => 84, 'question_id' => 84, 'score' => 60.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 271, 'quizze_id' => 85, 'question_id' => 85, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 23.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 271, 'quizze_id' => 86, 'question_id' => 86, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 22.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 271, 'quizze_id' => 87, 'question_id' => 87, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 21.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 272, 'quizze_id' => 81, 'question_id' => 81, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 24.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 272, 'quizze_id' => 82, 'question_id' => 82, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 272, 'quizze_id' => 83, 'question_id' => 83, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 272, 'quizze_id' => 84, 'question_id' => 84, 'score' => 62.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 272, 'quizze_id' => 85, 'question_id' => 85, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 272, 'quizze_id' => 86, 'question_id' => 86, 'score' => 60.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 272, 'quizze_id' => 87, 'question_id' => 87, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 20.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 273, 'quizze_id' => 81, 'question_id' => 81, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 273, 'quizze_id' => 82, 'question_id' => 82, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 273, 'quizze_id' => 83, 'question_id' => 83, 'score' => 86.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 273, 'quizze_id' => 84, 'question_id' => 84, 'score' => 91.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 273, 'quizze_id' => 85, 'question_id' => 85, 'score' => 64.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 273, 'quizze_id' => 86, 'question_id' => 86, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 273, 'quizze_id' => 87, 'question_id' => 87, 'score' => 77.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 274, 'quizze_id' => 81, 'question_id' => 81, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 274, 'quizze_id' => 82, 'question_id' => 82, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 274, 'quizze_id' => 83, 'question_id' => 83, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 274, 'quizze_id' => 84, 'question_id' => 84, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 274, 'quizze_id' => 85, 'question_id' => 85, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 274, 'quizze_id' => 86, 'question_id' => 86, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 274, 'quizze_id' => 87, 'question_id' => 87, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 275, 'quizze_id' => 81, 'question_id' => 81, 'score' => 43.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 15.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 275, 'quizze_id' => 82, 'question_id' => 82, 'score' => 39.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 24.0 | فصل ثاني: 15.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 275, 'quizze_id' => 83, 'question_id' => 83, 'score' => 39.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 14.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 275, 'quizze_id' => 84, 'question_id' => 84, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 275, 'quizze_id' => 85, 'question_id' => 85, 'score' => 41.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 15.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 275, 'quizze_id' => 86, 'question_id' => 86, 'score' => 39.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 14.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 275, 'quizze_id' => 87, 'question_id' => 87, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثامن - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 23.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 276, 'quizze_id' => 91, 'question_id' => 91, 'score' => 56.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 53.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 276, 'quizze_id' => 92, 'question_id' => 92, 'score' => 62.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 276, 'quizze_id' => 93, 'question_id' => 93, 'score' => 56.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 52.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 276, 'quizze_id' => 94, 'question_id' => 94, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 60.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 276, 'quizze_id' => 95, 'question_id' => 95, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 53.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 276, 'quizze_id' => 96, 'question_id' => 96, 'score' => 51.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 276, 'quizze_id' => 97, 'question_id' => 97, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 277, 'quizze_id' => 91, 'question_id' => 91, 'score' => 56.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 59.0 | فصل ثاني: 52.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 277, 'quizze_id' => 92, 'question_id' => 92, 'score' => 51.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 59.0 | فصل ثاني: 59.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 277, 'quizze_id' => 93, 'question_id' => 93, 'score' => 56.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 59.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 277, 'quizze_id' => 94, 'question_id' => 94, 'score' => 56.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 60.0 | فصل ثاني: 65.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 277, 'quizze_id' => 95, 'question_id' => 95, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 59.0 | فصل ثاني: 52.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 277, 'quizze_id' => 96, 'question_id' => 96, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 58.0 | فصل ثاني: 52.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 277, 'quizze_id' => 97, 'question_id' => 97, 'score' => 61.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 54.0 | فصل ثاني: 51.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 278, 'quizze_id' => 91, 'question_id' => 91, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 60.0 | فصل ثاني: 56.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 278, 'quizze_id' => 92, 'question_id' => 92, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 51.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 278, 'quizze_id' => 93, 'question_id' => 93, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 52.0 | فصل ثاني: 55.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 278, 'quizze_id' => 94, 'question_id' => 94, 'score' => 66.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 65.0 | فصل ثاني: 58.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 278, 'quizze_id' => 95, 'question_id' => 95, 'score' => 56.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 55.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 278, 'quizze_id' => 96, 'question_id' => 96, 'score' => 59.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 55.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 278, 'quizze_id' => 97, 'question_id' => 97, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 70.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 279, 'quizze_id' => 91, 'question_id' => 91, 'score' => 92.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 88.0 | فصل ثاني: 88.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 279, 'quizze_id' => 92, 'question_id' => 92, 'score' => 91.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 86.0 | فصل ثاني: 88.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 279, 'quizze_id' => 93, 'question_id' => 93, 'score' => 91.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 79.0 | فصل ثاني: 81.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 279, 'quizze_id' => 94, 'question_id' => 94, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 83.0 | فصل ثاني: 87.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 279, 'quizze_id' => 95, 'question_id' => 95, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 81.0 | فصل ثاني: 73.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 279, 'quizze_id' => 96, 'question_id' => 96, 'score' => 93.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 72.0 | فصل ثاني: 76.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 279, 'quizze_id' => 97, 'question_id' => 97, 'score' => 91.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 76.0 | فصل ثاني: 89.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 280, 'quizze_id' => 91, 'question_id' => 91, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 86.0 | فصل ثاني: 84.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 280, 'quizze_id' => 92, 'question_id' => 92, 'score' => 81.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 70.0 | فصل ثاني: 81.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 280, 'quizze_id' => 93, 'question_id' => 93, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 64.0 | فصل ثاني: 69.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 280, 'quizze_id' => 94, 'question_id' => 94, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 79.0 | فصل ثاني: 80.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 280, 'quizze_id' => 95, 'question_id' => 95, 'score' => 66.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 61.0 | فصل ثاني: 73.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 280, 'quizze_id' => 96, 'question_id' => 96, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 59.0 | فصل ثاني: 76.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 280, 'quizze_id' => 97, 'question_id' => 97, 'score' => 84.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 62.0 | فصل ثاني: 77.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 281, 'quizze_id' => 91, 'question_id' => 91, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 54.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 281, 'quizze_id' => 92, 'question_id' => 92, 'score' => 51.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 281, 'quizze_id' => 93, 'question_id' => 93, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 57.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 281, 'quizze_id' => 94, 'question_id' => 94, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 64.0 | فصل ثاني: 63.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 281, 'quizze_id' => 95, 'question_id' => 95, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 64.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 281, 'quizze_id' => 96, 'question_id' => 96, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 281, 'quizze_id' => 97, 'question_id' => 97, 'score' => 51.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 282, 'quizze_id' => 91, 'question_id' => 91, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 55.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 282, 'quizze_id' => 92, 'question_id' => 92, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 62.0 | فصل ثاني: 63.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 282, 'quizze_id' => 93, 'question_id' => 93, 'score' => 59.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 53.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 282, 'quizze_id' => 94, 'question_id' => 94, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 71.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 282, 'quizze_id' => 95, 'question_id' => 95, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 57.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 282, 'quizze_id' => 96, 'question_id' => 96, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 53.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 282, 'quizze_id' => 97, 'question_id' => 97, 'score' => 61.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 52.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 283, 'quizze_id' => 91, 'question_id' => 91, 'score' => 98.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 98.0 | فصل ثاني: 99.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 283, 'quizze_id' => 92, 'question_id' => 92, 'score' => 97.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 98.0 | فصل ثاني: 98.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 283, 'quizze_id' => 93, 'question_id' => 93, 'score' => 98.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 89.0 | فصل ثاني: 98.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 283, 'quizze_id' => 94, 'question_id' => 94, 'score' => 98.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 96.0 | فصل ثاني: 100.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 283, 'quizze_id' => 95, 'question_id' => 95, 'score' => 99.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 100.0 | فصل ثاني: 100.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 283, 'quizze_id' => 96, 'question_id' => 96, 'score' => 99.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 93.0 | فصل ثاني: 98.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 283, 'quizze_id' => 97, 'question_id' => 97, 'score' => 99.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 99.0 | فصل ثاني: 99.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 284, 'quizze_id' => 91, 'question_id' => 91, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 92.0 | فصل ثاني: 84.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 284, 'quizze_id' => 92, 'question_id' => 92, 'score' => 85.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 88.0 | فصل ثاني: 88.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 284, 'quizze_id' => 93, 'question_id' => 93, 'score' => 94.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 81.0 | فصل ثاني: 84.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 284, 'quizze_id' => 94, 'question_id' => 94, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 92.0 | فصل ثاني: 87.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 284, 'quizze_id' => 95, 'question_id' => 95, 'score' => 86.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 88.0 | فصل ثاني: 96.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 284, 'quizze_id' => 96, 'question_id' => 96, 'score' => 94.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 82.0 | فصل ثاني: 90.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 284, 'quizze_id' => 97, 'question_id' => 97, 'score' => 97.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 86.0 | فصل ثاني: 91.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 285, 'quizze_id' => 91, 'question_id' => 91, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 51.0 | فصل ثاني: 51.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 285, 'quizze_id' => 92, 'question_id' => 92, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 57.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 285, 'quizze_id' => 93, 'question_id' => 93, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 285, 'quizze_id' => 94, 'question_id' => 94, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 52.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 285, 'quizze_id' => 95, 'question_id' => 95, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 55.0 | فصل ثاني: 52.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 285, 'quizze_id' => 96, 'question_id' => 96, 'score' => 55.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 285, 'quizze_id' => 97, 'question_id' => 97, 'score' => 54.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 53.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 286, 'quizze_id' => 91, 'question_id' => 91, 'score' => 92.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 86.0 | فصل ثاني: 81.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 286, 'quizze_id' => 92, 'question_id' => 92, 'score' => 91.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 87.0 | فصل ثاني: 91.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 286, 'quizze_id' => 93, 'question_id' => 93, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 77.0 | فصل ثاني: 78.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 286, 'quizze_id' => 94, 'question_id' => 94, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 93.0 | فصل ثاني: 90.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 286, 'quizze_id' => 95, 'question_id' => 95, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 74.0 | فصل ثاني: 81.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 286, 'quizze_id' => 96, 'question_id' => 96, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 73.0 | فصل ثاني: 86.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 286, 'quizze_id' => 97, 'question_id' => 97, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 73.0 | فصل ثاني: 85.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 287, 'quizze_id' => 91, 'question_id' => 91, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 93.0 | فصل ثاني: 86.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 287, 'quizze_id' => 92, 'question_id' => 92, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 87.0 | فصل ثاني: 92.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 287, 'quizze_id' => 93, 'question_id' => 93, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 74.0 | فصل ثاني: 81.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 287, 'quizze_id' => 94, 'question_id' => 94, 'score' => 92.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 85.0 | فصل ثاني: 92.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 287, 'quizze_id' => 95, 'question_id' => 95, 'score' => 85.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 84.0 | فصل ثاني: 88.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 287, 'quizze_id' => 96, 'question_id' => 96, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 86.0 | فصل ثاني: 85.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 287, 'quizze_id' => 97, 'question_id' => 97, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 84.0 | فصل ثاني: 93.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 288, 'quizze_id' => 91, 'question_id' => 91, 'score' => 56.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 71.0 | فصل ثاني: 64.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 288, 'quizze_id' => 92, 'question_id' => 92, 'score' => 59.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 61.0 | فصل ثاني: 71.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 288, 'quizze_id' => 93, 'question_id' => 93, 'score' => 67.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 60.0 | فصل ثاني: 58.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 288, 'quizze_id' => 94, 'question_id' => 94, 'score' => 63.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 79.0 | فصل ثاني: 62.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 288, 'quizze_id' => 95, 'question_id' => 95, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 60.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 288, 'quizze_id' => 96, 'question_id' => 96, 'score' => 60.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 59.0 | فصل ثاني: 53.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 288, 'quizze_id' => 97, 'question_id' => 97, 'score' => 66.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 62.0 | فصل ثاني: 55.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 289, 'quizze_id' => 91, 'question_id' => 91, 'score' => 63.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 77.0 | فصل ثاني: 58.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 289, 'quizze_id' => 92, 'question_id' => 92, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 61.0 | فصل ثاني: 79.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 289, 'quizze_id' => 93, 'question_id' => 93, 'score' => 70.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 54.0 | فصل ثاني: 56.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 289, 'quizze_id' => 94, 'question_id' => 94, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 80.0 | فصل ثاني: 65.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 289, 'quizze_id' => 95, 'question_id' => 95, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 66.0 | فصل ثاني: 56.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 289, 'quizze_id' => 96, 'question_id' => 96, 'score' => 55.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 61.0 | فصل ثاني: 55.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 289, 'quizze_id' => 97, 'question_id' => 97, 'score' => 59.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 60.0 | فصل ثاني: 65.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 290, 'quizze_id' => 91, 'question_id' => 91, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 51.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 290, 'quizze_id' => 92, 'question_id' => 92, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 66.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 290, 'quizze_id' => 93, 'question_id' => 93, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 52.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 290, 'quizze_id' => 94, 'question_id' => 94, 'score' => 78.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 70.0 | فصل ثاني: 57.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 290, 'quizze_id' => 95, 'question_id' => 95, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 58.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 290, 'quizze_id' => 96, 'question_id' => 96, 'score' => 51.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 56.0 | فصل ثاني: 54.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 290, 'quizze_id' => 97, 'question_id' => 97, 'score' => 55.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 54.0 | فصل ثاني: 56.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 291, 'quizze_id' => 91, 'question_id' => 91, 'score' => 98.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 100.0 | فصل ثاني: 89.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 291, 'quizze_id' => 92, 'question_id' => 92, 'score' => 94.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 99.0 | فصل ثاني: 97.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 291, 'quizze_id' => 93, 'question_id' => 93, 'score' => 96.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 97.0 | فصل ثاني: 92.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 291, 'quizze_id' => 94, 'question_id' => 94, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 94.0 | فصل ثاني: 100.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 291, 'quizze_id' => 95, 'question_id' => 95, 'score' => 84.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 91.0 | فصل ثاني: 87.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 291, 'quizze_id' => 96, 'question_id' => 96, 'score' => 93.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 97.0 | فصل ثاني: 89.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 291, 'quizze_id' => 97, 'question_id' => 97, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 99.0 | فصل ثاني: 99.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 292, 'quizze_id' => 91, 'question_id' => 91, 'score' => 78.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 72.0 | فصل ثاني: 65.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 292, 'quizze_id' => 92, 'question_id' => 92, 'score' => 72.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 71.0 | فصل ثاني: 82.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 292, 'quizze_id' => 93, 'question_id' => 93, 'score' => 85.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 53.0 | فصل ثاني: 69.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 292, 'quizze_id' => 94, 'question_id' => 94, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 84.0 | فصل ثاني: 78.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 292, 'quizze_id' => 95, 'question_id' => 95, 'score' => 73.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 75.0 | فصل ثاني: 54.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 292, 'quizze_id' => 96, 'question_id' => 96, 'score' => 71.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 51.0 | فصل ثاني: 62.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 292, 'quizze_id' => 97, 'question_id' => 97, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 69.0 | فصل ثاني: 77.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 293, 'quizze_id' => 91, 'question_id' => 91, 'score' => 84.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 82.0 | فصل ثاني: 85.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 293, 'quizze_id' => 92, 'question_id' => 92, 'score' => 77.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 77.0 | فصل ثاني: 90.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 293, 'quizze_id' => 93, 'question_id' => 93, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 80.0 | فصل ثاني: 74.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 293, 'quizze_id' => 94, 'question_id' => 94, 'score' => 91.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 89.0 | فصل ثاني: 86.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 293, 'quizze_id' => 95, 'question_id' => 95, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 61.0 | فصل ثاني: 67.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 293, 'quizze_id' => 96, 'question_id' => 96, 'score' => 79.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 77.0 | فصل ثاني: 85.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 293, 'quizze_id' => 97, 'question_id' => 97, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 73.0 | فصل ثاني: 91.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 294, 'quizze_id' => 91, 'question_id' => 91, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 95.0 | فصل ثاني: 93.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 294, 'quizze_id' => 92, 'question_id' => 92, 'score' => 98.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 96.0 | فصل ثاني: 93.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 294, 'quizze_id' => 93, 'question_id' => 93, 'score' => 94.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 78.0 | فصل ثاني: 85.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 294, 'quizze_id' => 94, 'question_id' => 94, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 87.0 | فصل ثاني: 100.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 294, 'quizze_id' => 95, 'question_id' => 95, 'score' => 79.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 71.0 | فصل ثاني: 70.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 294, 'quizze_id' => 96, 'question_id' => 96, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 85.0 | فصل ثاني: 90.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 294, 'quizze_id' => 97, 'question_id' => 97, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 88.0 | فصل ثاني: 93.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 295, 'quizze_id' => 91, 'question_id' => 91, 'score' => 70.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 83.0 | فصل ثاني: 72.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 295, 'quizze_id' => 92, 'question_id' => 92, 'score' => 67.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 61.0 | فصل ثاني: 70.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 295, 'quizze_id' => 93, 'question_id' => 93, 'score' => 85.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 72.0 | فصل ثاني: 64.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 295, 'quizze_id' => 94, 'question_id' => 94, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 82.0 | فصل ثاني: 80.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 295, 'quizze_id' => 95, 'question_id' => 95, 'score' => 55.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 62.0 | فصل ثاني: 52.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 295, 'quizze_id' => 96, 'question_id' => 96, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 57.0 | فصل ثاني: 75.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 295, 'quizze_id' => 97, 'question_id' => 97, 'score' => 77.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 54.0 | فصل ثاني: 72.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 296, 'quizze_id' => 91, 'question_id' => 91, 'score' => 86.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 90.0 | فصل ثاني: 87.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 296, 'quizze_id' => 92, 'question_id' => 92, 'score' => 81.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 74.0 | فصل ثاني: 82.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 296, 'quizze_id' => 93, 'question_id' => 93, 'score' => 97.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 73.0 | فصل ثاني: 72.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 296, 'quizze_id' => 94, 'question_id' => 94, 'score' => 71.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 90.0 | فصل ثاني: 88.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 296, 'quizze_id' => 95, 'question_id' => 95, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 68.0 | فصل ثاني: 72.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 296, 'quizze_id' => 96, 'question_id' => 96, 'score' => 79.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 85.0 | فصل ثاني: 74.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 296, 'quizze_id' => 97, 'question_id' => 97, 'score' => 84.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 81.0 | فصل ثاني: 83.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 297, 'quizze_id' => 91, 'question_id' => 91, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 71.0 | فصل ثاني: 54.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 297, 'quizze_id' => 92, 'question_id' => 92, 'score' => 51.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 60.0 | فصل ثاني: 61.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 297, 'quizze_id' => 93, 'question_id' => 93, 'score' => 66.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 56.0 | فصل ثاني: 53.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 297, 'quizze_id' => 94, 'question_id' => 94, 'score' => 60.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 77.0 | فصل ثاني: 57.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 297, 'quizze_id' => 95, 'question_id' => 95, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 54.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 297, 'quizze_id' => 96, 'question_id' => 96, 'score' => 51.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 57.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 297, 'quizze_id' => 97, 'question_id' => 97, 'score' => 55.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 61.0 | فصل ثاني: 56.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 298, 'quizze_id' => 91, 'question_id' => 91, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 73.0 | فصل ثاني: 68.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 298, 'quizze_id' => 92, 'question_id' => 92, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 60.0 | فصل ثاني: 63.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 298, 'quizze_id' => 93, 'question_id' => 93, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 65.0 | فصل ثاني: 62.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 298, 'quizze_id' => 94, 'question_id' => 94, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 83.0 | فصل ثاني: 74.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 298, 'quizze_id' => 95, 'question_id' => 95, 'score' => 59.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 61.0 | فصل ثاني: 65.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 298, 'quizze_id' => 96, 'question_id' => 96, 'score' => 67.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 63.0 | فصل ثاني: 72.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 298, 'quizze_id' => 97, 'question_id' => 97, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 60.0 | فصل ثاني: 68.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 299, 'quizze_id' => 91, 'question_id' => 91, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 87.0 | فصل ثاني: 82.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 299, 'quizze_id' => 92, 'question_id' => 92, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 74.0 | فصل ثاني: 88.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 299, 'quizze_id' => 93, 'question_id' => 93, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 78.0 | فصل ثاني: 71.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 299, 'quizze_id' => 94, 'question_id' => 94, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 92.0 | فصل ثاني: 88.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 299, 'quizze_id' => 95, 'question_id' => 95, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 68.0 | فصل ثاني: 65.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 299, 'quizze_id' => 96, 'question_id' => 96, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 79.0 | فصل ثاني: 68.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 299, 'quizze_id' => 97, 'question_id' => 97, 'score' => 86.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 75.0 | فصل ثاني: 72.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 300, 'quizze_id' => 91, 'question_id' => 91, 'score' => 72.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 75.0 | فصل ثاني: 67.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 300, 'quizze_id' => 92, 'question_id' => 92, 'score' => 75.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 70.0 | فصل ثاني: 68.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 300, 'quizze_id' => 93, 'question_id' => 93, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 68.0 | فصل ثاني: 57.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 300, 'quizze_id' => 94, 'question_id' => 94, 'score' => 63.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 87.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 300, 'quizze_id' => 95, 'question_id' => 95, 'score' => 51.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 59.0 | فصل ثاني: 51.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 300, 'quizze_id' => 96, 'question_id' => 96, 'score' => 66.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 64.0 | فصل ثاني: 71.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 300, 'quizze_id' => 97, 'question_id' => 97, 'score' => 71.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 59.0 | فصل ثاني: 64.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 301, 'quizze_id' => 91, 'question_id' => 91, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 75.0 | فصل ثاني: 56.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 301, 'quizze_id' => 92, 'question_id' => 92, 'score' => 71.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 68.0 | فصل ثاني: 72.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 301, 'quizze_id' => 93, 'question_id' => 93, 'score' => 71.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 65.0 | فصل ثاني: 56.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 301, 'quizze_id' => 94, 'question_id' => 94, 'score' => 72.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 79.0 | فصل ثاني: 63.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 301, 'quizze_id' => 95, 'question_id' => 95, 'score' => 55.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 70.0 | فصل ثاني: 55.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 301, 'quizze_id' => 96, 'question_id' => 96, 'score' => 66.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 62.0 | فصل ثاني: 62.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 301, 'quizze_id' => 97, 'question_id' => 97, 'score' => 62.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 65.0 | فصل ثاني: 57.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 302, 'quizze_id' => 91, 'question_id' => 91, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 57.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 302, 'quizze_id' => 92, 'question_id' => 92, 'score' => 61.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 51.0 | فصل ثاني: 62.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 302, 'quizze_id' => 93, 'question_id' => 93, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 53.0 | فصل ثاني: 53.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 302, 'quizze_id' => 94, 'question_id' => 94, 'score' => 72.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 67.0 | فصل ثاني: 51.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 302, 'quizze_id' => 95, 'question_id' => 95, 'score' => 54.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 58.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 302, 'quizze_id' => 96, 'question_id' => 96, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 69.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 302, 'quizze_id' => 97, 'question_id' => 97, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'التاسع - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 72.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 303, 'quizze_id' => 98, 'question_id' => 98, 'score' => 64.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 303, 'quizze_id' => 99, 'question_id' => 99, 'score' => 61.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 303, 'quizze_id' => 100, 'question_id' => 100, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 303, 'quizze_id' => 101, 'question_id' => 101, 'score' => 51.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 24.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 303, 'quizze_id' => 102, 'question_id' => 102, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 303, 'quizze_id' => 103, 'question_id' => 103, 'score' => 70.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 303, 'quizze_id' => 104, 'question_id' => 104, 'score' => 70.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 303, 'quizze_id' => 105, 'question_id' => 105, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 303, 'quizze_id' => 106, 'question_id' => 106, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 303, 'quizze_id' => 107, 'question_id' => 107, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 20.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 304, 'quizze_id' => 98, 'question_id' => 98, 'score' => 93.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 304, 'quizze_id' => 99, 'question_id' => 99, 'score' => 99.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 304, 'quizze_id' => 100, 'question_id' => 100, 'score' => 99.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 304, 'quizze_id' => 101, 'question_id' => 101, 'score' => 84.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 304, 'quizze_id' => 102, 'question_id' => 102, 'score' => 99.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 304, 'quizze_id' => 103, 'question_id' => 103, 'score' => 96.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 304, 'quizze_id' => 104, 'question_id' => 104, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 304, 'quizze_id' => 105, 'question_id' => 105, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 304, 'quizze_id' => 106, 'question_id' => 106, 'score' => 96.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 304, 'quizze_id' => 107, 'question_id' => 107, 'score' => 97.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 305, 'quizze_id' => 98, 'question_id' => 98, 'score' => 51.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 24.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 305, 'quizze_id' => 99, 'question_id' => 99, 'score' => 66.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 305, 'quizze_id' => 100, 'question_id' => 100, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 305, 'quizze_id' => 101, 'question_id' => 101, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 15.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 305, 'quizze_id' => 102, 'question_id' => 102, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 17.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 305, 'quizze_id' => 103, 'question_id' => 103, 'score' => 56.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 305, 'quizze_id' => 104, 'question_id' => 104, 'score' => 56.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 23.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 305, 'quizze_id' => 105, 'question_id' => 105, 'score' => 64.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 305, 'quizze_id' => 106, 'question_id' => 106, 'score' => 51.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 25.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 305, 'quizze_id' => 107, 'question_id' => 107, 'score' => 54.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 23.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 306, 'quizze_id' => 98, 'question_id' => 98, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 306, 'quizze_id' => 99, 'question_id' => 99, 'score' => 97.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 306, 'quizze_id' => 100, 'question_id' => 100, 'score' => 96.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 306, 'quizze_id' => 101, 'question_id' => 101, 'score' => 75.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 306, 'quizze_id' => 102, 'question_id' => 102, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 306, 'quizze_id' => 103, 'question_id' => 103, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 306, 'quizze_id' => 104, 'question_id' => 104, 'score' => 91.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 306, 'quizze_id' => 105, 'question_id' => 105, 'score' => 82.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 306, 'quizze_id' => 106, 'question_id' => 106, 'score' => 92.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 306, 'quizze_id' => 107, 'question_id' => 107, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 307, 'quizze_id' => 98, 'question_id' => 98, 'score' => 66.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 307, 'quizze_id' => 99, 'question_id' => 99, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 307, 'quizze_id' => 100, 'question_id' => 100, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 307, 'quizze_id' => 101, 'question_id' => 101, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 307, 'quizze_id' => 102, 'question_id' => 102, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 307, 'quizze_id' => 103, 'question_id' => 103, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 307, 'quizze_id' => 104, 'question_id' => 104, 'score' => 67.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 307, 'quizze_id' => 105, 'question_id' => 105, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 307, 'quizze_id' => 106, 'question_id' => 106, 'score' => 72.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 307, 'quizze_id' => 107, 'question_id' => 107, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 308, 'quizze_id' => 98, 'question_id' => 98, 'score' => 93.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 308, 'quizze_id' => 99, 'question_id' => 99, 'score' => 79.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 308, 'quizze_id' => 100, 'question_id' => 100, 'score' => 92.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 308, 'quizze_id' => 101, 'question_id' => 101, 'score' => 77.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 308, 'quizze_id' => 102, 'question_id' => 102, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 308, 'quizze_id' => 103, 'question_id' => 103, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 308, 'quizze_id' => 104, 'question_id' => 104, 'score' => 85.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 308, 'quizze_id' => 105, 'question_id' => 105, 'score' => 86.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 308, 'quizze_id' => 106, 'question_id' => 106, 'score' => 93.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 308, 'quizze_id' => 107, 'question_id' => 107, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 309, 'quizze_id' => 98, 'question_id' => 98, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 309, 'quizze_id' => 99, 'question_id' => 99, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 309, 'quizze_id' => 100, 'question_id' => 100, 'score' => 99.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 309, 'quizze_id' => 101, 'question_id' => 101, 'score' => 78.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 309, 'quizze_id' => 102, 'question_id' => 102, 'score' => 94.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 309, 'quizze_id' => 103, 'question_id' => 103, 'score' => 96.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 309, 'quizze_id' => 104, 'question_id' => 104, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 309, 'quizze_id' => 105, 'question_id' => 105, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 309, 'quizze_id' => 106, 'question_id' => 106, 'score' => 96.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 309, 'quizze_id' => 107, 'question_id' => 107, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 310, 'quizze_id' => 98, 'question_id' => 98, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 310, 'quizze_id' => 99, 'question_id' => 99, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 310, 'quizze_id' => 100, 'question_id' => 100, 'score' => 99.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 310, 'quizze_id' => 101, 'question_id' => 101, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 310, 'quizze_id' => 102, 'question_id' => 102, 'score' => 97.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 310, 'quizze_id' => 103, 'question_id' => 103, 'score' => 97.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 310, 'quizze_id' => 104, 'question_id' => 104, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 310, 'quizze_id' => 105, 'question_id' => 105, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 310, 'quizze_id' => 106, 'question_id' => 106, 'score' => 97.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 310, 'quizze_id' => 107, 'question_id' => 107, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 311, 'quizze_id' => 98, 'question_id' => 98, 'score' => 61.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 311, 'quizze_id' => 99, 'question_id' => 99, 'score' => 63.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 311, 'quizze_id' => 100, 'question_id' => 100, 'score' => 72.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 36.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 311, 'quizze_id' => 101, 'question_id' => 101, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 311, 'quizze_id' => 102, 'question_id' => 102, 'score' => 79.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 311, 'quizze_id' => 103, 'question_id' => 103, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 311, 'quizze_id' => 104, 'question_id' => 104, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 311, 'quizze_id' => 105, 'question_id' => 105, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 311, 'quizze_id' => 106, 'question_id' => 106, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 311, 'quizze_id' => 107, 'question_id' => 107, 'score' => 61.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 312, 'quizze_id' => 98, 'question_id' => 98, 'score' => 93.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 312, 'quizze_id' => 99, 'question_id' => 99, 'score' => 86.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 312, 'quizze_id' => 100, 'question_id' => 100, 'score' => 86.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 312, 'quizze_id' => 101, 'question_id' => 101, 'score' => 70.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 312, 'quizze_id' => 102, 'question_id' => 102, 'score' => 92.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 312, 'quizze_id' => 103, 'question_id' => 103, 'score' => 86.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 312, 'quizze_id' => 104, 'question_id' => 104, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 312, 'quizze_id' => 105, 'question_id' => 105, 'score' => 79.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 312, 'quizze_id' => 106, 'question_id' => 106, 'score' => 75.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 312, 'quizze_id' => 107, 'question_id' => 107, 'score' => 81.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 313, 'quizze_id' => 98, 'question_id' => 98, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 313, 'quizze_id' => 99, 'question_id' => 99, 'score' => 62.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 313, 'quizze_id' => 100, 'question_id' => 100, 'score' => 70.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 313, 'quizze_id' => 101, 'question_id' => 101, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 22.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 313, 'quizze_id' => 102, 'question_id' => 102, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 313, 'quizze_id' => 103, 'question_id' => 103, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 313, 'quizze_id' => 104, 'question_id' => 104, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 313, 'quizze_id' => 105, 'question_id' => 105, 'score' => 55.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 313, 'quizze_id' => 106, 'question_id' => 106, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 313, 'quizze_id' => 107, 'question_id' => 107, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الأول الثانوي - 2023/2024م | فصل أول: 22.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 314, 'quizze_id' => 109, 'question_id' => 109, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 314, 'quizze_id' => 110, 'question_id' => 110, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 314, 'quizze_id' => 111, 'question_id' => 111, 'score' => 51.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 21.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 314, 'quizze_id' => 112, 'question_id' => 112, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 24.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 314, 'quizze_id' => 113, 'question_id' => 113, 'score' => 67.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 314, 'quizze_id' => 114, 'question_id' => 114, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 314, 'quizze_id' => 115, 'question_id' => 115, 'score' => 64.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 314, 'quizze_id' => 118, 'question_id' => 118, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 315, 'quizze_id' => 109, 'question_id' => 109, 'score' => 78.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 315, 'quizze_id' => 110, 'question_id' => 110, 'score' => 81.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 315, 'quizze_id' => 111, 'question_id' => 111, 'score' => 60.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 315, 'quizze_id' => 112, 'question_id' => 112, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 315, 'quizze_id' => 113, 'question_id' => 113, 'score' => 72.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 315, 'quizze_id' => 114, 'question_id' => 114, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 315, 'quizze_id' => 115, 'question_id' => 115, 'score' => 79.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 315, 'quizze_id' => 118, 'question_id' => 118, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 316, 'quizze_id' => 109, 'question_id' => 109, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 316, 'quizze_id' => 110, 'question_id' => 110, 'score' => 78.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 316, 'quizze_id' => 111, 'question_id' => 111, 'score' => 79.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 316, 'quizze_id' => 112, 'question_id' => 112, 'score' => 65.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 316, 'quizze_id' => 113, 'question_id' => 113, 'score' => 72.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 316, 'quizze_id' => 114, 'question_id' => 114, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 316, 'quizze_id' => 115, 'question_id' => 115, 'score' => 82.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 316, 'quizze_id' => 118, 'question_id' => 118, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 317, 'quizze_id' => 109, 'question_id' => 109, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 317, 'quizze_id' => 110, 'question_id' => 110, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 317, 'quizze_id' => 111, 'question_id' => 111, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 317, 'quizze_id' => 112, 'question_id' => 112, 'score' => 70.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 317, 'quizze_id' => 113, 'question_id' => 113, 'score' => 92.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 317, 'quizze_id' => 114, 'question_id' => 114, 'score' => 99.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 317, 'quizze_id' => 115, 'question_id' => 115, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 317, 'quizze_id' => 118, 'question_id' => 118, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 318, 'quizze_id' => 109, 'question_id' => 109, 'score' => 84.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 318, 'quizze_id' => 110, 'question_id' => 110, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 318, 'quizze_id' => 111, 'question_id' => 111, 'score' => 70.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 318, 'quizze_id' => 112, 'question_id' => 112, 'score' => 59.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 318, 'quizze_id' => 113, 'question_id' => 113, 'score' => 79.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 318, 'quizze_id' => 114, 'question_id' => 114, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 318, 'quizze_id' => 115, 'question_id' => 115, 'score' => 81.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 318, 'quizze_id' => 118, 'question_id' => 118, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 319, 'quizze_id' => 109, 'question_id' => 109, 'score' => 63.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 319, 'quizze_id' => 110, 'question_id' => 110, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 319, 'quizze_id' => 111, 'question_id' => 111, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 20.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 319, 'quizze_id' => 112, 'question_id' => 112, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 319, 'quizze_id' => 113, 'question_id' => 113, 'score' => 60.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 35.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 319, 'quizze_id' => 114, 'question_id' => 114, 'score' => 60.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 26.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 319, 'quizze_id' => 115, 'question_id' => 115, 'score' => 60.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 319, 'quizze_id' => 118, 'question_id' => 118, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 320, 'quizze_id' => 109, 'question_id' => 109, 'score' => 78.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 320, 'quizze_id' => 110, 'question_id' => 110, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 320, 'quizze_id' => 111, 'question_id' => 111, 'score' => 86.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 320, 'quizze_id' => 112, 'question_id' => 112, 'score' => 60.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 320, 'quizze_id' => 113, 'question_id' => 113, 'score' => 70.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 320, 'quizze_id' => 114, 'question_id' => 114, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 320, 'quizze_id' => 115, 'question_id' => 115, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 320, 'quizze_id' => 118, 'question_id' => 118, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 321, 'quizze_id' => 109, 'question_id' => 109, 'score' => 58.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 29.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 321, 'quizze_id' => 110, 'question_id' => 110, 'score' => 60.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 321, 'quizze_id' => 111, 'question_id' => 111, 'score' => 50.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 20.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 321, 'quizze_id' => 112, 'question_id' => 112, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 28.0 | فصل ثاني: 25.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 321, 'quizze_id' => 113, 'question_id' => 113, 'score' => 60.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 31.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 321, 'quizze_id' => 114, 'question_id' => 114, 'score' => 69.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 321, 'quizze_id' => 115, 'question_id' => 115, 'score' => 61.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 321, 'quizze_id' => 118, 'question_id' => 118, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 322, 'quizze_id' => 109, 'question_id' => 109, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 322, 'quizze_id' => 110, 'question_id' => 110, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 322, 'quizze_id' => 111, 'question_id' => 111, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 322, 'quizze_id' => 112, 'question_id' => 112, 'score' => 67.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 322, 'quizze_id' => 113, 'question_id' => 113, 'score' => 93.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 322, 'quizze_id' => 114, 'question_id' => 114, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 322, 'quizze_id' => 115, 'question_id' => 115, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 322, 'quizze_id' => 118, 'question_id' => 118, 'score' => 0.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 0.0 | فصل ثاني: 0.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 323, 'quizze_id' => 109, 'question_id' => 109, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 323, 'quizze_id' => 110, 'question_id' => 110, 'score' => 92.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 323, 'quizze_id' => 111, 'question_id' => 111, 'score' => 84.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 323, 'quizze_id' => 112, 'question_id' => 112, 'score' => 61.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 31.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 323, 'quizze_id' => 113, 'question_id' => 113, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 323, 'quizze_id' => 114, 'question_id' => 114, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 323, 'quizze_id' => 115, 'question_id' => 115, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 324, 'quizze_id' => 109, 'question_id' => 109, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 324, 'quizze_id' => 110, 'question_id' => 110, 'score' => 95.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 324, 'quizze_id' => 111, 'question_id' => 111, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 324, 'quizze_id' => 112, 'question_id' => 112, 'score' => 64.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 324, 'quizze_id' => 113, 'question_id' => 113, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 324, 'quizze_id' => 114, 'question_id' => 114, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 324, 'quizze_id' => 115, 'question_id' => 115, 'score' => 91.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 325, 'quizze_id' => 109, 'question_id' => 109, 'score' => 75.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 325, 'quizze_id' => 110, 'question_id' => 110, 'score' => 86.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 325, 'quizze_id' => 111, 'question_id' => 111, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 325, 'quizze_id' => 112, 'question_id' => 112, 'score' => 55.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 27.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 325, 'quizze_id' => 113, 'question_id' => 113, 'score' => 75.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 36.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 325, 'quizze_id' => 114, 'question_id' => 114, 'score' => 86.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 325, 'quizze_id' => 115, 'question_id' => 115, 'score' => 79.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 326, 'quizze_id' => 109, 'question_id' => 109, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 326, 'quizze_id' => 110, 'question_id' => 110, 'score' => 56.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 22.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 326, 'quizze_id' => 111, 'question_id' => 111, 'score' => 52.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 18.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 326, 'quizze_id' => 112, 'question_id' => 112, 'score' => 56.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 26.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 326, 'quizze_id' => 113, 'question_id' => 113, 'score' => 59.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 326, 'quizze_id' => 114, 'question_id' => 114, 'score' => 53.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 23.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 326, 'quizze_id' => 115, 'question_id' => 115, 'score' => 60.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 33.0 | فصل ثاني: 27.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 327, 'quizze_id' => 109, 'question_id' => 109, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 43.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 327, 'quizze_id' => 110, 'question_id' => 110, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 44.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 327, 'quizze_id' => 111, 'question_id' => 111, 'score' => 74.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 327, 'quizze_id' => 112, 'question_id' => 112, 'score' => 57.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 28.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 327, 'quizze_id' => 113, 'question_id' => 113, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 42.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 327, 'quizze_id' => 114, 'question_id' => 114, 'score' => 91.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 327, 'quizze_id' => 115, 'question_id' => 115, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 40.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 328, 'quizze_id' => 109, 'question_id' => 109, 'score' => 85.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 45.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 328, 'quizze_id' => 110, 'question_id' => 110, 'score' => 78.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 40.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 328, 'quizze_id' => 111, 'question_id' => 111, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 38.0 | فصل ثاني: 30.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 328, 'quizze_id' => 112, 'question_id' => 112, 'score' => 71.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 32.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 328, 'quizze_id' => 113, 'question_id' => 113, 'score' => 80.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 39.0 | فصل ثاني: 41.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 328, 'quizze_id' => 114, 'question_id' => 114, 'score' => 91.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 328, 'quizze_id' => 115, 'question_id' => 115, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 45.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 329, 'quizze_id' => 109, 'question_id' => 109, 'score' => 99.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 329, 'quizze_id' => 110, 'question_id' => 110, 'score' => 98.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 329, 'quizze_id' => 111, 'question_id' => 111, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 329, 'quizze_id' => 112, 'question_id' => 112, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 329, 'quizze_id' => 113, 'question_id' => 113, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 329, 'quizze_id' => 114, 'question_id' => 114, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 329, 'quizze_id' => 115, 'question_id' => 115, 'score' => 96.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 330, 'quizze_id' => 109, 'question_id' => 109, 'score' => 94.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 330, 'quizze_id' => 110, 'question_id' => 110, 'score' => 89.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 46.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 330, 'quizze_id' => 111, 'question_id' => 111, 'score' => 78.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 330, 'quizze_id' => 112, 'question_id' => 112, 'score' => 68.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 330, 'quizze_id' => 113, 'question_id' => 113, 'score' => 91.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 330, 'quizze_id' => 114, 'question_id' => 114, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 330, 'quizze_id' => 115, 'question_id' => 115, 'score' => 88.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 331, 'quizze_id' => 109, 'question_id' => 109, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 331, 'quizze_id' => 110, 'question_id' => 110, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 331, 'quizze_id' => 111, 'question_id' => 111, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 331, 'quizze_id' => 112, 'question_id' => 112, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 331, 'quizze_id' => 113, 'question_id' => 113, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 331, 'quizze_id' => 114, 'question_id' => 114, 'score' => 100.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 50.0 | فصل ثاني: 50.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 331, 'quizze_id' => 115, 'question_id' => 115, 'score' => 96.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 48.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 332, 'quizze_id' => 109, 'question_id' => 109, 'score' => 83.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 46.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 332, 'quizze_id' => 110, 'question_id' => 110, 'score' => 76.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 37.0 | فصل ثاني: 39.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 332, 'quizze_id' => 111, 'question_id' => 111, 'score' => 77.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 34.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 332, 'quizze_id' => 112, 'question_id' => 112, 'score' => 61.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 29.0 | فصل ثاني: 32.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 332, 'quizze_id' => 113, 'question_id' => 113, 'score' => 71.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 34.0 | فصل ثاني: 37.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 332, 'quizze_id' => 114, 'question_id' => 114, 'score' => 97.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 48.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 332, 'quizze_id' => 115, 'question_id' => 115, 'score' => 87.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 333, 'quizze_id' => 109, 'question_id' => 109, 'score' => 91.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 47.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 333, 'quizze_id' => 110, 'question_id' => 110, 'score' => 79.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 41.0 | فصل ثاني: 38.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 333, 'quizze_id' => 111, 'question_id' => 111, 'score' => 77.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 35.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 333, 'quizze_id' => 112, 'question_id' => 112, 'score' => 63.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 30.0 | فصل ثاني: 33.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 333, 'quizze_id' => 113, 'question_id' => 113, 'score' => 90.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 43.0 | فصل ثاني: 47.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 333, 'quizze_id' => 114, 'question_id' => 114, 'score' => 98.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 49.0 | فصل ثاني: 49.0', 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'student_id' => 333, 'quizze_id' => 115, 'question_id' => 115, 'score' => 86.0, 'abuse' => '0', 'date' => date('Y-m-d'), 'note' => 'الثاني العلمي - 2023/2024م | فصل أول: 42.0 | فصل ثاني: 44.0', 'created_at' => now(), 'updated_at' => now(),
        ]);

        // ========================================
        // 8. سندات مالية تجريبية للطباعة (Financial Records)
        // ========================================
        DB::table('receipt_students')->delete();
        DB::table('receipt_students')->insert([
            ['id' => 1, 'date' => date('Y-m-d'), 'student_id' => 1, 'Debit' => 500.00, 'description' => 'سداد الرسوم الدراسية للفصل الأول', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'date' => date('Y-m-d'), 'student_id' => 2, 'Debit' => 300.00, 'description' => 'سداد رسوم النشاط المدرسي', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'date' => date('Y-m-d'), 'student_id' => 3, 'Debit' => 750.00, 'description' => 'سداد الرسوم الدراسية للفصل الثاني', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('processing_fees')->delete();
        DB::table('processing_fees')->insert([
            ['id' => 1, 'date' => date('Y-m-d'), 'student_id' => 1, 'amount' => 150.00, 'description' => 'صرف بدل نقل طلابي', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'date' => date('Y-m-d'), 'student_id' => 2, 'amount' => 200.00, 'description' => 'صرف مكافأة تفوق', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'date' => date('Y-m-d'), 'student_id' => 3, 'amount' => 100.00, 'description' => 'صور مصدقة وكشوف درجات', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('payment_students')->delete();
        DB::table('payment_students')->insert([
            ['id' => 1, 'date' => date('Y-m-d'), 'student_id' => 1, 'amount' => 1000.00, 'description' => 'دفعة الرسوم الدراسية السنوية', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'date' => date('Y-m-d'), 'student_id' => 2, 'amount' => 450.00, 'description' => 'دفعة رسوم الامتحانات', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'date' => date('Y-m-d'), 'student_id' => 3, 'amount' => 600.00, 'description' => 'دفعة الزي المدرسي', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // ========================================
        // 9. ربط المعلم بالأقسام (teacher_section pivot)
        // تعيين جميع الأقسام للمعلم خالد (teacher_id = 1)
        // ========================================
        DB::table('teacher_section')->truncate();
        $teacherSections = [];
        for ($i = 1; $i <= 12; $i++) {
            $teacherSections[] = [
                'teacher_id' => 1,
                'section_id' => $i,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('teacher_section')->insert($teacherSections);

        // ========================================
        // 10. الواجبات (Homework) - بيانات تجريبية
        // ========================================
        DB::table('homeworks')->truncate();
        DB::table('homeworks')->insert([
            [
                'id' => 1,
                'title' => json_encode(['ar' => 'واجب القرآن الكريم - سورة البقرة', 'en' => 'Quran Homework - Surat Al-Baqarah'], JSON_UNESCAPED_UNICODE),
                'description' => json_encode(['ar' => 'حفظ الآيات من 1 إلى 10 من سورة البقرة', 'en' => 'Memorize verses 1-10 from Surat Al-Baqarah'], JSON_UNESCAPED_UNICODE),
                'type' => 'file',
                'file_name' => null,
                'due_date' => date('Y-m-d', strtotime('+7 days')),
                'score' => 20,
                'subject_id' => 1,
                'grade_id' => 1,
                'classroom_id' => 1,
                'section_id' => 1,
                'teacher_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'title' => json_encode(['ar' => 'واجب اللغة العربية - الإعراب', 'en' => 'Arabic Language Homework - Parsing'], JSON_UNESCAPED_UNICODE),
                'description' => json_encode(['ar' => 'أعرب الجمل التالية إعراباً كاملاً', 'en' => 'Parse the following sentences fully'], JSON_UNESCAPED_UNICODE),
                'type' => 'question',
                'file_name' => null,
                'due_date' => date('Y-m-d', strtotime('+5 days')),
                'score' => 10,
                'subject_id' => 3,
                'grade_id' => 2,
                'classroom_id' => 2,
                'section_id' => 2,
                'teacher_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'title' => json_encode(['ar' => 'واجب الرياضيات - الكسور', 'en' => 'Math Homework - Fractions'], JSON_UNESCAPED_UNICODE),
                'description' => json_encode(['ar' => 'حل التمارين من 1 إلى 5 في صفحة 45', 'en' => 'Solve exercises 1-5 on page 45'], JSON_UNESCAPED_UNICODE),
                'type' => 'image',
                'file_name' => null,
                'due_date' => date('Y-m-d', strtotime('+3 days')),
                'score' => 15,
                'subject_id' => 10,
                'grade_id' => 3,
                'classroom_id' => 5,
                'section_id' => 5,
                'teacher_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // أسئلة الواجب رقم 2 (نوع question)
        DB::table('homework_questions')->truncate();
        DB::table('homework_questions')->insert([
            [
                'id' => 1,
                'homework_id' => 2,
                'title' => 'أعرب كلمة (الكتاب) في جملة (قرأت الكتاب)',
                'answers' => 'مفعول به منصوب-فاعل مرفوع-مبتدأ مرفوع',
                'right_answer' => 'مفعول به منصوب',
                'score' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'homework_id' => 2,
                'title' => 'ما نوع كلمة (في) من حيث الجزء من الكلام؟',
                'answers' => 'اسم-فعل-حرف جر',
                'right_answer' => 'حرف جر',
                'score' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // ========================================
        // 11. تقديرات الطلاب (Student Grades) - بيانات تجريبية
        // ========================================
        DB::table('student_grades')->truncate();
        $studentGrades = [];
        // تقديرات لطلاب القسم 1 (المرحلة 1) في المادة 1 (القرآن الكريم) - طلاب 1-12
        for ($i = 1; $i <= 12; $i++) {
            $studentGrades[] = [
                'student_id' => $i,
                'subject_id' => 1,
                'teacher_id' => 1,
                'grade_id' => 1,
                'classroom_id' => 1,
                'section_id' => 1,
                'evaluation_type' => 'score',
                'score' => rand(75, 100),
                'grade_text' => null,
                'term' => 'first',
                'note' => null,
                'date' => date('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        // تقديرات نصية لطلاب القسم 2 (المرحلة 2) في المادة 3 (اللغة العربية) - طلاب 13-20
        for ($i = 13; $i <= 20; $i++) {
            $texts = ['ممتاز', 'جيد جدا', 'جيد', 'مقبول'];
            $studentGrades[] = [
                'student_id' => $i,
                'subject_id' => 3,
                'teacher_id' => 1,
                'grade_id' => 2,
                'classroom_id' => 2,
                'section_id' => 2,
                'evaluation_type' => 'text',
                'score' => null,
                'grade_text' => $texts[array_rand($texts)],
                'term' => 'first',
                'note' => null,
                'date' => date('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        // تقديرات لطلاب القسم 5 (المرحلة 3) في المادة 10 (الرياضيات) - طلاب 106-115
        for ($i = 106; $i <= 115; $i++) {
            $studentGrades[] = [
                'student_id' => $i,
                'subject_id' => 10,
                'teacher_id' => 1,
                'grade_id' => 3,
                'classroom_id' => 5,
                'section_id' => 5,
                'evaluation_type' => 'score',
                'score' => rand(60, 95),
                'grade_text' => null,
                'term' => 'second',
                'note' => null,
                'date' => date('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('student_grades')->insert($studentGrades);

        // ========================================
        // 12. الحضور والغياب (Attendance) - بيانات تجريبية مع subject_id
        // ========================================
        DB::table('attendances')->truncate();
        $attendances = [];
        $attendanceDate = date('Y-m-d');
        // حضور لطلاب القسم 1 في المادة 1 (الطلاب 1-12)
        for ($i = 1; $i <= 12; $i++) {
            $attendances[] = [
                'student_id' => $i,
                'grade_id' => 1,
                'classroom_id' => 1,
                'section_id' => 1,
                'subject_id' => 1,
                'teacher_id' => 1,
                'attendence_date' => $attendanceDate,
                'attendence_status' => rand(0, 10) > 1 ? 1 : 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        // حضور لطلاب القسم 2 في المادة 3 (الطلاب 13-49)
        for ($i = 13; $i <= 49; $i++) {
            $attendances[] = [
                'student_id' => $i,
                'grade_id' => 2,
                'classroom_id' => 2,
                'section_id' => 2,
                'subject_id' => 3,
                'teacher_id' => 1,
                'attendence_date' => $attendanceDate,
                'attendence_status' => rand(0, 10) > 1 ? 1 : 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        // حضور لطلاب القسم 5 في المادة 10 (الطلاب 106-138) (تاريخ سابق للسماح بالبحث)
        $pastDate = date('Y-m-d', strtotime('-5 days'));
        for ($i = 106; $i <= 138; $i++) {
            $attendances[] = [
                'student_id' => $i,
                'grade_id' => 3,
                'classroom_id' => 5,
                'section_id' => 5,
                'subject_id' => 10,
                'teacher_id' => 1,
                'attendence_date' => $pastDate,
                'attendence_status' => rand(0, 10) > 1 ? 1 : 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('attendances')->insert($attendances);

        // إعادة تفعيل فحص المفاتيح الأجنبية
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        $this->command->info('تم استيراد بيانات المدرسة بنجاح!');
        $this->command->info('الطلاب: 333');
        $this->command->info('المواد: 118');
        $this->command->info('الدرجات: 2248');
        $this->command->info('السندات المالية: 3 إيصالات + 3 سندات صرف + 3 دفعات');
    }
}