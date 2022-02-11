<?php

namespace App\Http\Requests\Backsite\MasterData;

use Illuminate\Foundation\Http\FormRequest;

use Symfony\Component\HttpFoundation\Response;

use Gate;

class UpdateGroupRateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        abort_if(Gate::denies('group_rate_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
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
            'name' =>  [
                'required', 'string', 'unique:group_rate,name', 'max:255',
            ]
        ];
    }
}
