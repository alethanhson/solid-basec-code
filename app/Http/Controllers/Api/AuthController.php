<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\User\CreateUserService;
use App\Services\User\FindByEmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $user = resolve(CreateUserService::class)->setParams($data)->handle();

        if ($user) {
            return response()->json([
                'message' => 'Register successfully',
            ], 200);
        } else {
            return response()->json([
                'error' => 'Registration failed'
            ], 500);
        }
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt(
            [
                'email' => $request->email,
                'password' => $request->password,
            ]
        )) {
            $user = resolve(FindByEmailService::class)->setParams($request)->handle();

            return response()->json([
                'message' => 'Login successfully',
                'success' => $user,
            ], 200);
        } else {
            return response()->json([
                'error' => 'Unauthorised'
            ], 401);
        }
    }
}
