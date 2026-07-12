<?php

namespace App\Http\Controllers\WhatsApp;

use App\Http\Controllers\Controller;
use App\Repository\WhatsAppRepositoryInterface;
use App\Http\Requests\WhatsAppBulkRequest;
use Illuminate\Http\Request;

/**
 * وحدة تحكم واتساب (Feature 7)
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class WhatsAppController extends Controller
{
    protected $whatsappRepository;

    /**
     * Create a new controller instance.
     */
    public function __construct(WhatsAppRepositoryInterface $whatsappRepository)
    {
        $this->whatsappRepository = $whatsappRepository;
    }

    /**
     * عرض صفحة الإرسال الجماعي
     */
    public function index()
    {
        return $this->whatsappRepository->index();
    }

    /**
     * صفحة الإعدادات
     */
    public function settings()
    {
        return $this->whatsappRepository->settings();
    }

    /**
     * تحديث الإعدادات
     */
    public function updateSettings(Request $request)
    {
        return $this->whatsappRepository->updateSettings($request);
    }

    /**
     * إرسال رسالة جماعية
     */
    public function sendBulk(WhatsAppBulkRequest $request)
    {
        return $this->whatsappRepository->sendBulk($request);
    }

    /**
     * سجل الرسائل المرسلة
     */
    public function logs()
    {
        return $this->whatsappRepository->logs();
    }

    /**
     * معاينة عدد المستلمين (AJAX)
     */
    public function previewRecipients(Request $request)
    {
        $targetType = $request->get('target_type');
        $gradeId = $request->get('grade_id');
        $classroomId = $request->get('classroom_id');

        if ($targetType === 'all_parents') {
            $phones = $this->whatsappRepository->getParentPhones();
        } elseif ($targetType === 'grade_parents' && $gradeId) {
            $phones = $this->whatsappRepository->getParentPhones($gradeId);
        } elseif ($targetType === 'classroom_parents' && $gradeId && $classroomId) {
            $phones = $this->whatsappRepository->getParentPhones($gradeId, $classroomId);
        } elseif ($targetType === 'custom') {
            $customPhones = explode(',', $request->get('custom_phones', ''));
            $phones = array_filter(array_map('trim', $customPhones));
        } else {
            $phones = [];
        }

        return response()->json([
            'count'  => count($phones),
            'phones' => array_slice($phones, 0, 10), // عرض أول 10 أرقام فقط
        ]);
    }
}
