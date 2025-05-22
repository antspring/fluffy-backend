<?php

namespace App\Services\Employee\Contracts;

use App\Http\Requests\Employee\LoginEmployeeRequest;
use App\Http\Requests\Employee\RegisterEmployeeRequest;

interface EmployeeServiceInterface
{
    public function login(LoginEmployeeRequest $request);

    public function register(RegisterEmployeeRequest $request);
}
