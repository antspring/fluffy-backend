<?php

namespace App\Services\Employee\Implementations;

use App\Http\Requests\Employee\LoginEmployeeRequest;
use App\Http\Requests\Employee\RegisterEmployeeRequest;
use App\Repositories\Employee\Contracts\EmployeeRepositoryInterface;
use App\Services\Employee\Contracts\EmployeeServiceInterface;
use Illuminate\Support\Facades\Hash;

class EmployeeService implements EmployeeServiceInterface
{
    public function __construct(private EmployeeRepositoryInterface $employeeRepository)
    {
    }

    public function login(LoginEmployeeRequest $request)
    {
        $employee = $this->employeeRepository->where('login', $request->input('login'))->first();

        if (!Hash::check($request->input('password'), $employee->password)) {
            return response()->json(['message' => 'Incorrect password'], 401);
        }

        $employee->assignRole('employee');

        $token = $employee->createToken('auth_token')->plainTextToken;

        return response()->json(['token' => $token]);
    }

    public function register(RegisterEmployeeRequest $request)
    {
        $employee = $this->employeeRepository->create($request->validated());

        $employee->assignRole('employee');

        $token = $employee->createToken('auth_token')->plainTextToken;

        return response()->json(['token' => $token]);
    }
}
