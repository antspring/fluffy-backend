<?php

namespace App\Services\Product\Contracts;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product\Product;

interface ProductServiceInterface
{
    public function all();

    public function find($id);

    public function create(StoreProductRequest $request);

    public function update(Product $product, UpdateProductRequest $request);

    public function delete(Product $product);

    public function where($column, $value);
}
