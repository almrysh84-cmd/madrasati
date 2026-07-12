<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\TriggerPromotionRequest;
use App\Repository\AutoPromotionRepositoryInterface;
use Illuminate\Http\Request;

class AutoPromotionController extends Controller
{
    protected $autoPromotion;

    public function __construct(AutoPromotionRepositoryInterface $autoPromotion)
    {
        $this->autoPromotion = $autoPromotion;
    }

    // صفحة إعدادات محرك الترقية
    public function index()
    {
        return $this->autoPromotion->index();
    }

    // سجلات الترقية التلقائية
    public function logs()
    {
        return $this->autoPromotion->logs();
    }

    // عرض المرشحين للترقية (AJAX)
    public function findCandidates(Request $request)
    {
        return $this->autoPromotion->findCandidates($request);
    }

    // صفحة مراجعة المرشحين
    public function review()
    {
        $logs = \App\Models\PromotionLog::where('status', 'pending')
            ->with(['student', 'fromGrade', 'toGrade', 'fromClassroom', 'toClassroom', 'fromSection', 'toSection'])
            ->orderBy('created_at', 'desc')
            ->get();

        $grades = \App\Models\Grade::all();

        return view('pages.AutoPromotion.review', compact('logs', 'grades'));
    }

    // تنفيذ الترقية التلقائية (إنشاء سجلات معلقة)
    public function trigger(TriggerPromotionRequest $request)
    {
        return $this->autoPromotion->trigger($request);
    }

    // الموافقة على ترقية طالب
    public function approve($id)
    {
        return $this->autoPromotion->approve($id);
    }

    // رفض ترقية طالب
    public function reject(Request $request)
    {
        return $this->autoPromotion->reject($request);
    }

    // الموافقة الجماعية
    public function approveAll()
    {
        return $this->autoPromotion->approveAll();
    }

    // تنفيذ الترقيات الموافق عليها
    public function executeApproved()
    {
        return $this->autoPromotion->executeApproved();
    }

    // عكس ترقية
    public function reverse($id)
    {
        return $this->autoPromotion->reverse($id);
    }
}
