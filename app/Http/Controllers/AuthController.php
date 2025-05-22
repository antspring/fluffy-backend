<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CodeRequest;
use App\Http\Requests\User\LoginUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Services\User\Contracts\UserServiceInterface;

class AuthController extends Controller
{
    public function __construct(private readonly UserServiceInterface $userServiceInterface)
    {

    }

    public function sendCode(CodeRequest $request)
    {
        return $this->userServiceInterface->sendCode($request);
    }

    public function register(StoreUserRequest $request)
    {
        return $this->userServiceInterface->register($request);
    }

    public function login(LoginUserRequest $request)
    {
        return $this->userServiceInterface->login($request);
    }
}
