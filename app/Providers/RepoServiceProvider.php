<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repository\TeacherRepositoryInterface',
            'App\Repository\TeacherRepository'
        );

        $this->app->bind(
            'App\Repository\StudentRepositoryInterface',
            'App\Repository\StudentRepository'
        );

        $this->app->bind(
            'App\Repository\StudentPromotionRepositoryInterface',
            'App\Repository\StudentPromotionRepository'
        );

        $this->app->bind(
            'App\Repository\StudentGraduatedRepositoryInterface',
            'App\Repository\StudentGraduatedRepository'
        );

        $this->app->bind(
            'App\Repository\FeesRepositoryInterface',
            'App\Repository\FeesRepository'
        );
        $this->app->bind(
            'App\Repository\FeeInvoicesRepositoryInterface',
            'App\Repository\FeeInvoicesRepository'
        );

        $this->app->bind(
            'App\Repository\ReceiptStudentsRepositoryInterface',
            'App\Repository\ReceiptStudentsRepository'
        );

        $this->app->bind(
            'App\Repository\ProcessingFeeRepositoryInterface',
            'App\Repository\ProcessingFeeRepository'
        );

        $this->app->bind(
            'App\Repository\PaymentRepositoryInterface',
            'App\Repository\PaymentRepository'
        );

        $this->app->bind(
            'App\Repository\AttendanceRepositoryInterface',
            'App\Repository\AttendanceRepository'
        );

        $this->app->bind(
            'App\Repository\SubjectRepositoryInterface',
            'App\Repository\SubjectRepository'
        );

        $this->app->bind(
            'App\Repository\QuizzRepositoryInterface',
            'App\Repository\QuizzRepository'
        );

        $this->app->bind(
            'App\Repository\QuestionRepositoryInterface',
            'App\Repository\QuestionRepository'
        );

        $this->app->bind(
            'App\Repository\LibraryRepositoryInterface',
            'App\Repository\LibraryRepository'
        );

        // ===== Excel استيراد وتصدير =====
        $this->app->bind(
            'App\Repository\ExcelRepositoryInterface',
            'App\Repository\ExcelRepository'
        );

        // ===== PDF طباعة التقارير =====
        $this->app->bind(
            'App\Repository\PdfRepositoryInterface',
            'App\Repository\PdfRepository'
        );

        // ===== Dashboard لوحة التحكم الإحصائية =====
        $this->app->bind(
            'App\Repository\DashboardRepositoryInterface',
            'App\Repository\DashboardRepository'
        );

        // ===== Notifications الإشعارات =====
        $this->app->bind(
            'App\Repository\NotificationRepositoryInterface',
            'App\Repository\NotificationRepository'
        );

        // ===== Activity Log سجل النشاطات =====
        $this->app->bind(
            'App\Repository\ActivityLogRepositoryInterface',
            'App\Repository\ActivityLogRepository'
        );

        // ===== Backup النسخ الاحتياطي =====
        $this->app->bind(
            'App\Repository\BackupRepositoryInterface',
            'App\Repository\BackupRepository'
        );

        // ===== Homework الواجبات =====
        $this->app->bind(
            'App\Repository\HomeworkRepositoryInterface',
            'App\Repository\HomeworkRepository'
        );

        // ===== StudentGrades تقديرات الطلاب =====
        $this->app->bind(
            'App\Repository\StudentGradeRepositoryInterface',
            'App\Repository\StudentGradeRepository'
        );

        // ===== QuestionBank بنك الأسئلة المركزي =====
        $this->app->bind(
            'App\Repository\QuestionBankRepositoryInterface',
            'App\Repository\QuestionBankRepository'
        );

        // ===== AutoPromotion محرك الترقية التلقائية =====
        $this->app->bind(
            'App\Repository\AutoPromotionRepositoryInterface',
            'App\Repository\AutoPromotionRepository'
        );

        // ===== Announcement لوحة الإعلانات =====
        $this->app->bind(
            'App\Repository\AnnouncementRepositoryInterface',
            'App\Repository\AnnouncementRepository'
        );

        // ===== WhatsApp (Feature 7) =====
        $this->app->bind(
            'App\Repository\WhatsAppRepositoryInterface',
            'App\Repository\WhatsAppRepository'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
