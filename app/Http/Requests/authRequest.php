<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class authRequest extends FormRequest
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
            'name' => 'required|max:100',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password|min:6',


        ];
    }

    public function messages(){
        return[
            'name.required' => __('messages.regname'),
            'name.max'=>'Name letter max is 100',
            'email.required' => __('messages.emailrequired'),
            'email.unique' =>__('messages.emailunique'),
            'password.required' => __('messages.regpassrequired'),
            'password.min' => __('messages.minpassword'),
            'password_confirmation.required' => __('messages.confirmpassword'),
            'password_confirmation.same' => __('messages.confirmpasswordsame'),
        ];
    }
}
