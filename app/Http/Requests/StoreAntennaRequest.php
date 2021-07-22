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
            'Status'=> [
                'string',
                'required',
            ],
            'coordinate_id.*'=> [                
                'integer',
            ],
            'coordinate_id'=> [
                'array',
                'required',
            ],
            
        ];
    }

    public function authorize()
    {
        return Gate::allows('antenna_access');
    }
}