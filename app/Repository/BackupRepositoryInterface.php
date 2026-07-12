<?php

namespace App\Repository;

/**
 * واجهة مستودع النسخ الاحتياطي
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
interface BackupRepositoryInterface
{
    /**
     * عرض قائمة النسخ الاحتياطية المتاحة
     */
    public function index();

    /**
     * إنشاء نسخة احتياطية جديدة (قاعدة البيانات فقط)
     */
    public function create();

    /**
     * تنزيل نسخة احتياطية
     */
    public function download($fileName);

    /**
     * حذف نسخة احتياطية
     */
    public function delete($fileName);
}
