<?php

namespace App\Http\Requests\Backsite\Operational;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

use Gate;

class StoreCustomerUsageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        abort_if(Gate::denies('customer_usage_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
            'customer_id' => [
                'required',
                'integer',
                'exists:customer,id'
            ],
            'date_usage' => [
                'required',
                'string',
                'max:255'
            ],
            'start_meter' => [
                'required',
                'string',
                'max:255'
            ],
            'end_meter' => [
                'required',
                'string',
                'max:255'
            ],
            'date_usage' => [
                'required',
                'string',
                'max:255'
            ],
        ];
    }
}
