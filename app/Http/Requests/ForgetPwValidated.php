<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForgetPwValidated extends FormRequest
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
            'phone'=>'required|min:9|max:13',
        ];
    }
    public function messages()
    {
            return [
                'user_email.required'=>'vui lòng nhập email',
                'user_email.email'=>'vui lòng nhập đúng định dạng email',
                'phone.required'=>'vui lòng nhập số điện thoại của bạn',
                'phone.max'=>'số điện thoại không vượt quá 100 chữ số',
                'phone.min'=>'số điện thoại phải từ 9 chữ số trở lên',
                'phone.numeric'=>'số điện thoại không đúng định dạng'
            ];
    }
}
