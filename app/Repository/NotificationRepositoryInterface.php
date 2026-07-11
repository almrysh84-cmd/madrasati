<?php

namespace App\Repository;

use Illuminate\Http\Request;

/**
 * واجهة مستودع الإشعارات
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
interface NotificationRepositoryInterface
{
    /**
     * الحصول على إشعارات المستخدم الحالي غير المقروءة
     */
    public function unreadNotifications();

    /**
     * الحصول على جميع إشعارات المستخدم الحالي
     */
    public function allNotifications();

    /**
     * تحديد إشعار كمقروء
     */
    public function markAsRead($id);

    /**
     * تحديد جميع الإشعارات كمقروءة
     */
    public function markAllAsRead();

    /**
     * حذف إشعار
     */
    public function deleteNotification($id);

    /**
     * عدد الإشعارات غير المقروءة
     */
    public function unreadCount();
}
