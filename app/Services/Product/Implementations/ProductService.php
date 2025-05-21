<?php

namespace App\Services\Product\Implementations;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product\Product;
use App\Repositories\Product\Contracts\ProductRepositoryInterface;
use App\Services\Product\Contracts\ProductServiceInterface;
use Illuminate\Support\Facades\Storage;

class ProductService implements ProductServiceInterface
{
    public function __construct(private readonly ProductRepositoryInterface $productRepository)
    {
    }

    public function all()
    {
        return $this->productRepository->all();
    }

    public function find($id)
    {
        return $this->productRepository->find($id);
    }

    public function create(StoreProductRequest $request)
    {
        $filename = $request->file('image')->store('images/products');
        $data = $request->validated();
        $data['image'] = $filename;
        return $this->productRepository->create($data);
    }

    public function update(Product $product, UpdateProductRequest $request)
    {
        if ($request->hasFile('image')) {
            $filename = $request->file('image')->store('images/products');
            $data = $request->validated();
            $data['image'] = $filename;
            Storage::delete($product->image);
            return $product->update($data);
        }

        return $product->update($request->validated());
    }

    public function delete(Product $product)
    {
        Storage::delete($product->image);
        return $product->delete();
    }

    public function where($column, $value)
    {
        return $this->productRepository->where($column, $value);
    }
}
