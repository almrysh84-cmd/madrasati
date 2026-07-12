<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * طلب التحقق من إرسال رسالة واتساب جماعية (Feature 7)
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class WhatsAppBulkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'target_type'   => 'required|in:all_parents,grade_parents,classroom_parents,custom',
            'grade_id'      => 'nullable|required_if:target_type,grade_parents|required_if:target_type,classroom_parents|exists:grades,id',
            'classroom_id'  => 'nullable|required_if:target_type,classroom_parents|exists:classrooms,id',
            'custom_phones' => 'nullable|required_if:target_type,custom|string',
            'message'       => 'required|string|min:5|max:1000',
        ];
    }

    /**
     * رسائل التحقق بالعربية
     */
    public function messages(): array
    {
        return [
            'target_type.required'   => 'يجب تحديد نوع الاستهداف',
            'target_type.in'         => 'نوع الاستهداف غير صحيح',
            'grade_id.required_if'   => 'يجب تحديد المرحلة الدراسية',
            'grade_id.exists'        => 'المرحلة الدراسية غير موجودة',
            'classroom_id.required_if' => 'يجب تحديد الفصل',
            'classroom_id.exists'    => 'الفصل غير موجود',
            'custom_phones.required_if' => 'يجب إدخال أرقام الهاتف',
            'message.required'       => 'نص الرسالة مطلوب',
            'message.min'            => 'نص الرسالة قصير جداً (5 أحرف على الأقل)',
            'message.max'            => 'نص الرسالة طويل جداً (1000 حرف كحد أقصى)',
        ];
    }
}
