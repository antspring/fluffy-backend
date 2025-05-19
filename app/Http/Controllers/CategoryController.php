<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Product\Category;
use App\Repositories\Category\Contracts\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    public function __construct(private readonly CategoryRepositoryInterface $categoryRepository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->categoryRepository->all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        return $this->categoryRepository->create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return $category;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        return $category->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        return $category->delete();
    }
}
