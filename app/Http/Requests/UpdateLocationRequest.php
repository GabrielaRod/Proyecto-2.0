<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateLocationRequest extends FormRequest
{
    public function rules()
    {
        return [
            'Location'=> [
                'string',
            ],
            'Latitude'=> [
                'numeric',
            ],
            'Longitude'=> [
                'numeric',
            ],
            
        ];
    }

    public function authorize()
    {
        return Gate::allows('user_access');
    }
}