<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * إضافة فهارس قاعدة البيانات لتحسين الأداء (Feature 6)
 *
 * تضيف فهارس على الأعمدة المستخدمة بشكل متكرر في where() و join()
 * الأعمدة المرتبطة بـ foreign key لديها فهارس تلقائية، لذا نركز على:
 * - الأعمدة غير المرتبطة (status, dates, enums)
 * - الفهارس المركبة للاستعلامات الشائعة
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class AddPerformanceIndexesToTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // ===== attendances: فهارس على الحالة والتاريخ =====
        Schema::table('attendances', function (Blueprint $table) {
            $table->index('attendence_status', 'attendances_status_index');
            $table->index('attendence_date', 'attendances_date_index');
            // فهرس مركب: المعلم + التاريخ (شائع جداً في استعلامات الحضور اليومي)
            $table->index(['teacher_id', 'attendence_date'], 'attendances_teacher_date_index');
            // فهرس مركب: القسم + التاريخ (تقرير الحضور حسب القسم)
            $table->index(['section_id', 'attendence_date'], 'attendances_section_date_index');
        });

        // ===== fee_invoices: فهرس على الحالة =====
        Schema::table('fee_invoices', function (Blueprint $table) {
            $table->index('status', 'fee_invoices_status_index');
            // فهرس مركب: الطالب + الحالة (عرض فواتير الطالب حسب الحالة)
            $table->index(['student_id', 'status'], 'fee_invoices_student_status_index');
        });

        // ===== student_accounts: فهرس على النوع =====
        Schema::table('student_accounts', function (Blueprint $table) {
            $table->index('type', 'student_accounts_type_index');
            $table->index('date', 'student_accounts_date_index');
            // فهرس مركب: الطالب + النوع (كشف حساب الطالب حسب نوع العملية)
            $table->index(['student_id', 'type'], 'student_accounts_student_type_index');
        });

        // ===== receipt_students: فهرس على التاريخ =====
        Schema::table('receipt_students', function (Blueprint $table) {
            $table->index('date', 'receipt_students_date_index');
        });

        // ===== student_grades: فهارس على نوع التقدير والفصل =====
        Schema::table('student_grades', function (Blueprint $table) {
            $table->index('evaluation_type', 'student_grades_eval_type_index');
            $table->index('term', 'student_grades_term_index');
            // فهرس مركب: الطالب + المادة (استعلام درجات الطالب في مادة معينة)
            $table->index(['student_id', 'subject_id'], 'student_grades_student_subject_index');
            // فهرس مركب: المادة + نوع التقدير (تصنيف الدرجات حسب النوع)
            $table->index(['subject_id', 'evaluation_type'], 'student_grades_subject_eval_index');
        });

        // ===== degrees (quizze results): فهرس على التاريخ =====
        Schema::table('degrees', function (Blueprint $table) {
            $table->index('date', 'degrees_date_index');
            // فهرس مركب: الطالب + الاختبار (نتيجة طالب في اختبار محدد)
            $table->index(['student_id', 'quizze_id'], 'degrees_student_quiz_index');
        });

        // ===== promotions: فهرس على السنة الدراسية =====
        Schema::table('promotions', function (Blueprint $table) {
            $table->index('academic_year', 'promotions_academic_year_index');
        });

        // ===== quizzes: فهرس مركب على المعلم + المادة (استعلامات المعلم) =====
        Schema::table('quizzes', function (Blueprint $table) {
            $table->index(['teacher_id', 'subject_id'], 'quizzes_teacher_subject_index');
            $table->index(['grade_id', 'classroom_id'], 'quizzes_grade_classroom_index');
        });

        // ===== homeworks: فهرس مركب على المعلم + المادة =====
        Schema::table('homeworks', function (Blueprint $table) {
            $table->index(['teacher_id', 'subject_id'], 'homeworks_teacher_subject_index');
            $table->index('due_date', 'homeworks_due_date_index');
        });

        // ===== activity_log: فهارس لتحسين استعلامات سجل النشاط =====
        Schema::table('activity_log', function (Blueprint $table) {
            $table->index('log_name', 'activity_log_log_name_index');
            $table->index('causer_id', 'activity_log_causer_id_index');
            $table->index('event', 'activity_log_event_index');
            $table->index('created_at', 'activity_log_created_at_index');
        });

        // ===== question_bank: فهارس للبحث السريع =====
        Schema::table('question_bank', function (Blueprint $table) {
            $table->index(['subject_id', 'grade_id'], 'question_bank_subject_grade_index');
            $table->index(['type', 'level'], 'question_bank_type_level_index');
            $table->index('is_shared', 'question_bank_is_shared_index');
        });

        // ===== announcements: فهارس للنشر والعرض =====
        Schema::table('announcements', function (Blueprint $table) {
            $table->index(['is_published', 'publish_at'], 'announcements_published_publish_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropIndex('attendances_status_index');
            $table->dropIndex('attendances_date_index');
            $table->dropIndex('attendances_teacher_date_index');
            $table->dropIndex('attendances_section_date_index');
        });

        Schema::table('fee_invoices', function (Blueprint $table) {
            $table->dropIndex('fee_invoices_status_index');
            $table->dropIndex('fee_invoices_student_status_index');
        });

        Schema::table('student_accounts', function (Blueprint $table) {
            $table->dropIndex('student_accounts_type_index');
            $table->dropIndex('student_accounts_date_index');
            $table->dropIndex('student_accounts_student_type_index');
        });

        Schema::table('receipt_students', function (Blueprint $table) {
            $table->dropIndex('receipt_students_date_index');
        });

        Schema::table('student_grades', function (Blueprint $table) {
            $table->dropIndex('student_grades_eval_type_index');
            $table->dropIndex('student_grades_term_index');
            $table->dropIndex('student_grades_student_subject_index');
            $table->dropIndex('student_grades_subject_eval_index');
        });

        Schema::table('degrees', function (Blueprint $table) {
            $table->dropIndex('degrees_date_index');
            $table->dropIndex('degrees_student_quiz_index');
        });

        Schema::table('promotions', function (Blueprint $table) {
            $table->dropIndex('promotions_academic_year_index');
        });

        Schema::table('quizzes', function (Blueprint $table) {
            $table->dropIndex('quizzes_teacher_subject_index');
            $table->dropIndex('quizzes_grade_classroom_index');
        });

        Schema::table('homeworks', function (Blueprint $table) {
            $table->dropIndex('homeworks_teacher_subject_index');
            $table->dropIndex('homeworks_due_date_index');
        });

        Schema::table('activity_log', function (Blueprint $table) {
            $table->dropIndex('activity_log_log_name_index');
            $table->dropIndex('activity_log_causer_id_index');
            $table->dropIndex('activity_log_event_index');
            $table->dropIndex('activity_log_created_at_index');
        });

        Schema::table('question_bank', function (Blueprint $table) {
            $table->dropIndex('question_bank_subject_grade_index');
            $table->dropIndex('question_bank_type_level_index');
            $table->dropIndex('question_bank_is_shared_index');
        });

        Schema::table('announcements', function (Blueprint $table) {
            $table->dropIndex('announcements_published_publish_index');
        });
    }
}
