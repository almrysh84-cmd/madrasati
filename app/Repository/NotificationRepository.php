<?php

namespace App\Repository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * مستودع الإشعارات
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class NotificationRepository implements NotificationRepositoryInterface
{
    /**
     * الحصول على المستخدم المصادق عليه حسب الحارس النشط
     */
    private function getAuthUser()
    {
        foreach (['web', 'student', 'teacher', 'parent'] as $guard) {
            if (Auth::guard($guard)->check()) {
                return Auth::guard($guard)->user();
            }
        }
        return null;
    }

    /**
     * الحصول على إشعارات المستخدم الحالي غير المقروءة
     */
    public function unreadNotifications()
    {
        $user = $this->getAuthUser();
        if (!$user) {
            return collect([]);
        }
        return $user->unreadNotifications;
    }

    /**
     * الحصول على جميع إشعارات المستخدم الحالي
     */
    public function allNotifications()
    {
        $user = $this->getAuthUser();
        if (!$user) {
            return collect([]);
        }
        return $user->notifications()->paginate(15);
    }

    /**
     * تحديد إشعار كمقروء
     */
    public function markAsRead($id)
    {
        $user = $this->getAuthUser();
        if (!$user) {
            return false;
        }

        $notification = $user->notifications()->where('id', $id)->first();
        if ($notification && is_null($notification->read_at)) {
            $notification->markAsRead();
            return true;
        }
        return false;
    }

    /**
     * تحديد جميع الإشعارات كمقروءة
     */
    public function markAllAsRead()
    {
        $user = $this->getAuthUser();
        if (!$user) {
            return false;
        }
        $user->unreadNotifications->markAsRead();
        return true;
    }

    /**
     * حذف إشعار
     */
    public function deleteNotification($id)
    {
        $user = $this->getAuthUser();
        if (!$user) {
            return false;
        }
        return $user->notifications()->where('id', $id)->delete();
    }

    /**
     * عدد الإشعارات غير المقروءة
     */
    public function unreadCount()
    {
        $user = $this->getAuthUser();
        if (!$user) {
            return 0;
        }
        return $user->unreadNotifications->count();
    }
}
