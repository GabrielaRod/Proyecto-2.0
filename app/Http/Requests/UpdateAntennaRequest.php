<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateAntennaRequest extends FormRequest
{
    public function rules()
    {
        return [
            'MacAddress' => [
                'required', 'string',
            ]
        ];
    }

    public function authorize()
    {
        return Gate::allows('user_access');
    }
}