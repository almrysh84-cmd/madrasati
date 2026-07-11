<?php

namespace App\Repository;

use Illuminate\Http\Request;

/**
 * واجهة مستودع لوحة التحكم الإحصائية
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
interface DashboardRepositoryInterface
{
    /**
     * عرض لوحة التحكم مع البيانات الإحصائية
     */
    public function index();

    /**
     * بيانات الرسوم البيانية (JSON)
     */
    public function chartData(Request $request);
}
