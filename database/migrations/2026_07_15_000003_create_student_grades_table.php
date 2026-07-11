<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * تقديرات الطلاب - Student academic evaluations/grades per subject
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreignId('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreignId('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
            $table->foreignId('grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->foreignId('classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
            $table->foreignId('section_id')->references('id')->on('sections')->onDelete('cascade');
            // نوع التقدير: ميزة درجات (score-based) أو تقدير نصي (text-based evaluation)
            $table->enum('evaluation_type', ['score', 'text'])->default('score');
            $table->float('score')->nullable();             // numeric grade (for score type)
            $table->string('grade_text')->nullable();        // تقدير نصي: ممتاز / جيد جدا / جيد / مقبول / ضعيف
            $table->string('term')->nullable();              // الفصل الدراسي
            $table->text('note')->nullable();                // ملاحظات
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_grades');
    }
};
