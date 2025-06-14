<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\Product\ProductInOrderResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderWithProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status->name,
            'completion_datetime' => $this->completion_datetime,
            'price' => $this->price,
            'products' => ProductInOrderResource::collection($this->products),
            'created_at' => $this->created_at,
        ];
    }
}
