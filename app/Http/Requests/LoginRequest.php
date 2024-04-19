<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
        ];
    }

    public function attributes()
    {
        return [
            'password' => 'mật khẩu',
        ];
    }
}
