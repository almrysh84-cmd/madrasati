<?php

namespace App\Repository;

use App\Services\WhatsAppService;
use App\Models\Student;
use App\Models\My_Parent;
use App\Models\Grade;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * مستودع واتساب - تكامل مع Twilio (Feature 7)
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class WhatsAppRepository implements WhatsAppRepositoryInterface
{
    protected $whatsapp;

    /**
     * Create a new repository instance.
     */
    public function __construct(WhatsAppService $whatsapp)
    {
        $this->whatsapp = $whatsapp;
    }

    /**
     * عرض صفحة الإرسال الجماعي
     */
    public function index()
    {
        $grades = Grade::all();
        $isEnabled = $this->whatsapp->isEnabled();

        return view('pages.WhatsApp.index', compact('grades', 'isEnabled'));
    }

    /**
     * صفحة الإعدادات
     */
    public function settings()
    {
        $config = [
            'sid'           => config('services.twilio.sid') ? $this->maskValue(config('services.twilio.sid')) : '',
            'whatsapp_from' => config('services.twilio.whatsapp_from'),
            'enabled'       => config('services.twilio.enabled', false),
        ];

        return view('pages.WhatsApp.settings', compact('config'));
    }

    /**
     * تحديث الإعدادات
     */
    public function updateSettings($request)
    {
        // الإعدادات تُحفظ في ملف .env (يتطلب إعادة تشغيل التطبيق)
        // نعرض رسالة للمستخدم بأن الإعدادات تُعدّل عبر متغيرات البيئة
        toastr()->success('يتم تحديث إعدادات واتساب عبر متغيرات البيئة (.env). يرجى الرجوع لمسؤول النظام.');
        return redirect()->route('whatsapp.settings');
    }

    /**
     * إرسال رسالة جماعية
     */
    public function sendBulk($request)
    {
        $request->validated();

        $recipients = [];
        $message = $request->message;

        // تحديد المستلمين حسب نوع الاستهداف
        $targetType = $request->target_type;

        if ($targetType === 'all_parents') {
            $recipients = $this->getParentPhones();
        } elseif ($targetType === 'grade_parents' && $request->grade_id) {
            $recipients = $this->getParentPhones($request->grade_id);
        } elseif ($targetType === 'classroom_parents' && $request->grade_id && $request->classroom_id) {
            $recipients = $this->getParentPhones($request->grade_id, $request->classroom_id);
        } elseif ($targetType === 'custom') {
            $customPhones = explode(',', $request->custom_phones ?? '');
            $recipients = array_filter(array_map('trim', $customPhones));
        }

        if (empty($recipients)) {
            toastr()->error('لا توجد أرقام هاتف للإرسال إليها');
            return redirect()->back();
        }

        $result = $this->whatsapp->sendBulk($recipients, $message);

        if ($result['success_count'] > 0) {
            toastr()->success("تم إرسال {$result['success_count']} رسالة بنجاح من أصل {$result['total']}");
        } else {
            toastr()->error('فشل إرسال جميع الرسائل. تأكد من تفعيل خدمة واتساب.');
        }

        if ($result['fail_count'] > 0 && $result['success_count'] > 0) {
            toastr()->warning("فشل إرسال {$result['fail_count']} رسالة");
        }

        return redirect()->route('whatsapp.index')->with('bulk_result', $result);
    }

    /**
     * إرسال إشعار غياب لولي أمر طالب
     */
    public function sendAbsenceNotification($studentId, $date)
    {
        $student = Student::with('myparent')->findOrFail($studentId);

        $parentPhone = $this->getStudentParentPhone($student);
        if (!$parentPhone) {
            return ['success' => false, 'message' => 'لا يوجد رقم هاتف لولي الأمر'];
        }

        $studentName = $student->getTranslation('name', 'ar') ?? $student->name ?? 'الطالب';

        return $this->whatsapp->sendAbsenceNotification($parentPhone, $studentName, $date);
    }

    /**
     * إرسال إشعار درجة جديدة لولي أمر طالب
     */
    public function sendGradeNotification($studentId, $subjectName, $grade)
    {
        $student = Student::with('myparent')->findOrFail($studentId);

        $parentPhone = $this->getStudentParentPhone($student);
        if (!$parentPhone) {
            return ['success' => false, 'message' => 'لا يوجد رقم هاتف لولي الأمر'];
        }

        $studentName = $student->getTranslation('name', 'ar') ?? $student->name ?? 'الطالب';

        return $this->whatsapp->sendGradeNotification($parentPhone, $studentName, $subjectName, $grade);
    }

    /**
     * إرسال إشعار رسوم مستحقة
     */
    public function sendFeeNotification($studentId, $amount, $dueDate)
    {
        $student = Student::with('myparent')->findOrFail($studentId);

        $parentPhone = $this->getStudentParentPhone($student);
        if (!$parentPhone) {
            return ['success' => false, 'message' => 'لا يوجد رقم هاتف لولي الأمر'];
        }

        $studentName = $student->getTranslation('name', 'ar') ?? $student->name ?? 'الطالب';

        return $this->whatsapp->sendFeeDueNotification($parentPhone, $studentName, $amount, $dueDate);
    }

    /**
     * الحصول على أرقام أولياء الأمور حسب المرحلة/الفصل
     *
     * @param int|null $gradeId
     * @param int|null $classroomId
     * @return array
     */
    public function getParentPhones($gradeId = null, $classroomId = null): array
    {
        $query = Student::with('myparent')
            ->whereNotNull('parent_id');

        if ($gradeId) {
            $query->where('Grade_id', $gradeId);
        }

        if ($classroomId) {
            $query->where('Classroom_id', $classroomId);
        }

        $students = $query->get();

        $phones = [];
        foreach ($students as $student) {
            $phone = $this->getStudentParentPhone($student);
            if ($phone && !in_array($phone, $phones)) {
                $phones[] = $phone;
            }
        }

        return $phones;
    }

    /**
     * الحصول على رقم هاتف ولي أمر الطالب
     *
     * @param Student $student
     * @return string|null
     */
    protected function getStudentParentPhone($student): ?string
    {
        if (!$student->myparent) {
            return null;
        }

        $parent = $student->myparent;

        // محاولة رقم الأب أولاً، ثم الأم
        if (!empty($parent->Phone_Father)) {
            return $parent->Phone_Father;
        }

        if (!empty($parent->Phone_Mother)) {
            return $parent->Phone_Mother;
        }

        return null;
    }

    /**
     * سجل رسائل واتساب المرسلة
     * ملاحظة: السجل يعتمد على Laravel Log، في الإنتاج يمكن استخدام قاعدة بيانات لتتبع الرسائل
     */
    public function logs()
    {
        // قراءة سجل الرسائل من ملف log
        $logFile = storage_path('logs/laravel.log');
        $logs = [];

        if (file_exists($logFile)) {
            $content = file_get_contents($logFile);
            // استخراج أسطر WhatsAppService
            preg_match_all('/\[.*?\].*?WhatsAppService.*?\n/', $content, $matches);

            $logs = array_slice(array_reverse($matches[0] ?? []), 0, 100);
        }

        return view('pages.WhatsApp.logs', compact('logs'));
    }

    /**
     * إخفاء قيمة حساسة (للعرض)
     *
     * @param string $value
     * @return string
     */
    protected function maskValue(string $value): string
    {
        if (strlen($value) <= 4) {
            return '****';
        }
        return substr($value, 0, 4) . str_repeat('*', strlen($value) - 8) . substr($value, -4);
    }
}
