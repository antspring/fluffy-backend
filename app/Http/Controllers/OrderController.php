<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Resources\Order\OrderWithProductsResource;
use App\Models\Order\Order;
use App\Repositories\Order\Contracts\OrderRepositoryInterface;
use App\Repositories\User\Contracts\UserRepositoryInterface;
use App\Services\Order\Contracts\OrderServiceInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(private readonly OrderServiceInterface    $orderService,
                                private readonly UserRepositoryInterface  $userRepository,
                                private readonly OrderRepositoryInterface $orderRepository)
    {
    }

    public function index()
    {
        $orders = $this->orderRepository->getAllSortedOrdersWithProducts();

        return OrderWithProductsResource::collection($orders);
    }

    public function show(Order $order)
    {
        return new OrderWithProductsResource($order);
    }

    public function store(StoreOrderRequest $request)
    {
        $order = $this->orderService->create($request);

        return $order->toResource();
    }

    public function cancelOrder(Order $order)
    {
        $this->orderService->cancelOrder($order);
    }

    public function completeOrder(Order $order)
    {
        $this->orderService->completeOrder($order);
    }

    public function userOrders(Request $request)
    {
        $orders = $this->userRepository->getOrdersWithProducts($request->user());

        return OrderWithProductsResource::collection($orders);
    }
}
