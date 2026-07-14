<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

/**
 * مزود خدمة المصادقة والصلاحيات
 *
 * يسجل سياسات الصلاحيات (Policies) والبوابات (Gates) للميزات الجديدة.
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\QuestionBank'  => 'App\Policies\QuestionBankPolicy',
        'App\Models\PromotionLog'  => 'App\Policies\PromotionLogPolicy',
        'App\Models\Announcement'  => 'App\Policies\AnnouncementPolicy',
        'App\Models\Quizze'        => 'App\Policies\QuizPolicy',
        'App\Models\Payment'       => 'App\Policies\PaymentPolicy',
        'App\Models\Student'       => 'App\Policies\StudentPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // ===== Gates للميزات الجديدة =====

        // Gate: إدارة بنك الأسئلة (المسؤول أو المعلم)
        Gate::define('manage-question-bank', function ($user) {
            return $user instanceof \App\Models\User || $user instanceof \App\Models\Teacher;
        });

        // Gate: إدارة محرك الترقية التلقائية (المسؤول فقط)
        Gate::define('manage-promotion', function ($user) {
            return $user instanceof \App\Models\User;
        });

        // Gate: إدارة الإعلانات (المسؤول فقط)
        Gate::define('manage-announcements', function ($user) {
            return $user instanceof \App\Models\User;
        });

        // Gate: إرسال رسائل واتساب (المسؤول فقط)
        Gate::define('manage-whatsapp', function ($user) {
            return $user instanceof \App\Models\User;
        });
    }
}
