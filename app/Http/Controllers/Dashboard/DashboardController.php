<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Repository\DashboardRepositoryInterface;
use Illuminate\Http\Request;

/**
 * متحكم لوحة التحكم الإحصائية
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class DashboardController extends Controller
{
    protected $dashboardRepository;

    public function __construct(DashboardRepositoryInterface $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    /**
     * عرض لوحة التحكم مع الرسوم البيانية
     */
    public function index()
    {
        return $this->dashboardRepository->index();
    }

    /**
     * بيانات الرسوم البيانية (JSON API)
     */
    public function chartData(Request $request)
    {
        return $this->dashboardRepository->chartData($request);
    }
}
