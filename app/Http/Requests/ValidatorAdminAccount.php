<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidatorAdminAccount extends FormRequest
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
            'ad_name'=>'required|max:30|min:3|unique:admins',
            'ad_email'=>'email|required|unique:admins',
            'ad_password'=>'required|max:20|min:5|',
            'role'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'ad_name.required'=>'vui lòng nhập tên',
            'ad_name.unique'=>'tên này đã được đăng ký',
            'ad_name.max'=>'tên không được vượt quá 30 ký tự',
            'ad_name.min'=>'tên không được nhỏ hơn 3 ký tự',
            'ad_email.required'=>'vui lòng nhập email',
            'ad_email.email'=>'vui lòng nhập đúng định dạng email',
            'ad_email.unique'=>'email này đã được đăng ký',
            'ad_password.required'=>'vui lòng nhập mật khẩu',
            'ad_password.max'=>'mật khẩu không được vượt quá 20 ký tự',
            'ad_password.min'=>'mật khẩu từ 5 ký tự trở lên',
            'role.required'=>'chưa chọn quyền hạn của tài khoản'
        ];
    }
}
