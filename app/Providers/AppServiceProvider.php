<?php

namespace App\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // تسجيل خدمة الإشعارات في الوقت الفعلي (singleton)
        $this->app->singleton(
            \App\Services\RealTimeNotificationService::class,
            function ($app) {
                return new \App\Services\RealTimeNotificationService();
            }
        );

        // تسجيل خدمة التخزين المؤقت (singleton) - Feature 6
        $this->app->singleton(
            \App\Services\CacheService::class,
            function ($app) {
                return new \App\Services\CacheService();
            }
        );

        // تسجيل خدمة واتساب (singleton) - Feature 7
        $this->app->singleton(
            \App\Services\WhatsAppService::class,
            function ($app) {
                return new \App\Services\WhatsAppService();
            }
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }
    }
}