<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\User\CreateUserService;
use App\Services\User\DeleteUserService;
use App\Services\User\GetUserService;
use App\Services\User\ShowUserService;
use App\Services\User\UpdateUserService;
use Illuminate\Http\Request;
use App\Traits\APIResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use APIResponse;

    /**
     * Get all users.
     *
     * @param RegisterRequest $request
     * @return Response
     */
    public function index(Request $request)
    {
        $users = resolve(GetUserService::class)->setParams($request)->handle();

        return $this->responseSuccessWithData($users);
    }

    /**
     * Create user.
     *
     * @param CreateUserRequest $request
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($request->password);

        $user = resolve(CreateUserService::class)->setParams($data)->handle();

        return $user ? $this->responseSuccess() : $this->responseError();
    }

    /**
     * Show user by ID.
     *
     * @param int $userId
     * @return Response
     */
    public function show(int $userId)
    {
        $user = resolve(ShowUserService::class)->setParams($userId)->handle();

        return $this->responseSuccessWithData($user);
    }

    /**
     * Update user's information.
     *
     * @param UpdateUserRequest $request
     * @param int $userId
     * @return Response
     */
    public function update(UpdateUserRequest $request, int $userId)
    {
        $data['information'] = $request->validated();
        $data['id'] = $userId;

        $user = resolve(UpdateUserService::class)->setParams($data)->handle();

        return $user ? $this->responseSuccess() : $this->responseError();
    }

    /**
     * Delete user by ID.
     *
     * @param int $userId
     * @return Response
     */
    public function delete(int $userId)
    {
        $user = resolve(DeleteUserService::class)->setParams($userId)->handle();

        return $user ? $this->responseSuccess() : $this->responseError();
    }
}
