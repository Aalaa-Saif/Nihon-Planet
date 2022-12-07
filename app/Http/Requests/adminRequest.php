<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class adminRequest extends FormRequest
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
            'name_ar' => 'required|max:40',
            'info_ar' => 'required|max:40',
            'name_en' => 'required|max:40',
            'info_en' => 'required|max:40',
        ];
    }

    public function messages()
    {
        return[
            'name_ar.required' => "Must write a Title in Arabic",
            'name_ar.max'=>'Max Arabic letters is 40',
            'info_ar.required' => 'Write a description in Arabic',
            'name_en.required' =>"Must write a Title in English",
            'name_en.max' =>'Max English letters is 40',
            'info_en.required' =>'Write a description in English',
        ];
    }
}
