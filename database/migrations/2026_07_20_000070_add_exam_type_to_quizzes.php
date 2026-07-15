<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * إضافة نوع الاختبار (exam_type) لجدول quizzes.
 * الأنواع: monthly (شهري), compensatory (تعويضي), activities (أنشطة)
 */
return new class extends Migration
{
    public function up()
    {
        if (Schema::hasTable('quizzes') && !Schema::hasColumn('quizzes', 'exam_type')) {
            Schema::table('quizzes', function (Blueprint $table) {
                $table->enum('exam_type', ['monthly', 'compensatory', 'activities'])
                    ->default('monthly')
                    ->after('section_id');
            });
        }
    }

    public function down()
    {
        if (Schema::hasTable('quizzes') && Schema::hasColumn('quizzes', 'exam_type')) {
            Schema::table('quizzes', function (Blueprint $table) {
                $table->dropColumn('exam_type');
            });
        }
    }
};
