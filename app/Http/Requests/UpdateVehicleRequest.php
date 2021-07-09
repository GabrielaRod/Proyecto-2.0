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
            'user_id'    => [
                'integer',
                'required',
            ],
            'id'   => [
                'required',
                'unique:VIN,' . request()->route('tag')->id,
            ],
        ];
    }

    public function authorize()
    {
        return Gate::allows('user_access');
    }
}