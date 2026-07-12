<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

/**
 * مزود خدمة البث - يدعم الحُرّاس المتعددين (admin, teacher, student, parent)
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // تسجيل مسار المصادقة للبث الافتراضي (للحارس web/admin)
        Broadcast::routes();

        // تسجيل مسارات مصادقة البث للحُرّاس الأخرى
        // هذه المسارات تسمح للمستخدمين من حُرّاس مختلفة بالاشتراك في قنوات Pusher الخاصة
        Broadcast::routes(['middleware' => ['auth:teacher']]);
        Broadcast::routes(['middleware' => ['auth:student']]);
        Broadcast::routes(['middleware' => ['auth:parent']]);

        require base_path('routes/channels.php');
    }
}
