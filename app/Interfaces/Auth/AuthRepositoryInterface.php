<?php

namespace App\Interfaces\Auth;

interface AuthRepositoryInterface
{
    public function register(array $data);

    public function login(array $data);
}