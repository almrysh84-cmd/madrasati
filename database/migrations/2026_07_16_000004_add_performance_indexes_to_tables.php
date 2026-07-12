<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

/**
 * إضافة فهارس قاعدة البيانات لتحسين الأداء (Feature 6)
 *
 * تضيف فهارس على الأعمدة المستخدمة بشكل متكرر في where() و join()
 * الأعمدة المرتبطة بـ foreign key لديها فهارس تلقائية، لذا نركز على:
 * - الأعمدة غير المرتبطة (status, dates, enums)
 * - الفهارس المركبة للاستعلامات الشائعة
 *
 * ملاحظة: يتم التحقق من وجود الفهرس قبل إنشائه (idempotent)
 * لتفادي التعارض مع فهارس موجودة مسبقاً في:
 * - Spatie Activity Log (log_name, causer_id)
 * - question_bank (subject_id+grade_id, type+level, is_shared)
 * - announcements (target_audience, is_published, publish_at)
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
        $this->addIndexIfNotExists('attendances', 'attendances_status_index', ['attendence_status']);
        $this->addIndexIfNotExists('attendances', 'attendances_date_index', ['attendence_date']);
        // فهرس مركب: المعلم + التاريخ (شائع جداً في استعلامات الحضور اليومي)
        $this->addIndexIfNotExists('attendances', 'attendances_teacher_date_index', ['teacher_id', 'attendence_date']);
        // فهرس مركب: القسم + التاريخ (تقرير الحضور حسب القسم)
        $this->addIndexIfNotExists('attendances', 'attendances_section_date_index', ['section_id', 'attendence_date']);

        // ===== fee_invoices: فهرس على الحالة =====
        $this->addIndexIfNotExists('fee_invoices', 'fee_invoices_status_index', ['status']);
        // فهرس مركب: الطالب + الحالة (عرض فواتير الطالب حسب الحالة)
        $this->addIndexIfNotExists('fee_invoices', 'fee_invoices_student_status_index', ['student_id', 'status']);

        // ===== student_accounts: فهرس على النوع =====
        $this->addIndexIfNotExists('student_accounts', 'student_accounts_type_index', ['type']);
        $this->addIndexIfNotExists('student_accounts', 'student_accounts_date_index', ['date']);
        // فهرس مركب: الطالب + النوع (كشف حساب الطالب حسب نوع العملية)
        $this->addIndexIfNotExists('student_accounts', 'student_accounts_student_type_index', ['student_id', 'type']);

        // ===== receipt_students: فهرس على التاريخ =====
        $this->addIndexIfNotExists('receipt_students', 'receipt_students_date_index', ['date']);

        // ===== student_grades: فهارس على نوع التقدير والفصل =====
        $this->addIndexIfNotExists('student_grades', 'student_grades_eval_type_index', ['evaluation_type']);
        $this->addIndexIfNotExists('student_grades', 'student_grades_term_index', ['term']);
        // فهرس مركب: الطالب + المادة (استعلام درجات الطالب في مادة معينة)
        $this->addIndexIfNotExists('student_grades', 'student_grades_student_subject_index', ['student_id', 'subject_id']);
        // فهرس مركب: المادة + نوع التقدير (تصنيف الدرجات حسب النوع)
        $this->addIndexIfNotExists('student_grades', 'student_grades_subject_eval_index', ['subject_id', 'evaluation_type']);

        // ===== degrees (quizze results): فهرس على التاريخ =====
        $this->addIndexIfNotExists('degrees', 'degrees_date_index', ['date']);
        // فهرس مركب: الطالب + الاختبار (نتيجة طالب في اختبار محدد)
        $this->addIndexIfNotExists('degrees', 'degrees_student_quiz_index', ['student_id', 'quizze_id']);

        // ===== promotions: فهرس على السنة الدراسية =====
        $this->addIndexIfNotExists('promotions', 'promotions_academic_year_index', ['academic_year']);

        // ===== quizzes: فهرس مركب على المعلم + المادة (استعلامات المعلم) =====
        $this->addIndexIfNotExists('quizzes', 'quizzes_teacher_subject_index', ['teacher_id', 'subject_id']);
        $this->addIndexIfNotExists('quizzes', 'quizzes_grade_classroom_index', ['grade_id', 'classroom_id']);

        // ===== homeworks: فهرس مركب على المعلم + المادة =====
        $this->addIndexIfNotExists('homeworks', 'homeworks_teacher_subject_index', ['teacher_id', 'subject_id']);
        $this->addIndexIfNotExists('homeworks', 'homeworks_due_date_index', ['due_date']);

        // ===== activity_log: فهارس لتحسين استعلامات سجل النشاط =====
        // ملاحظة: log_name و causer_id لديهما فهارس من Spatie مسبقاً
        // نضيف فقط فهارس event و created_at الجديدة
        $this->addIndexIfNotExists('activity_log', 'activity_log_event_index', ['event']);
        $this->addIndexIfNotExists('activity_log', 'activity_log_created_at_index', ['created_at']);

        // ===== question_bank: فهارس للبحث السريع =====
        // ملاحظة: الجدول ينشئ فهارس تلقائية على (subject_id+grade_id), (type+level), is_shared
        // لكن بأسماء تلقائية مختلفة، نضيف فهارسنا المسماة إذا لم تكن موجودة
        $this->addIndexIfNotExists('question_bank', 'question_bank_subject_grade_index', ['subject_id', 'grade_id']);
        $this->addIndexIfNotExists('question_bank', 'question_bank_type_level_index', ['type', 'level']);
        $this->addIndexIfNotExists('question_bank', 'question_bank_is_shared_index', ['is_shared']);

        // ===== announcements: فهارس للنشر والعرض =====
        // ملاحظة: الجدول ينشئ فهارس على target_audience, is_published, publish_at منفردة
        // نضيف فهرس مركب على is_published + publish_at
        $this->addIndexIfNotExists('announcements', 'announcements_published_publish_index', ['is_published', 'publish_at']);
    }

    /**
     * إضافة فهرس فقط إذا لم يكن موجوداً مسبقاً
     * يتجنب التعارض مع فهارس موجودة في جداول أخرى
     *
     * @param string $table اسم الجدول
     * @param string $indexName اسم الفهرس
     * @param array $columns الأعمدة
     */
    private function addIndexIfNotExists($table, $indexName, $columns)
    {
        $connection = Schema::getConnection();
        $driver = $connection->getDriverName();

        $indexExists = false;

        if ($driver === 'sqlite') {
            // في SQLite، نتحقق من جدول sqlite_master
            $indexes = DB::select("SELECT name FROM sqlite_master WHERE type='index' AND tbl_name=?", [$table]);
            $indexExists = collect($indexes)->contains('name', $indexName);
        } else {
            // في MySQL، نتحقق من information_schema
            $database = $connection->getDatabaseName();
            $indexes = DB::select(
                "SELECT index_name FROM information_schema.statistics WHERE table_schema = ? AND table_name = ? AND index_name = ?",
                [$database, $table, $indexName]
            );
            $indexExists = count($indexes) > 0;
        }

        if (!$indexExists) {
            Schema::table($table, function (Blueprint $blueprint) use ($columns, $indexName) {
                $blueprint->index($columns, $indexName);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        $this->dropIndexIfExists('attendances', 'attendances_status_index');
        $this->dropIndexIfExists('attendances', 'attendances_date_index');
        $this->dropIndexIfExists('attendances', 'attendances_teacher_date_index');
        $this->dropIndexIfExists('attendances', 'attendances_section_date_index');

        $this->dropIndexIfExists('fee_invoices', 'fee_invoices_status_index');
        $this->dropIndexIfExists('fee_invoices', 'fee_invoices_student_status_index');

        $this->dropIndexIfExists('student_accounts', 'student_accounts_type_index');
        $this->dropIndexIfExists('student_accounts', 'student_accounts_date_index');
        $this->dropIndexIfExists('student_accounts', 'student_accounts_student_type_index');

        $this->dropIndexIfExists('receipt_students', 'receipt_students_date_index');

        $this->dropIndexIfExists('student_grades', 'student_grades_eval_type_index');
        $this->dropIndexIfExists('student_grades', 'student_grades_term_index');
        $this->dropIndexIfExists('student_grades', 'student_grades_student_subject_index');
        $this->dropIndexIfExists('student_grades', 'student_grades_subject_eval_index');

        $this->dropIndexIfExists('degrees', 'degrees_date_index');
        $this->dropIndexIfExists('degrees', 'degrees_student_quiz_index');

        $this->dropIndexIfExists('promotions', 'promotions_academic_year_index');

        $this->dropIndexIfExists('quizzes', 'quizzes_teacher_subject_index');
        $this->dropIndexIfExists('quizzes', 'quizzes_grade_classroom_index');

        $this->dropIndexIfExists('homeworks', 'homeworks_teacher_subject_index');
        $this->dropIndexIfExists('homeworks', 'homeworks_due_date_index');

        // نشاط السجل: فقط فهارس event و created_at التي أضفناها نحن
        $this->dropIndexIfExists('activity_log', 'activity_log_event_index');
        $this->dropIndexIfExists('activity_log', 'activity_log_created_at_index');

        $this->dropIndexIfExists('question_bank', 'question_bank_subject_grade_index');
        $this->dropIndexIfExists('question_bank', 'question_bank_type_level_index');
        $this->dropIndexIfExists('question_bank', 'question_bank_is_shared_index');

        $this->dropIndexIfExists('announcements', 'announcements_published_publish_index');
    }

    /**
     * حذف الفهرس فقط إذا كان موجوداً
     *
     * @param string $table اسم الجدول
     * @param string $indexName اسم الفهرس
     */
    private function dropIndexIfExists($table, $indexName)
    {
        $connection = Schema::getConnection();
        $driver = $connection->getDriverName();

        $indexExists = false;

        if ($driver === 'sqlite') {
            $indexes = DB::select("SELECT name FROM sqlite_master WHERE type='index' AND tbl_name=?", [$table]);
            $indexExists = collect($indexes)->contains('name', $indexName);
        } else {
            $database = $connection->getDatabaseName();
            $indexes = DB::select(
                "SELECT index_name FROM information_schema.statistics WHERE table_schema = ? AND table_name = ? AND index_name = ?",
                [$database, $table, $indexName]
            );
            $indexExists = count($indexes) > 0;
        }

        if ($indexExists) {
            Schema::table($table, function (Blueprint $blueprint) use ($indexName) {
                $blueprint->dropIndex($indexName);
            });
        }
    }
}
