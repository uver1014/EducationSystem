<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDeliveryRequest extends FormRequest
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
            'delivery_from_date.*'   => 'nullable|regex:/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',
            'delivery_from_time.*'   => 'nullable|regex:/^[0-9:]+$/',
            'delivery_to_date.*'     => 'nullable|regex:/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',
            'delivery_to_time.*'     => 'nullable|regex:/^[0-9:]+$/',
        ];
    }

    public function messages(): array
    {
        return [
        'delivery_from_date.*.regex' => '開始日付は半角英数字で入力してください。',
        'delivery_from_time.*.regex' => '開始時刻は半角英数字で入力してください。',
        'delivery_to_date.*.regex'  => '終了日付は半角英数字で入力してください。',
        'delivery_to_time.*.regex'   => '終了時刻は半角英数字で入力してください。',
        ];
    }
}
