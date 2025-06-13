<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCurriculumRequest extends FormRequest
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
            'thumbnail' => 'string',
            'grade' => 'required|integer',
            'title' => 'required|string|max:255',
            'video_url' => 'required|url',
            'description' => 'required|string',
            'alway_delivery_flg' => 'nullable|boolean',
        ];
    }

    public function messages()
    {
        return [
            'grade.required' => '学年は必須です',
            'title.required' => '授業名は必須です',
            'video_url.required' => '動画URLは必須です',
            'description.required' => '授業概要は必須です',
            'thumbnail.string' => 'サムネイルの値が不正です',
            'grade.integer' => '学年は数字で指定してください',
            'title.string' => '授業名は文字列で入力してください',
            'title.max' => '授業名は255文字以内で入力してください',
            'video_url.url' => '動画URLは有効なURLを入力してください',
            'description.string' => '授業概要は文字列で入力してください',
            'alway_delivery_flg.boolean' => '常時公開フラグの値が不正です',
        ];
    }
}
