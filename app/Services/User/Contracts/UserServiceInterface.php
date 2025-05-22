<?php

namespace App\Services\User\Contracts;

use App\Http\Requests\User\CodeRequest;
use App\Http\Requests\User\LoginUserRequest;
use App\Http\Requests\User\StoreUserRequest;

interface UserServiceInterface
{
    public function sendCode(CodeRequest $request);

    public function register(StoreUserRequest $request);

    public function login(LoginUserRequest $request);
}
