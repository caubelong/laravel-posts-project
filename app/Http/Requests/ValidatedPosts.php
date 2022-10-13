<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidatedPosts extends FormRequest
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
            'title'=> 'required|min:5|max:300|',
            'body'=>'required|min:20',
            'category_id'=>'required',
            'option_show'=>'required',
            'description'=>'required|min:5|max:700'
        ];
    }
    public function messages()
    {
        return [
            'title.required'=>'Vui lòng nhập tiêu đề của tin tức',
            'title.min'=>'Phần tiêu đề không được nhỏ hơn 5 ký tự',
            'title.max'=>'Phần tiêu đề không được nhiều hơn 700 ký tự',
            'category_id.required'=>'Phải chọn danh mục cho tin tức',
            'body.required'=>'Phần nội dung tin tức không được bỏ trống',
            'body.min'=>'Phần nội dung tin tức không được nhỏ hơn 20 ký tự',
            'option_show.required'=>'Phần trạng thái hiển thị của tin không được bỏ trống',
            'description.required'=>'Phần mô tả tin tức không được bỏ trống',
            'description.min'=>'Phần mô tả tin tức  không được nhỏ hơn 5 ký tự',
            'description.max'=>'Phần mô tả tin tức  không được nhiều hơn 300 ký tự',
        ];
    }
}
