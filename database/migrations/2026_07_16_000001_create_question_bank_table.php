<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_bank', function (Blueprint $table) {
            $table->id();
            // نص السؤال (يدعم اللغتين العربية والإنجليزية عبر JSON)
            $table->text('question');
            // نوع السؤال: mcq (اختيار من متعدد), true_false (صح/خطأ), essay (مقالي)
            $table->enum('type', ['mcq', 'true_false', 'essay'])->default('mcq');
            // خيارات الإجابة (JSON) - للاختيار من متعدد: ["خيار1","خيار2","خيار3","خيار4"]
            $table->json('options')->nullable();
            // الإجابة الصحيحة (للاختيار من متعدد: index, لصح/خطأ: 1 أو 0, للمقالي: null)
            $table->string('correct_answer')->nullable();
            // مستوى الصعوبة: easy, medium, hard
            $table->enum('level', ['easy', 'medium', 'hard'])->default('medium');
            // الدرجة المعتمدة للسؤال
            $table->float('score')->default(1);
            // العلاقات المرجعية
            $table->foreignId('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreignId('grade_id')->references('id')->on('grades')->onDelete('cascade');
            // المعلم الذي أنشأ السؤال
            $table->foreignId('created_by')->references('id')->on('teachers')->onDelete('cascade');
            // هل السؤال مشترك (متاح لجميع المعلمين)
            $table->boolean('is_shared')->default(true);
            $table->timestamps();

            // فهارس لتحسين أداء الاستعلامات
            $table->index(['subject_id', 'grade_id']);
            $table->index(['type', 'level']);
            $table->index('is_shared');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_bank');
    }
};
