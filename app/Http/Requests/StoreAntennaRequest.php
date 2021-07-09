<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreAntennaRequest extends FormRequest
{
    public function rules()
    {
        return [
            'MacAddress'=> [
                'string',
                'required',
            ],
            'Location'=> [
                'required',
                'unique:antennas',
            ],
            'coordinate_id.*'=> [                
                'integer',
            ],
            'coordinate_id'=> [
                'required',
                'array',
            ],
            'Status'=> [
                'string',
                'required',
            ],
        ];
    }

    public function authorize()
    {
        return Gate::allows('antenna_access');
    }
}