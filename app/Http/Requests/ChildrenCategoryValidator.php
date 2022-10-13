<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChildrenCategoryValidator extends FormRequest
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
            'name' => 'required|min:3|max:30',
            'parent_id'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'tên danh mục không được để trống',
            'name.min' => 'tên danh mục không nhỏ hơn 3 ký tự',
            'name.max'=>'tên danh mục không lớn hơn 30 ký tự',
//            'category_name.unique'=>'tên danh mục đã tồn tại',
            'parent_id.required'=>'bạn chưa chọn danh mục lớn ',

        ];
    }
}
