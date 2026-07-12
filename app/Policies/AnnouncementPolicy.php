<?php

namespace App\Policies;

use App\Models\Announcement;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * سياسة صلاحيات لوحة الإعلانات (Feature 3)
 *
 * المسؤول يمكنه إنشاء/تعديل/حذف/نشر الإعلانات.
 * المعلمون والطلاب وأولياء الأمور يمكنهم عرض الإعلانات الموجهة إليهم فقط.
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class AnnouncementPolicy
{
    use HandlesAuthorization;

    /**
     * تحديد ما إذا كان المستخدم مسؤولاً
     */
    private function isAdmin($user): bool
    {
        return $user instanceof \App\Models\User;
    }

    /**
     * عرض قائمة الإعلانات
     */
    public function viewAny($user): bool
    {
        // جميع المستخدمين المصادق عليهم يمكنهم عرض الإعلانات
        return true;
    }

    /**
     * عرض إعلان محدد
     */
    public function view($user, Announcement $announcement): bool
    {
        // الإعلانات المنشورة يراها الجميع
        if ($announcement->is_published) {
            return true;
        }

        // الإعلانات غير المنشورة يراها المسؤول فقط
        return $this->isAdmin($user);
    }

    /**
     * إنشاء إعلان (المسؤول فقط)
     */
    public function create($user): bool
    {
        return $this->isAdmin($user);
    }

    /**
     * تعديل إعلان (المسؤول فقط)
     */
    public function update($user, Announcement $announcement): bool
    {
        return $this->isAdmin($user);
    }

    /**
     * حذف إعلان (المسؤول فقط)
     */
    public function delete($user, Announcement $announcement): bool
    {
        return $this->isAdmin($user);
    }

    /**
     * نشر/إلغاء نشر إعلان (المسؤول فقط)
     */
    public function togglePublish($user, Announcement $announcement): bool
    {
        return $this->isAdmin($user);
    }
}
