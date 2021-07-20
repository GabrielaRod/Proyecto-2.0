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
                'required',
            ],
            'app_users_id'    => [
                'integer',
                'required',
            ],
            'id'   => [
                'required',
                'unique:VIN',
            ],
        ];
    }

    public function authorize()
    {
        return Gate::allows('user_access');
    }
}