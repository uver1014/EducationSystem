<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'  => 'required | max:255',
            'name_kana' => 'required | max:255 | regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u',
            'email' => 'required | max:255',

        ];
    }

    /**
     * 項目名
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'ユーザーネーム',
            'name_kana' => 'カナ',
            'email' => 'メールアドレス',
        ];
    }

    /**
     * エラーメッセージ
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => ':attributeは必須項目です。',
            'name.max' => ':attributeは:max字以内で入力してください。',
            'name_kana.required' => ':attributeは必須項目です。',
            'name_kana.max' => ':attributeは:max字以内で入力してください。',
            'name_kana.regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u' => ':attributeカタカナで入力してください。',
            'email.required' => ':attributeは必須項目です。',
            'email.max' => ':attributeは:max字以内で入力してください。',
        ];
    }
}
