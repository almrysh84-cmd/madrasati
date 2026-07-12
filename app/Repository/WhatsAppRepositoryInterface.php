<?php

namespace App\Repository;

/**
 * واجهة مستودع واتساب (Feature 7)
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
interface WhatsAppRepositoryInterface
{
    // عرض صفحة الإرسال الجماعي
    public function index();

    // صفحة الإعدادات
    public function settings();

    // تحديث الإعدادات
    public function updateSettings($request);

    // إرسال رسالة جماعية
    public function sendBulk($request);

    // إرسال إشعار غياب لولي أمر طالب
    public function sendAbsenceNotification($studentId, $date);

    // إرسال إشعار درجة جديدة لولي أمر طالب
    public function sendGradeNotification($studentId, $subjectName, $grade);

    // إرسال إشعار رسوم مستحقة
    public function sendFeeNotification($studentId, $amount, $dueDate);

    // الحصول على أرقام أولياء الأمور حسب المرحلة/الفصل
    public function getParentPhones($gradeId = null, $classroomId = null);

    // سجل رسائل واتساب المرسلة
    public function logs();
}
