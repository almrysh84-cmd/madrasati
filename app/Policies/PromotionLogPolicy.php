<?php

namespace App\Policies;

use App\Models\PromotionLog;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * سياسة صلاحيات سجل الترقية التلقائية (Feature 2)
 *
 * فقط المسؤول يمكنه عرض/مراجعة/اعتماد/رفض/عكس الترقيات.
 * المعلمون يمكنهم عرض السجلات للقراءة فقط.
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class PromotionLogPolicy
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
     * تحديد ما إذا كان المستخدم معلماً
     */
    private function isTeacher($user): bool
    {
        return $user instanceof \App\Models\Teacher;
    }

    /**
     * عرض سجلات الترقية (المسؤول والمعلم)
     */
    public function view($user, PromotionLog $promotionLog): bool
    {
        return $this->isAdmin($user) || $this->isTeacher($user);
    }

    /**
     * عرض قائمة سجلات الترقية
     */
    public function viewAny($user): bool
    {
        return $this->isAdmin($user) || $this->isTeacher($user);
    }

    /**
     * مراجعة/اعتماد/رفض ترقية (المسؤول فقط)
     */
    public function review($user): bool
    {
        return $this->isAdmin($user);
    }

    /**
     * اعتماد ترقية (المسؤول فقط)
     */
    public function approve($user, PromotionLog $promotionLog): bool
    {
        return $this->isAdmin($user);
    }

    /**
     * رفض ترقية (المسؤول فقط)
     */
    public function reject($user, PromotionLog $promotionLog): bool
    {
        return $this->isAdmin($user);
    }

    /**
     * عكس ترقية منفذة (المسؤول فقط)
     */
    public function reverse($user, PromotionLog $promotionLog): bool
    {
        return $this->isAdmin($user);
    }

    /**
     * تشغيل محرك الترقية (المسؤول فقط)
     */
    public function trigger($user): bool
    {
        return $this->isAdmin($user);
    }

    /**
     * إنشاء سجل ترقية (لا يمكن يدوياً — فقط عبر المحرك)
     */
    public function create($user): bool
    {
        return $this->isAdmin($user);
    }

    /**
     * تحديث سجل ترقية (المسؤول فقط)
     */
    public function update($user, PromotionLog $promotionLog): bool
    {
        return $this->isAdmin($user);
    }

    /**
     * حذف سجل ترقية (المسؤول فقط)
     */
    public function delete($user, PromotionLog $promotionLog): bool
    {
        return $this->isAdmin($user);
    }
}
