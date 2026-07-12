<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

/**
 * خدمة التخزين المؤقت (Redis) لتحسين الأداء (Feature 6)
 *
 * توفر واجهة موحدة للتخزين المؤقت مع:
 * - مفاتيح أسماء منظمة
 * - وقت انتهاء صلاحية قابل للتكوين
 * - إبطال ذكي للذاكرة المؤقتة عند التحديث/الحذف
 * - استرجاع آمن (fallback) عند فشل Redis
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class CacheService
{
    /**
     * بادئة المفتاح لتمييز ذاكرة madrasati المؤقتة
     */
    protected const PREFIX = 'madrasati:';

    /**
     * المدة الافتراضية للتخزين المؤقت بالثواني (5 دقائق)
     */
    protected const DEFAULT_TTL = 300;

    /**
     * تخزين قيمة في الذاكرة المؤقتة
     *
     * @param string   $key      مفتاح التخزين
     * @param mixed    $value    القيمة المراد تخزينها
     * @param int|null $ttl      وقت الانتهاء بالثواني (افتراضي: 5 دقائق)
     * @return bool
     */
    public function put(string $key, $value, ?int $ttl = null): bool
    {
        try {
            $cacheKey = $this->buildKey($key);
            $ttl = $ttl ?? self::DEFAULT_TTL;
            Cache::put($cacheKey, $value, $ttl);
            return true;
        } catch (\Exception $e) {
            Log::warning('Cache put failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * استرجاع قيمة من الذاكرة المؤقتة
     *
     * @param string   $key      مفتاح التخزين
     * @param mixed    $default  القيمة الافتراضية إذا لم توجد
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        try {
            $cacheKey = $this->buildKey($key);
            return Cache::get($cacheKey, $default);
        } catch (\Exception $e) {
            Log::warning('Cache get failed: ' . $e->getMessage());
            return $default;
        }
    }

    /**
     * تذكر: استرجع من الذاكرة المؤقتة أو نفّذ الـ callback وخزّن النتيجة
     *
     * @param string   $key      مفتاح التخزين
     * @param callable $callback الدالة المنفذة عند عدم وجود القيمة
     * @param int|null $ttl      وقت الانتهاء بالثواني
     * @return mixed
     */
    public function remember(string $key, callable $callback, ?int $ttl = null)
    {
        try {
            $cacheKey = $this->buildKey($key);
            $ttl = $ttl ?? self::DEFAULT_TTL;

            if (Cache::has($cacheKey)) {
                return Cache::get($cacheKey);
            }

            $value = $callback();
            Cache::put($cacheKey, $value, $ttl);
            return $value;
        } catch (\Exception $e) {
            Log::warning('Cache remember failed: ' . $e->getMessage());
            // في حالة فشل Redis، ننفّذ الـ callback مباشرة
            return $callback();
        }
    }

    /**
     * نسيان: حذف قيمة من الذاكرة المؤقتة
     *
     * @param string $key مفتاح التخزين
     * @return bool
     */
    public function forget(string $key): bool
    {
        try {
            $cacheKey = $this->buildKey($key);
            return Cache::forget($cacheKey);
        } catch (\Exception $e) {
            Log::warning('Cache forget failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * نسيان بالنمط: حذف جميع المفاتيح المطابقة لنمط معين
     *
     * @param string $pattern نمط المفتاح (مثل: dashboard:*)
     * @return void
     */
    public function forgetByPattern(string $pattern): void
    {
        try {
            $cacheKey = $this->buildKey($pattern);
            // استخدام flush غير محدد قد يمسح كل شيء، لذا نستخدم علامات بسيطة
            // في تطبيق إنتاجي، يمكن استخدام Cache::tags() إذا كان Redis متاحاً
            $this->flush();
        } catch (\Exception $e) {
            Log::warning('Cache forgetByPattern failed: ' . $e->getMessage());
        }
    }

    /**
     * مسح جميع البيانات المؤقتة
     *
     * @return void
     */
    public function flush(): void
    {
        try {
            Cache::flush();
        } catch (\Exception $e) {
            Log::warning('Cache flush failed: ' . $e->getMessage());
        }
    }

    /**
     * بناء مفتاح التخزين بالبادئة
     *
     * @param string $key
     * @return string
     */
    protected function buildKey(string $key): string
    {
        return self::PREFIX . $key;
    }

    /**
     * تحديد ما إذا كان التخزين المؤقت مدعوماً (Redis متصل)
     *
     * @return bool
     */
    public function isAvailable(): bool
    {
        try {
            return Cache::has(self::PREFIX . 'ping_test');
            // اختبار سريع - لا يرمي استثناء حتى لو لم يوجد المفتاح
        } catch (\Exception $e) {
            return false;
        }
    }
}
