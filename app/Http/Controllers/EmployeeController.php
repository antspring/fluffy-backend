<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\LoginEmployeeRequest;
use App\Http\Requests\Employee\RegisterEmployeeRequest;
use App\Services\Employee\Contracts\EmployeeServiceInterface;

class EmployeeController extends Controller
{
    public function __construct(private readonly EmployeeServiceInterface $employeeService)
    {
    }

    public function login(LoginEmployeeRequest $request)
    {
        return $this->employeeService->login($request);
    }

    public function register(RegisterEmployeeRequest $request)
    {
        return $this->employeeService->register($request);
    }
}
