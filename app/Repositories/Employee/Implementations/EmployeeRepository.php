<?php

namespace App\Repositories\Employee\Implementations;

use App\Models\Employee;
use App\Repositories\Employee\Contracts\EmployeeRepositoryInterface;
use App\Repositories\Implementations\BaseRepository;

class EmployeeRepository extends BaseRepository implements EmployeeRepositoryInterface
{
    public function __construct()
    {
        $this->model = new Employee();
    }
}
