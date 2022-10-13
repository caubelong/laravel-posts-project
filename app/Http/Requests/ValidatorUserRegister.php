<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidatorUserRegister extends FormRequest
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
            'user_name'=>'required|max:30|min:3',
            'user_email'=>'email|required|unique:users',
            'user_password'=>'required|max:20|min:5|confirmed',
            'user_password_confirmation'=>'required',
            'phone'=>'required|min:9|max:13|unique:users',
        ];
    }
    public function messages()
    {
            return [
                'user_name.required'=>'vui lòng nhập tên người dùng',
                'user_name.max'=>'tên người dùng không được vượt quá 30 ký tự',
                'user_name.min'=>'tên người dùng không được nhỏ hơn 3 ký tự',
                'user_email.required'=>'vui lòng nhập email',
                'user_email.email'=>'vui lòng nhập đúng định dạng email',
                'user_email.unique'=>'email này đã được đăng ký cho tài khoản khác',
                'user_password.required'=>'vui lòng nhập mật khẩu',
                'user_password.max'=>'mật khẩu không được vượt quá 20 ký tự',
                'user_password.min'=>'mật khẩu từ 5 ký tự trở lên',
                'user_password.confirmed'=>'mật khẩu không khớp',
                'user_password_confirmation.required'=>'vui lòng xác nhận lại mật khẩu',
                'phone.required'=>'vui lòng nhập số điện thoại của bạn',
                'phone.max'=>'số điện thoại không vượt quá 100 chữ số',
                'phone.min'=>'số điện thoại phải từ 9 chữ số trở lên',
                'phone.numeric'=>'số điện thoại không đúng định dạng'
            ];
    }
}
