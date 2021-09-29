<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateVehicleRequest extends FormRequest
{
    public function rules()
    {
        return [
            'Status'    => [
                'string',
            ],
            'app_users.*'    => [
                'integer',
            ],
            'app_users'    => [
                'required',
                'array',
            ],
        ];
    }

    public function authorize()
    {
        return Gate::allows('user_access');
    }
}
