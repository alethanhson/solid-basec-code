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

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'email' => ':attribute không đúng định dạng',
            'min' => ':attribute có ít nhất :min ký tự',
            'max' => ':attribute có nhiều nhất nhất :min ký tự',
        ];
    }

    public function attributes()
    {
        return [
            'password' => 'mật khẩu',
        ];
    }
}
