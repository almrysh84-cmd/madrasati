<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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

        // ===== خدمات Pro =====
        $this->app->singleton(\App\Services\QuizService::class);
        $this->app->singleton(\App\Services\AnalyticsService::class);
        $this->app->singleton(\App\Services\PaymentService::class);
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

        // Register legacy toastr Blade directives for backward compatibility.
        // yoeunes/toastr v2 uses php-flasher which renders notifications
        // automatically via middleware. These directives were used in v1
        // to output CSS/JS/render HTML. In v2 they are no-ops (empty)
        // to prevent raw "@toastr_css" text from appearing on pages.
        Blade::directive('toastr_css', function ($expression) {
            return '';
        });
        Blade::directive('toastr_js', function ($expression) {
            return '';
        });
        Blade::directive('toastr_render', function ($expression) {
            return '';
        });
    }
}