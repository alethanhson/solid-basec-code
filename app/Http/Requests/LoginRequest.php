<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email:rfc,dns',
            'password' => 'required|min:6|max:20',
        ];
    }
}
