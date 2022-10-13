<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserManagerRequest extends FormRequest
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
            'usesr_name'=>'required|max:30|min:3',
            'user_email'  => 'required|unique:users,user_email,' . $this->id . ',u_id,u_id,' . $this->u_id,
            'phone'  => 'required|unique:users,phone,' . $this->id . ',u_id,u_id,' . $this->u_id,
        ];
    }
    public function messages()
    {
            return [
                'usesr_name.required'=>'vui lòng nhập tên người dùng',
                'usesr_name.max'=>'tên người dùng không được vượt quá 30 ký tự',
                'usesr_name.min'=>'tên người dùng không được nhỏ hơn 3 ký tự',
                'user_email.required'=>'vui lòng nhập email',
                'user_email.email'=>'vui lòng nhập đúng định dạng email',
                'user_email.unique'=>'email này đã được đăng ký cho tài khoản khác',
                'phone.unique'=>'số điện thoại này đã được đăng ký cho tài khoản khác',
                'phone.required'=>'vui lòng nhập số điện thoại của bạn',
                'phone.max'=>'số điện thoại không vượt quá 100 chữ số',
                'phone.min'=>'số điện thoại phải từ 9 chữ số trở lên',
                'phone.numeric'=>'số điện thoại không đúng định dạng'
            ];
    }
}
