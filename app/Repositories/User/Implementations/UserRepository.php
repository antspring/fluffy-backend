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

    public function getOrdersWithProducts(User $user)
    {
        return $user->orders()->orderBy('created_at', 'desc')->with('products')->get();
    }
}
