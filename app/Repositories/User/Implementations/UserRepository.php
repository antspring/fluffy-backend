<?php

namespace App\Repositories\User\Implementations;

use App\Models\User;
use App\Repositories\Implementations\BaseRepository;
use App\Repositories\User\Contracts\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct()
    {
        $this->model = new User();
    }
}
