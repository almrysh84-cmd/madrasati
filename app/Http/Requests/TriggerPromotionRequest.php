<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TriggerPromotionRequest extends FormRequest
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
        return [
            'grade_id'            => 'nullable|exists:grades,id',
            'classroom_id'        => 'nullable|exists:classrooms,id',
            'section_id'          => 'nullable|exists:sections,id',
            'to_grade_id'         => 'required|exists:grades,id',
            'to_classroom_id'     => 'required|exists:classrooms,id',
            'to_section_id'       => 'required|exists:sections,id',
            'academic_year'       => 'nullable|string',
            'academic_year_new'   => 'nullable|string',
            'min_average'         => 'nullable|numeric|min:0|max:100',
            'max_failed_subjects' => 'nullable|integer|min:0|max:20',
        ];
    }

    public function messages()
    {
        return [
            'to_grade_id.required'       => 'المرحلة الجديدة مطلوبة',
            'to_grade_id.exists'         => 'المرحلة الجديدة غير موجودة',
            'to_classroom_id.required'   => 'الصف الجديد مطلوب',
            'to_classroom_id.exists'     => 'الصف الجديد غير موجود',
            'to_section_id.required'     => 'القسم الجديد مطلوب',
            'to_section_id.exists'       => 'القسم الجديد غير موجود',
            'grade_id.exists'            => 'المرحلة غير موجودة',
            'classroom_id.exists'        => 'الصف غير موجود',
            'section_id.exists'          => 'القسم غير موجود',
            'min_average.numeric'        => 'المتوسط الأدنى يجب أن يكون رقماً',
            'min_average.min'            => 'المتوسط الأدنى لا يمكن أن يكون أقل من 0',
            'min_average.max'            => 'المتوسط الأدنى لا يمكن أن يكون أكثر من 100',
            'max_failed_subjects.integer'=> 'عدد المواد الراسبة يجب أن يكون رقماً صحيحاً',
        ];
    }
}
