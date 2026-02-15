<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
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
            'content' => 'required|string|max:20',
            'category_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'content.required' => '内容を入力してください',
            'content.string' => '内容を文字列で入力してください',
            'content.max' => '内容を20文字以下で入力してください',
            'category_id.required' => 'カテゴリを選択してください',
        ];
    }

}
