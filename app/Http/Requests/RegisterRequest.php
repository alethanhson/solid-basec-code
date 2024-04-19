<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&"*()\-_=+{};:,<.>]).{6,255}+$/',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'max' => ':attribute có nhiều nhất :max ký tự',
            'email' => ':attribute Phải là dạng email',
            'min' => ':attribute có ít nhất :min ký tự',
            'confirmed' => 'nhập lại :attribute không đúng',
            'regex' => ':attribute phải chứa ký tự In Hoa và ký tự đặc biệt',
            'unique' => 'email đã tồn tại',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Tên',
            'password' => 'mật khẩu',
        ];
    }
}
