<?php

namespace App\Repositories\Product\Implementations;

use App\Models\Product\Product;
use App\Repositories\Implementations\BaseRepository;
use App\Repositories\Product\Contracts\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct()
    {
        $this->model = new Product();
    }
}
