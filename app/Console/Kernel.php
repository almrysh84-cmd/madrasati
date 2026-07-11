<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        // ===== النسخ الاحتياطي - spatie/laravel-backup =====
        // نسخة احتياطية يومية لقاعدة البيانات عند الساعة 2:00 صباحاً
        $schedule->command('backup:run --only-db')
            ->dailyAt('02:00')
            ->onSuccess(function () {
                \Log::info('تم إنشاء النسخة الاحتياطية اليومية بنجاح');
            })
            ->onFailure(function () {
                \Log::error('فشل إنشاء النسخة الاحتياطية اليومية');
            });

        // تنظيف النسخ الاحتياطية القديمة أسبوعياً يوم الأحد الساعة 3:00 صباحاً
        $schedule->command('backup:clean')
            ->weekly()
            ->sundays()
            ->at('03:00');

        // مراقبة صحة النسخ الاحتياطية يومياً الساعة 6:00 صباحاً
        $schedule->command('backup:monitor')
            ->dailyAt('06:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
