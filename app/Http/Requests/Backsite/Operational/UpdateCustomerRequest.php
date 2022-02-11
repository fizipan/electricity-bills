<?php

namespace App\Http\Requests\Backsite\Operational;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        abort_if(Gate::denies('customer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
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
            'name'     => [
                'required', 'string', 'max:150',
            ],
            'mobile_phone' => [
                'nullable', 'string', 'max:255',
            ],
            'rate_id' => [
                'required',
                'integer',
                'exists:rate,id'
            ],
            'address' => [
                'nullable', 'string', 'max:5000',
            ],
        ];
    }
}
