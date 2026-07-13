<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\My_Parent;
use App\Models\Section;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // ===== Base reference data seeders =====
        $this->call(BloodTableSeeder::class);
        $this->call(NationalitiesTableSeeder::class);
        $this->call(ReligionTableSeeder::class);
        $this->call(SpecializationTableSeeder::class);
        $this->call(GenderTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(SettingsTableSeeder::class);

        // ===== Create a default parent (needed as FK for students) =====
        // ملاحظة: هذا ولي أمر افتراضي فقط للـ seeders. الـ migration
        // 2026_07_16_000030_create_real_parents_for_students.php ينشئ أولياء أمور
        // حقيقيين لكل عائلة بعد إضافة الطلاب.
        DB::table('my__parents')->delete();
        My_Parent::create([
            'email' => 'my@example.com',
            'password' => Hash::make('12345678'),
            'Name_Father' => ['en' => "Osama", 'ar' => "أسامة"],
            'National_ID_Father' => '1234567890',
            'Passport_ID_Father' => '1234567890',
            'Phone_Father' => '1234567890',
            'Job_Father' => ['en' => "mozef", 'ar' => "موظف"],
            'Nationality_Father_id' => '1',
            'Blood_Type_Father_id' => '1',
            'Religion_Father_id' => '1',
            'Address_Father' => '21 ithad street monib',
            'Name_Mother' => ['en' => "Salwa", 'ar' => "سلوى"],
            'National_ID_Mother' => '1234567890',
            'Passport_ID_Mother' => '1234567890',
            'Phone_Mother' => '1234567890',
            'Job_Mother' => ['en' => "mozef", 'ar' => "موظفة"],
            'Nationality_Mother_id' => '1',
            'Blood_Type_Mother_id' => '1',
            'Religion_Mother_id' => '1',
            'Address_Mother' => '21 ithad street monib'
        ]);

        // ===== Create a default teacher (needed as FK for subjects/quizzes) =====
        DB::table('teachers')->delete();
        Teacher::create([
            'email' => 'khaled@example.com',
            'password' => Hash::make('12345678'),
            'name' => ['en' => "Khaled", 'ar' => "خالد"],
            'gender_id' => '1',
            'Specialization_id' => '1',
            'Joining_Date' => '2022-10-17',
            'Address' => '21 ithad street monib',
        ]);

        // ===== Import real school data =====
        // SchoolDataSeeder populates: grades, classrooms, sections, subjects,
        // quizzes, questions, students, and degrees with real school data
        $this->call(SchoolDataSeeder::class);

        // ===== New Features seeders (Question Bank + Announcements) =====
        $this->call(NewFeaturesSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
