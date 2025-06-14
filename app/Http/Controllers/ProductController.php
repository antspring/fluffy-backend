<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product\Product;
use App\Services\Product\Contracts\ProductServiceInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(private readonly ProductServiceInterface $productService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->productService->all()->toResourceCollection();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $result = $this->productService->create($request);
        if ($result['success']) {
            return $result['product']->toResource();
        }
        return response()->json(['message' => 'Ingredient not created', 'missing' => $result['missing']], 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return $product->toResource();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $result = $this->productService->update($product, $request);

        if ($result['success']) {
            return $result['success'];
        }

        return response()->json(['message' => 'Ingredient not created', 'missing' => $result['missing']], 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        return $this->productService->delete($product);
    }
}
