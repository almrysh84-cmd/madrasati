<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Http\Controllers\Controller;
use App\Repository\HomeworkRepositoryInterface;
use Illuminate\Http\Request;

class HomeworkController extends Controller
{

    protected $homework;

    public function __construct(HomeworkRepositoryInterface $homework)
    {
        $this->homework = $homework;
    }

    public function index()
    {
        return $this->homework->index();
    }

    public function create()
    {
        return $this->homework->create();
    }

    public function store(Request $request)
    {
        return $this->homework->store($request);
    }

    public function show($id)
    {
        return $this->homework->show($id);
    }

    public function edit($id)
    {
        return $this->homework->edit($id);
    }

    public function update(Request $request)
    {
        return $this->homework->update($request);
    }

    public function destroy($id)
    {
        return $this->homework->destroy($id);
    }

    // حفظ سؤال جديد للواجب
    public function storeQuestion(Request $request)
    {
        return $this->homework->storeQuestion($request);
    }

    // حذف سؤال من الواجب
    public function destroyQuestion($id)
    {
        return $this->homework->destroyQuestion($id);
    }

    // تنزيل ملف الواجب
    public function download($filename)
    {
        return $this->homework->download($filename);
    }
}
