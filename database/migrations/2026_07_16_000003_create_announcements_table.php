<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * جدول لوحة الإعلانات المركزية
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('body');
            // الجمهور المستهدف: admin, teachers, students, parents, all
            $table->enum('target_audience', ['admin', 'teachers', 'students', 'parents', 'all'])->default('all');
            // تاريخ النشر
            $table->timestamp('publish_at')->nullable();
            // هل تم النشر
            $table->boolean('is_published')->default(false);
            // مرفق الملف
            $table->string('attachment')->nullable();
            // منشئ الإعلان
            $table->foreignId('created_by')->references('id')->on('users')->onDelete('cascade');
            // نوع المنشئ (admin / teacher)
            $table->string('creator_type')->default('admin');
            $table->timestamps();

            // فهارس
            $table->index('target_audience');
            $table->index('is_published');
            $table->index('publish_at');
        });
    }

    /**
     * التراجع عن الترحيلات.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('announcements');
    }
};
