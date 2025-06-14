<?php

namespace App\Services\Order\Implementations;

use App\Http\Requests\Order\StoreOrderRequest;
use App\Models\Order\Order;
use App\Models\Order\Status;
use App\Repositories\Order\Contracts\OrderRepositoryInterface;
use App\Services\Order\Contracts\OrderServiceInterface;
use App\Services\Product\Contracts\ProductServiceInterface;

class OrderService implements OrderServiceInterface
{

    public function __construct(private readonly OrderRepositoryInterface $orderRepository, private readonly ProductServiceInterface $productService)
    {
    }

    public function create(StoreOrderRequest $request)
    {

        $attach = collect($request->products)->mapWithKeys(fn($product) => [$product['id'] => ['product_quantity' => $product['quantity']]])->toArray();

        $products = $this->productService->subtractionAmount($attach);

        $order = $this->orderRepository->create([
            'user_id' => $request->user()->id,
            'completion_datetime' => $request['completion_datetime'],
            'price' => $this->getFullPrice($products, $attach)
        ]);

        $this->orderRepository->attachProducts($order, $attach);

        return $order->fresh();
    }

    public function getFullPrice($products, $quantities)
    {
        return $products->sum(function ($product) use ($quantities) {
            return $product['price'] * $quantities[$product['id']]['product_quantity'];
        });
    }

    public function cancelOrder(Order $order)
    {
        $order->update(['status_id' => Status::CANCELED]);
    }

    public function completeOrder(Order $order)
    {
        $order->update(['status_id' => Status::READY]);
    }
}
