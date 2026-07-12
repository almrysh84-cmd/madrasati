<?php

namespace App\Repository;

interface AutoPromotionRepositoryInterface
{
    // عرض صفحة إعدادات محرك الترقية التلقائية
    public function index();

    // عرض سجلات الترقية التلقائية
    public function logs();

    // البحث عن الطلاب المرشحين للترقية التلقائية بناءً على معايير الترقية
    public function findCandidates($request);

    // تنفيذ عملية الترقية التلقائية (إنشاء سجلات بانتظار المراجعة)
    public function trigger($request);

    // مراجعة وموافقة على ترقية طالب واحد
    public function approve($id);

    // مراجعة ورفض ترقية طالب واحد
    public function reject($request);

    // الموافقة الجماعية على جميع الترقيات المعلقة
    public function approveAll();

    // تطبيق الترقيات الموافق عليها فعلياً (تحديث سجلات الطلاب)
    public function executeApproved();

    // عكس ترقية واحدة
    public function reverse($id);
}
