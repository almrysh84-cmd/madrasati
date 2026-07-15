<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * المكتبة الرقمية — جدول digital_resources
 */
return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('digital_resources')) {
            Schema::create('digital_resources', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('description')->nullable();
                $table->enum('type', ['book', 'video', 'pdf', 'exam_paper', 'curriculum', 'other'])->default('pdf');
                $table->foreignId('subject_id')->nullable()->constrained('subjects')->onDelete('set null');
                $table->foreignId('grade_id')->nullable()->constrained('grades')->onDelete('set null');
                $table->foreignId('classroom_id')->nullable()->constrained('classrooms')->onDelete('set null');
                $table->foreignId('uploaded_by')->constrained('users')->onDelete('cascade');
                $table->enum('visibility', ['all', 'teachers', 'students', 'parents'])->default('all');
                $table->string('file_path')->nullable(); // for non-media-library files
                $table->bigInteger('file_size')->nullable();
                $table->string('mime_type')->nullable();
                $table->integer('download_count')->default(0);
                $table->json('tags')->nullable();
                $table->timestamps();
                $table->softDeletes();

                $table->index(['type', 'visibility']);
                $table->index(['subject_id', 'grade_id']);
            });
        }

        // إضافة media columns لـ Spatie MediaLibrary (إذا لم تكن موجودة)
        if (!Schema::hasTable('media')) {
            Schema::create('media', function (Blueprint $table) {
                $table->id();
                $table->morphs('model');
                $table->uuid('uuid')->nullable()->unique();
                $table->string('collection_name');
                $table->string('name');
                $table->string('file_name');
                $table->string('mime_type')->index();
                $table->string('disk');
                $table->string('conversions_disk')->nullable();
                $table->unsignedBigInteger('size');
                $table->json('manipulations');
                $table->json('custom_properties');
                $table->json('generated_conversions');
                $table->json('responsive_images');
                $table->unsignedInteger('order_column')->nullable()->index();
                $table->nullableTimestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('digital_resources');
        // لا نحذف media table لأنها قد تُستخدم بواسطة موديلات أخرى
    }
};
