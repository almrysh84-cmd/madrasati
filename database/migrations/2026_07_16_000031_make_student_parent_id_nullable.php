<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * جعل عمود parent_id في جدول students قابلاً لـ NULL.
 *
 * المشكلة: الـ migration الأصلي أنشأ parent_id كـ bigInteger()->unsigned() بدون
 * nullable()، فعند محاولة فصل طالب عن ولي أمره (unlink) من لوحة الإدارة،
 * يُضبط parent_id = null لكن قاعدة البيانات ترفضه:
 *   SQLSTATE[23000]: Column 'parent_id' cannot be null
 *
 * الحل: جعل العمود nullable مع إزالة القيد NOT NULL.
 * لا نحذف الـ FK — نبقيه لكن نجعل العمود يقبل NULL.
 */
return new class extends Migration
{
    public function up()
    {
        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'mysql') {
            // جعل العمود nullable مع الاحتفاظ بـ FK
            // نستخدم raw SQL لأن doctrine/dbal غير مثبت
            DB::statement("ALTER TABLE `students` MODIFY `parent_id` BIGINT UNSIGNED NULL");
        } elseif ($driver === 'sqlite') {
            // SQLite لا يدعم MODIFY — نتجاهل (العمود سيُنشأ nullable في البيئات الجديدة)
        }
    }

    public function down()
    {
        $driver = Schema::getConnection()->getDriverName();
        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE `students` MODIFY `parent_id` BIGINT UNSIGNED NOT NULL");
        }
    }
};
