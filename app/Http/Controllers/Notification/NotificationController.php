<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use App\Repository\NotificationRepositoryInterface;
use Illuminate\Http\Request;

/**
 * متحكم الإشعارات
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class NotificationController extends Controller
{
    protected $notificationRepository;

    public function __construct(NotificationRepositoryInterface $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    /**
     * عرض جميع الإشعارات
     */
    public function index()
    {
        $notifications = $this->notificationRepository->allNotifications();
        $unreadCount = $this->notificationRepository->unreadCount();
        return view('pages.Notifications.index', compact('notifications', 'unreadCount'));
    }

    /**
     * تحديد إشعار كمقروء (AJAX)
     */
    public function markAsRead(Request $request, $id)
    {
        $this->notificationRepository->markAsRead($id);
        return response()->json(['success' => true]);
    }

    /**
     * تحديد جميع الإشعارات كمقروءة (AJAX)
     */
    public function markAllAsRead(Request $request)
    {
        $this->notificationRepository->markAllAsRead();
        return response()->json(['success' => true]);
    }

    /**
     * حذف إشعار (AJAX)
     */
    public function destroy(Request $request, $id)
    {
        $this->notificationRepository->deleteNotification($id);
        return response()->json(['success' => true]);
    }

    /**
     * الحصول على عدد الإشعارات غير المقروءة (AJAX)
     */
    public function unreadCount()
    {
        return response()->json([
            'count' => $this->notificationRepository->unreadCount(),
        ]);
    }
}
