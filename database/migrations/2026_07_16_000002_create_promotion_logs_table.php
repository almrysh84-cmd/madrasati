<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * تشغيل الترحيلات.
     *
     * جدول سجلات الترقية التلقائية - يسجل كل عملية ترقية تلقائية مع التفاصيل
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotion_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreignId('from_grade')->references('id')->on('grades')->onDelete('cascade');
            $table->foreignId('to_grade')->references('id')->on('grades')->onDelete('cascade');
            $table->foreignId('from_classroom')->references('id')->on('classrooms')->onDelete('cascade');
            $table->foreignId('to_classroom')->references('id')->on('classrooms')->onDelete('cascade');
            $table->foreignId('from_section')->references('id')->on('sections')->onDelete('cascade');
            $table->foreignId('to_section')->references('id')->on('sections')->onDelete('cascade');
            $table->string('academic_year');
            $table->string('academic_year_new');
            // المتوسط العام للطالب
            $table->float('overall_average')->default(0);
            // عدد المواد الراسبة
            $table->integer('failed_subjects_count')->default(0);
            // حالة الترقية: pending (بانتظار المراجعة), approved (موافق عليه), rejected (مرفوض)
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            // معرف المشرف الذي قام بالموافقة/الرفض
            $table->foreignId('reviewed_by')->nullable()->references('id')->on('users')->onDelete('set null');
            $table->timestamp('reviewed_at')->nullable();
            $table->text('review_note')->nullable();
            $table->foreignId('triggered_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();

            // فهارس لتحسين أداء الاستعلامات
            $table->index(['status', 'academic_year']);
            $table->index('student_id');
            $table->index('from_grade');
        });
    }

    /**
     * التراجع عن الترحيلات.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotion_logs');
    }
};
