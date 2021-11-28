<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateNotificationRequest extends FormRequest
{
    public function rules()
    {
        return [
            'Message' => [
                'string',
            ],
            'Read' => [
                'boolean',
            ]
        ];
    }

    public function authorize()
    {
        return Gate::allows('user_access');
    }
}
