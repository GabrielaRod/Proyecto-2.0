<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreLocationRequest extends FormRequest
{
    public function rules()
    {
        return [
            'Location'=> [
                'string',
                'required',
            ],
            'Latitude'=> [
                'numeric',
                'required',
            ],
            'Longitude'=> [
                'numeric',
                'required',
            ],
            
        ];
    }

    public function authorize()
    {
        return Gate::allows('user_access');
    }
}