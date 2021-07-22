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
            'app_user_id'    => [
                'integer',
            ],
        ];
    }

    public function authorize()
    {
        return Gate::allows('user_access');
    }
}