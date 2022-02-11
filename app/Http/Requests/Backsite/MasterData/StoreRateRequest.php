<?php

namespace App\Http\Requests\Backsite\MasterData;

use Illuminate\Foundation\Http\FormRequest;

use Symfony\Component\HttpFoundation\Response;

use Gate;

class StoreRateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        abort_if(Gate::denies('rate_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
            'group_rate_id' => [
                'required', 'integer', 'exists:group_rate,id',
            ],
            'power' => [
                'required', 'string', 'max:255',
            ],
            'rate_power' => [
                'required', 'string', 'max:255',
            ]
        ];
    }
}
