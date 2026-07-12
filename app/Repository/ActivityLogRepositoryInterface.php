<?php

namespace App\Repository;

use Illuminate\Http\Request;

/**
 * واجهة مستودع سجل النشاطات
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
interface ActivityLogRepositoryInterface
{
    /**
     * عرض سجل النشاطات
     */
    public function index(Request $request);

    /**
     * حذف سجل نشاط
     */
    public function destroy($id);

    /**
     * حذف جميع السجلات
     */
    public function clearAll();
}
