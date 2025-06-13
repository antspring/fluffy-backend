<?php

namespace App\Repositories\Order\Contracts;

use App\Models\Order\Order;
use App\Repositories\Contracts\RepositoryInterface;

interface OrderRepositoryInterface extends RepositoryInterface
{
    public function attachProducts(Order $concreteOrder, array $attachableProducts);
}
