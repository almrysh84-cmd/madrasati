<?php

namespace App\Repository;

interface HomeworkRepositoryInterface
{
    // عرض قائمة الواجبات للمعلم (حسب مواده)
    public function index();

    // عرض نموذج إضافة واجب جديد
    public function create();

    // حفظ واجب جديد
    public function store($request);

    // عرض تفاصيل الواجب (الأسئلة إن وجدت)
    public function show($id);

    // عرض نموذج تعديل الواجب
    public function edit($id);

    // تحديث الواجب
    public function update($request);

    // حذف الواجب
    public function destroy($id);

    // حفظ سؤال جديد للواجب
    public function storeQuestion($request);

    // حذف سؤال من الواجب
    public function destroyQuestion($id);

    // تنزيل ملف الواجب
    public function download($filename);
}
