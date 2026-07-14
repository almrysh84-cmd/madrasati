<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Student;
use App\Models\Grade;
use App\Models\Classroom;
use App\Models\Section;

class StudentManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_create_student()
    {
        $grade = Grade::create(['Name' => json_encode(['ar' => 'الصف الأول', 'en' => 'Grade 1'])]);
        $classroom = Classroom::create([
            'Name_Class' => json_encode(['ar' => 'الأول', 'en' => 'First']),
            'Grade_id' => $grade->id,
        ]);
        $section = Section::create([
            'Name_Section' => json_encode(['ar' => 'أ', 'en' => 'A']),
            'Grade_id' => $grade->id,
            'Class_id' => $classroom->id,
            'Status' => 1,
        ]);

        $student = Student::create([
            'name' => json_encode(['ar' => 'طالب تجريبي', 'en' => 'Test Student']),
            'email' => 'test@student.com',
            'password' => bcrypt('password'),
            'gender_id' => 1,
            'nationalitie_id' => 1,
            'blood_id' => 1,
            'Date_Birth' => '2010-01-01',
            'Grade_id' => $grade->id,
            'Classroom_id' => $classroom->id,
            'section_id' => $section->id,
            'academic_year' => '2024/2025',
        ]);

        $this->assertDatabaseHas('students', ['email' => 'test@student.com']);
    }

    /** @test */
    public function student_fillable_prevents_mass_assignment()
    {
        $student = new Student();
        $this->assertNotContains('is_admin', $student->getFillable());
    }
}
