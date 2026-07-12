<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnnouncementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'title'           => 'required|string|max:255',
            'body'            => 'required|string',
            'target_audience' => 'required|in:admin,teachers,students,parents,all',
            'publish_at'      => 'nullable|date|after_or_equal:today',
            'creator_type'    => 'nullable|string|in:admin,teacher',
            'attachment'      => 'nullable|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png,zip',
        ];

        // عند التحديث لا نطالب بالمرفق
        if ($this->isMethod('PUT')) {
            $rules['id'] = 'required|exists:announcements,id';
        }

        return $rules;
    }

    /**
     * رسائل التحقق بالعربية
     */
    public function messages()
    {
        return [
            'title.required'           => 'عنوان الإعلان مطلوب',
            'title.string'             => 'عنوان الإعلان يجب أن يكون نصاً',
            'title.max'                => 'عنوان الإعلان لا يجب أن يتجاوز 255 حرفاً',
            'body.required'            => 'محتوى الإعلان مطلوب',
            'body.string'              => 'محتوى الإعلان يجب أن يكون نصاً',
            'target_audience.required' => 'الجمهور المستهدف مطلوب',
            'target_audience.in'       => 'الجمهور المستهدف غير صحيح',
            'publish_at.date'          => 'تاريخ النشر غير صحيح',
            'publish_at.after_or_equal'=> 'لا يمكن تحديد تاريخ نشر في الماضي',
            'attachment.file'          => 'المرفق يجب أن يكون ملفاً صالحاً',
            'attachment.max'           => 'حجم المرفق يجب ألا يتجاوز 10 ميجابايت',
            'attachment.mimes'         => 'صيغة المرفق غير مدعومة. الصيغ المدعومة: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, JPG, PNG, ZIP',
            'id.required'              => 'معرف الإعلان مطلوب',
            'id.exists'                => 'الإعلان غير موجود',
        ];
    }
}
