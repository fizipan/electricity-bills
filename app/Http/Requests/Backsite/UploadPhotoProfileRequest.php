<?php

namespace App\Http\Requests\Backsite;

use Illuminate\Foundation\Http\FormRequest;

class UploadPhotoProfileRequest extends FormRequest
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
            'photo'    => [
                'required', 'mimes:jpeg,svg,png', 'max:5000',
            ],
        ];
    }
}
