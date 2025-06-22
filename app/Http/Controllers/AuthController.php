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
        $result = $this->userServiceInterface->sendCode($request);

        if ($result['success']) {
            return response()->json(['message' => 'Code sent successfully!', 'code' => $result['code']]);
        } else {
            return response()->json(['message' => 'Code not sent!'], 500);
        }
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
