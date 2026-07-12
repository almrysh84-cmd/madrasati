<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionBankRequest extends FormRequest
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
            'question_ar'   => 'required|string|max:1000',
            'question_en'   => 'nullable|string|max:1000',
            'type'          => 'required|in:mcq,true_false,essay',
            'level'         => 'required|in:easy,medium,hard',
            'score'         => 'required|numeric|min:0.5|max:100',
            'subject_id'    => 'required|exists:subjects,id',
            'Grade_id'      => 'required|exists:grades,id',
            'options'       => 'required_if:type,mcq|array|min:2|max:6',
            'options.*'     => 'nullable|string|max:500',
            'correct_answer' => 'required_if:type,mcq,true_false|nullable|string',
            'is_shared'     => 'nullable|boolean',
        ];
    }

    /**
     * رسائل التحقق المخصصة بالعربية
     */
    public function messages()
    {
        return [
            'question_ar.required'       => 'نص السؤال بالعربية مطلوب',
            'question_ar.string'         => 'نص السؤال يجب أن يكون نصاً',
            'question_ar.max'            => 'نص السؤال يجب ألا يتجاوز 1000 حرف',
            'type.required'              => 'نوع السؤال مطلوب',
            'type.in'                    => 'نوع السؤال يجب أن يكون: اختيار من متعدد، صح/خطأ، أو مقالي',
            'level.required'             => 'مستوى الصعوبة مطلوب',
            'level.in'                   => 'مستوى الصعوبة يجب أن يكون: سهل، متوسط، أو صعب',
            'score.required'             => 'درجة السؤال مطلوبة',
            'score.numeric'              => 'درجة السؤال يجب أن تكون رقماً',
            'score.min'                  => 'درجة السؤال يجب ألا تقل عن 0.5',
            'score.max'                  => 'درجة السؤال يجب ألا تتجاوز 100',
            'subject_id.required'        => 'المادة الدراسية مطلوبة',
            'subject_id.exists'          => 'المادة الدراسية المحددة غير موجودة',
            'Grade_id.required'          => 'المرحلة الدراسية مطلوبة',
            'Grade_id.exists'            => 'المرحلة الدراسية المحددة غير موجودة',
            'options.required_if'        => 'خيارات الإجابة مطلوبة لأسئلة الاختيار من متعدد',
            'options.array'              => 'خيارات الإجابة يجب أن تكون في صيغة مصفوفة',
            'options.min'                => 'يجب توفير خيارين على الأقل',
            'options.max'                => 'الحد الأقصى لخيارات الإجابة هو 6 خيارات',
            'correct_answer.required_if' => 'الإجابة الصحيحة مطلوبة لأسئلة الاختيار من متعدد وصح/خطأ',
        ];
    }
}
