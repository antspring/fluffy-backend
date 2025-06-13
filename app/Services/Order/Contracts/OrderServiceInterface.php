<?php

namespace App\Services\Order\Contracts;

use App\Http\Requests\Order\StoreOrderRequest;
use App\Models\Order\Order;

interface OrderServiceInterface
{
    public function create(StoreOrderRequest $request);

    public function cancelOrder(Order $order);
}
