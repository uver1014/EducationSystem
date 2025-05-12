<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBannerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize():bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules():array
    {
        return [
               'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'old_images.*' => 'nullable|string',
            'delete_ids.*' => 'nullable|integer',
        ];
    }
}
