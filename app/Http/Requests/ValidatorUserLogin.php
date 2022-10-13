<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidatorUserLogin extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'user_email'=>'email|required',
            'user_password'=>'required',
        ];
    }
    public function messages()
    {
        return[
            'user_email.required'=>'vui lòng nhập email',
            'user_email.email'=>'vui lòng nhập đúng định dạng email',
            'user_password.required'=>'vui lòng nhập mật khẩu',
        ];
    }
}
