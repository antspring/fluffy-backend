<?php

namespace App\Services\Product\Implementations;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product\Category;
use App\Models\Product\Ingredient;
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

        $product = $this->productRepository->create($data);

        $ingredients = json_decode($request->input('ingredients'), true);

        $missing = $this->syncIngredients($product, $ingredients);

        if ($missing === true) {
            return ['success' => true, 'product' => $product];
        }

        return ['success' => false, 'missing' => $missing];
    }

    public function update(Product $product, UpdateProductRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $filename = $request->file('image')->store('images/products');
            $data['image'] = $filename;
            Storage::delete($product->image);
        }

        $ingredients = json_decode($request->input('ingredients'), true);

        $missing = $this->syncIngredients($product, $ingredients);

        if ($missing === true) {
            return ['success' => $product->update($data)];
        }

        return ['success' => false, 'missing' => $missing];
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

    public function subtractionAmount($productsQuantity)
    {
        $products = $this->productRepository->getMany(array_keys($productsQuantity));

        foreach ($products as $product) {
            $product->amount = max(0, $product->amount - $productsQuantity[$product->id]['product_quantity']);
        }

        $this->productRepository->subtractionAmount($products->toArray());

        return $products;
    }

    private function syncIngredients(Product $product, array $ingredients): array|bool
    {
        if (!empty($ingredients)) {
            $ids = collect($ingredients)->pluck('id')->all();
            $existingIds = Ingredient::whereIn('id', $ids)->pluck('id')->all();

            $missing = array_values(array_diff($ids, $existingIds));

            if (!empty($missing)) {
                return $missing;
            }

            $sync = [];

            foreach ($ingredients as $ingredient) {
                $sync[$ingredient['id']] = [
                    'quantity' => $ingredient['quantity'],
                    'unit' => $ingredient['unit'],
                ];
            }

            $product->ingredients()->sync($sync);
        }

        return true;
    }
}
