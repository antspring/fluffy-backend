<?php

namespace App\Services\Order\Contracts;

use App\Http\Requests\Order\StoreOrderRequest;

interface OrderServiceInterface
{
    public function create(StoreOrderRequest $request);
}
