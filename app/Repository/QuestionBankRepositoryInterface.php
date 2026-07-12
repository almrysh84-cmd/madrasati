<?php

namespace App\Repository;

interface QuestionBankRepositoryInterface
{
    // عرض قائمة أسئلة البنك (للمعلم: أسئلته + الأسئلة المشتركة)
    public function index();

    // عرض نموذج إضافة سؤال جديد
    public function create();

    // حفظ سؤال جديد في البنك
    public function store($request);

    // عرض نموذج تعديل السؤال
    public function edit($id);

    // تحديث السؤال
    public function update($request);

    // حذف السؤال
    public function destroy($id);

    // تصدير الأسئلة إلى Excel
    public function export();

    // استيراد الأسئلة من Excel
    public function import($request);

    // البحث في البنك حسب المادة والصف والنوع والمستوى (للاستخدام عند إنشاء الاختبارات)
    public function search($request);
}
