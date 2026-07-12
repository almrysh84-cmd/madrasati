<?php

namespace App\Policies;

use App\Models\QuestionBank;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * سياسة صلاحيات بنك الأسئلة المركزي (Feature 1)
 *
 * تحدد من يمكنه إنشاء/عرض/تعديل/حذف الأسئلة من البنك المركزي.
 * المعلمون يمكنهم إنشاء وعرض وتعديل وحذف أسئلتهم فقط.
 * المسؤول يمكنه كل شيء.
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class QuestionBankPolicy
{
    use HandlesAuthorization;

    /**
     * تحديد ما إذا كان المستخدم مسؤولاً (له صلاحيات كلية)
     */
    private function isAdmin($user): bool
    {
        // المسؤول يستخدم auth:web guard
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
     * عرض أي سؤال في البنك (المعلمون يرون الأسئلة المشتركة + أسئلتهم)
     */
    public function view($user, QuestionBank $questionBank): bool
    {
        if ($this->isAdmin($user)) {
            return true;
        }

        if ($this->isTeacher($user)) {
            // المعلم يرى أسئلته أو الأسئلة المشتركة
            return $questionBank->created_by === $user->id || $questionBank->is_shared;
        }

        return false;
    }

    /**
     * إنشاء سؤال جديد (المسؤول أو المعلم)
     */
    public function create($user): bool
    {
        return $this->isAdmin($user) || $this->isTeacher($user);
    }

    /**
     * تعديل سؤال (المسؤول أو صاحب السؤال فقط)
     */
    public function update($user, QuestionBank $questionBank): bool
    {
        if ($this->isAdmin($user)) {
            return true;
        }

        if ($this->isTeacher($user)) {
            return $questionBank->created_by === $user->id;
        }

        return false;
    }

    /**
     * حذف سؤال (المسؤول أو صاحب السؤال فقط)
     */
    public function delete($user, QuestionBank $questionBank): bool
    {
        if ($this->isAdmin($user)) {
            return true;
        }

        if ($this->isTeacher($user)) {
            return $questionBank->created_by === $user->id;
        }

        return false;
    }
}
