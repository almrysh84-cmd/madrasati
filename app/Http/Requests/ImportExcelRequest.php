<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * التحقق من صحة ملفات Excel المستوردة
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class ImportExcelRequest extends FormRequest
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
            'file' => 'required|file|mimes:xlsx,xls,csv|max:5120',
        ];
    }

    /**
     * رسائل التحقق المخصصة
     */
    public function messages()
    {
        return [
            'file.required' => trans('Excel_trans.file_required'),
            'file.file' => trans('Excel_trans.file_invalid'),
            'file.mimes' => trans('Excel_trans.file_mimes'),
            'file.max' => trans('Excel_trans.file_max'),
        ];
    }
}
