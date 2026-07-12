<?php

namespace App\Repository;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

/**
 * مستودع سجل النشاطات
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class ActivityLogRepository implements ActivityLogRepositoryInterface
{
    /**
     * عرض سجل النشاطات مع التصفية والترقيم
     */
    public function index(Request $request)
    {
        $query = Activity::with('causer')->latest();

        // تصفية حسب نوع الحدث
        if ($request->filled('event')) {
            $query->where('event', $request->event);
        }

        // تصفية حسب الوصف
        if ($request->filled('log_name')) {
            $query->where('log_name', $request->log_name);
        }

        // تصفية حسب المستخدم
        if ($request->filled('causer_id')) {
            $query->where('causer_id', $request->causer_id);
        }

        // البحث في الوصف
        if ($request->filled('search')) {
            $query->where('description', 'like', '%' . $request->search . '%');
        }

        $activities = $query->paginate(15);

        // أنواع الأحداث المتاحة للتصفية
        $events = Activity::distinct()->pluck('event')->filter();
        $logNames = Activity::distinct()->pluck('log_name')->filter();

        return view('pages.ActivityLog.index', compact('activities', 'events', 'logNames'));
    }

    /**
     * حذف سجل نشاط
     */
    public function destroy($id)
    {
        $activity = Activity::findOrFail($id);
        $activity->delete();
        return true;
    }

    /**
     * حذف جميع السجلات
     */
    public function clearAll()
    {
        return Activity::truncate();
    }
}
