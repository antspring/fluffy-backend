<?php

namespace App\Repositories\Order\Implementations;

use App\Models\Order\Order;
use App\Repositories\Implementations\BaseRepository;
use App\Repositories\Order\Contracts\OrderRepositoryInterface;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function __construct()
    {
        $this->model = new Order();
    }

    public function attachProducts(Order $concreteOrder, array $attachableProducts)
    {
        $concreteOrder->products()->attach($attachableProducts);
    }

    public function getAllSortedOrdersWithProducts()
    {
        return $this->model->orderBy('created_at', 'desc')->with('products')->get();
    }
}
