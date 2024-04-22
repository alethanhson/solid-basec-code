<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\User\UserRepository;
use App\Services\User\CreateUserService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Register a new user with the provided registration request.
     *
     * @param RegisterRequest $request
     * @return Response
     */
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($request->password);
        $user = resolve(CreateUserService::class)->setParams($data)->handle();

        if ($user) {
            return response()->json([
                'message' => __('message.success_register'),
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => __('message.error_register')
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * Login by email and password.
     *
     * @param LoginRequest $request
     * @return Response
     */
    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        if (Auth::attempt(
            [
                'email' => $data['email'],
                'password' => $data['password'],
            ]
        )) {
            $user = resolve(UserRepository::class)->findByEmail($data['email']);

            return response()->json([
                'message' => __('message.success_login'),
                'success' => $user,
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => __('message.error_login'),
        ], Response::HTTP_UNAUTHORIZED);
    }
}
