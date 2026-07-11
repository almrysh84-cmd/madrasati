<?php

namespace App\Http\Controllers\ActivityLog;

use App\Http\Controllers\Controller;
use App\Repository\ActivityLogRepositoryInterface;
use Illuminate\Http\Request;

/**
 * متحكم سجل النشاطات
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class ActivityLogController extends Controller
{
    protected $activityLogRepository;

    public function __construct(ActivityLogRepositoryInterface $activityLogRepository)
    {
        $this->activityLogRepository = $activityLogRepository;
    }

    /**
     * عرض سجل النشاطات
     */
    public function index(Request $request)
    {
        return $this->activityLogRepository->index($request);
    }

    /**
     * حذف سجل نشاط (AJAX)
     */
    public function destroy(Request $request, $id)
    {
        $this->activityLogRepository->destroy($id);
        return response()->json(['success' => true]);
    }

    /**
     * حذف جميع السجلات
     */
    public function clearAll(Request $request)
    {
        $this->activityLogRepository->clearAll();
        return redirect()->back()->with('success', 'تم حذف جميع السجلات');
    }
}
