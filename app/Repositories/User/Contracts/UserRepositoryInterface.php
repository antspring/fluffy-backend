<?php

namespace App\Repositories\User\Contracts;

use App\Models\User;
use App\Repositories\Contracts\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function getOrdersWithProducts(User $user);
}
