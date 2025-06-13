<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\StoreOrderRequest;
use App\Services\Order\Contracts\OrderServiceInterface;

class OrderController extends Controller
{
    public function __construct(private readonly OrderServiceInterface $orderService)
    {
    }

    public function store(StoreOrderRequest $request)
    {
        $order = $this->orderService->create($request);

        return $order->toResource();
    }
}
