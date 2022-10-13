<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePwRequest extends FormRequest
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
            'user_password'=>'required|max:20|min:5|',
        ];
    }
    public function messages()
    {
            return [
                'user_password.required' => 'bạn chưa nhập mật khẩu mới',
                'user_password.max'=>'mật khẩu không được vượt quá 20 ký tự',
                'user_password.min'=>'mật khẩu từ 5 ký tự trở lên',
            ];
    }
}
