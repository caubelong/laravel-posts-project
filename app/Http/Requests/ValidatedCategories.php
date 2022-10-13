<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidatedCategories extends FormRequest
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
            'category_name'=>'required|min:3|max:30|string',
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'category_name.required' => 'tên danh mục không được để trống',
//            'category_name.unique'=>'tên danh mục đã tồn tại',
            'category_name.min'=>'tên danh mục phải có từ 3 ký tự trở lên',
            'category_name.max'=>'tên danh mục phải nhỏ hơn 30 ký tự',
            'category_name.string'=>'tên không được có chữ số',

        ];
    }
}
