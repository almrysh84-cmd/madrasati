<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * نظام الاختبارات الإلكترونية المتقدم.
 *
 * يضيف:
 * 1. تحديث جدول quizzes بإعدادات متقدمة
 * 2. تحديث جدول questions بـ 5 أنواع + دعم صور/صوت
 * 3. جدول quiz_attempts (محاولات الطالب)
 * 4. جدول quiz_answers (إجابات كل سؤال)
 */
return new class extends Migration
{
    public function up()
    {
        // 1. تحديث جدول quizzes بإعدادات متقدمة
        if (Schema::hasTable('quizzes')) {
            Schema::table('quizzes', function (Blueprint $table) {
                if (!Schema::hasColumn('quizzes', 'duration_minutes')) {
                    $table->integer('duration_minutes')->nullable()->after('teacher_id');
                }
                if (!Schema::hasColumn('quizzes', 'passing_score')) {
                    $table->decimal('passing_score', 5, 2)->default(50)->after('duration_minutes');
                }
                if (!Schema::hasColumn('quizzes', 'max_attempts')) {
                    $table->integer('max_attempts')->default(1)->after('passing_score');
                }
                if (!Schema::hasColumn('quizzes', 'shuffle_questions')) {
                    $table->boolean('shuffle_questions')->default(false)->after('max_attempts');
                }
                if (!Schema::hasColumn('quizzes', 'shuffle_options')) {
                    $table->boolean('shuffle_options')->default(false)->after('shuffle_questions');
                }
                if (!Schema::hasColumn('quizzes', 'show_results_immediately')) {
                    $table->boolean('show_results_immediately')->default(true)->after('shuffle_options');
                }
                if (!Schema::hasColumn('quizzes', 'anti_cheat')) {
                    $table->boolean('anti_cheat')->default(false)->after('show_results_immediately');
                }
                if (!Schema::hasColumn('quizzes', 'available_from')) {
                    $table->timestamp('available_from')->nullable()->after('anti_cheat');
                }
                if (!Schema::hasColumn('quizzes', 'available_to')) {
                    $table->timestamp('available_to')->nullable()->after('available_from');
                }
                if (!Schema::hasColumn('quizzes', 'term')) {
                    $table->tinyInteger('term')->default(1)->after('available_to');
                }
            });
        }

        // 2. تحديث جدول questions بـ 5 أنواع + دعم JSON للخيارات
        if (Schema::hasTable('questions')) {
            Schema::table('questions', function (Blueprint $table) {
                if (!Schema::hasColumn('questions', 'question_type')) {
                    $table->enum('question_type', [
                        'mcq_single',    // اختيار واحد
                        'mcq_multiple',  // اختيار متعدد
                        'true_false',    // صح/خطأ
                        'essay',         // مقالي
                        'fill_blank',    // أكمل الفراغ
                    ])->default('mcq_single')->after('title');
                }
                if (!Schema::hasColumn('questions', 'options_json')) {
                    $table->json('options_json')->nullable()->after('answers');
                }
                if (!Schema::hasColumn('questions', 'correct_answers_json')) {
                    $table->json('correct_answers_json')->nullable()->after('right_answer');
                }
                if (!Schema::hasColumn('questions', 'explanation')) {
                    $table->text('explanation')->nullable()->after('correct_answers_json');
                }
                if (!Schema::hasColumn('questions', 'media_path')) {
                    $table->string('media_path')->nullable()->after('explanation');
                }
                if (!Schema::hasColumn('questions', 'media_type')) {
                    $table->enum('media_type', ['none', 'image', 'audio', 'video'])->default('none')->after('media_path');
                }
                if (!Schema::hasColumn('questions', 'difficulty')) {
                    $table->enum('difficulty', ['easy', 'medium', 'hard'])->default('medium')->after('media_type');
                }
            });
        }

        // 3. جدول quiz_attempts (محاولات الطالب)
        if (!Schema::hasTable('quiz_attempts')) {
            Schema::create('quiz_attempts', function (Blueprint $table) {
                $table->id();
                $table->foreignId('quiz_id')->constrained('quizzes')->onDelete('cascade');
                $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
                $table->timestamp('started_at');
                $table->timestamp('submitted_at')->nullable();
                $table->integer('duration_seconds')->nullable();
                $table->decimal('score', 5, 2)->default(0);
                $table->decimal('max_score', 5, 2)->default(0);
                $table->decimal('percentage', 5, 2)->default(0);
                $table->enum('status', ['in_progress', 'submitted', 'graded', 'expired'])->default('in_progress');
                $table->boolean('passed')->default(false);
                $table->integer('attempt_number')->default(1);
                $table->json('meta')->nullable(); // معلومات إضافية (IP, browser, tab switches)
                $table->integer('tab_switches')->default(0); // مضاد الغش
                $table->timestamps();

                $table->index(['quiz_id', 'student_id']);
                $table->index('status');
            });
        }

        // 4. جدول quiz_answers (إجابات كل سؤال في المحاولة)
        if (!Schema::hasTable('quiz_answers')) {
            Schema::create('quiz_answers', function (Blueprint $table) {
                $table->id();
                $table->foreignId('quiz_attempt_id')->constrained('quiz_attempts')->onDelete('cascade');
                $table->foreignId('question_id')->constrained('questions')->onDelete('cascade');
                $table->json('student_answer')->nullable(); // الإجابة المُختارة
                $table->boolean('is_correct')->nullable();
                $table->decimal('score_awarded', 5, 2)->default(0);
                $table->text('teacher_feedback')->nullable(); // للأسئلة المقالية
                $table->timestamp('answered_at')->nullable();
                $table->timestamps();

                $table->index(['quiz_attempt_id', 'question_id']);
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('quiz_answers');
        Schema::dropIfExists('quiz_attempts');

        // لا نحذف الأعمدة المُضافة لـ quizzes و questions (للحفاظ على البيانات)
    }
};
