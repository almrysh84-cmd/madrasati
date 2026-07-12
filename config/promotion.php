<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Auto Promotion Engine Configuration
    |--------------------------------------------------------------------------
    |
    | إعدادات محرك الترقية التلقائي - يمكن تجاوزها عبر متغيرات البيئة
    |
    */

    // الحد الأدنى للمتوسط العام للترقية (من 100)
    'min_average' => env('PROMOTION_MIN_AVERAGE', 50),

    // الحد الأقصى لعدد المواد الراسبة المسموح به للترقية
    'max_failed_subjects' => env('PROMOTION_MAX_FAILED_SUBJECTS', 0),

    // إشعار أولياء الأمور تلقائياً عند الترقية
    'auto_notify_parents' => env('PROMOTION_AUTO_NOTIFY_PARENTS', true),

    // السنة الدراسية الافتراضية
    'default_academic_year' => env('PROMOTION_DEFAULT_ACADEMIC_YEAR', date('Y') . '/' . (date('Y') + 1)),

    // تفعيل قائمة الانتظار (Queues) للإشعارات
    'queue_notifications' => env('PROMOTION_QUEUE_NOTIFICATIONS', true),
];
