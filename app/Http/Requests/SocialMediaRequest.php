<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SocialMediaRequest extends FormRequest
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
            'website'  => 'nullable|url',
            'facebook' => 'nullable|url|regex:/http[s]?:\/\/(?:www\.)facebook\.com\/.+/i',
            'twitter'  => 'nullable|url|regex:/http[s]?:\/\/(?:www\.)twitter\.com\/.+/i',
            'linkedin' => 'nullable|url|regex:/http[s]?:\/\/(?:www\.)linkedin\.com\/.+/i',
        ];
    }
}