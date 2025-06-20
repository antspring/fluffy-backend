<?php

namespace App\Models\Order;

use App\Models\Product\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'status_id',
        'completion_datetime',
        'price',
        'comment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product')->withPivot(['product_quantity']);
    }
}
