<?php

namespace App\Policies;

use App\Models\Order\Order;

class OrderPolicy
{
    public function update($actor, Order $order): bool
    {
        return $actor->hasRole('admin') || $actor->hasRole('employee') || $actor->id === $order->user_id;
    }
}
