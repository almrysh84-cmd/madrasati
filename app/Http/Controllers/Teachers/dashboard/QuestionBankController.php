<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestionBankRequest;
use App\Repository\QuestionBankRepositoryInterface;
use Illuminate\Http\Request;

class QuestionBankController extends Controller
{
    protected $questionBank;

    public function __construct(QuestionBankRepositoryInterface $questionBank)
    {
        $this->questionBank = $questionBank;
    }

    public function index()
    {
        return $this->questionBank->index();
    }

    public function create()
    {
        return $this->questionBank->create();
    }

    public function store(StoreQuestionBankRequest $request)
    {
        return $this->questionBank->store($request);
    }

    public function edit($id)
    {
        return $this->questionBank->edit($id);
    }

    public function update(StoreQuestionBankRequest $request)
    {
        return $this->questionBank->update($request);
    }

    public function destroy($id)
    {
        return $this->questionBank->destroy($id);
    }

    // تصدير الأسئلة إلى Excel
    public function export()
    {
        return $this->questionBank->export();
    }

    // استيراد الأسئلة من Excel
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);
        return $this->questionBank->import($request);
    }

    // البحث في البنك (AJAX) - يستخدم عند إنشاء الاختبارات
    public function search(Request $request)
    {
        return $this->questionBank->search($request);
    }
}
