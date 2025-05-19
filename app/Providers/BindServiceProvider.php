<?php

namespace App\Providers;

use App\Repositories\Category\Contracts\CategoryRepositoryInterface;
use App\Repositories\Category\Implementations\CategoryRepository;
use App\Repositories\Ingredient\Contracts\IngredientRepositoryInterface;
use App\Repositories\Ingredient\Implementations\IngredientRepository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class BindServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public $bindings = [
        CategoryRepositoryInterface::class => CategoryRepository::class,
        IngredientRepositoryInterface::class => IngredientRepository::class,
    ];

    /**
     * Get the services provided by the provider.
     *
     * @return array<int, string>
     */
    public function provides(): array
    {
        return [
            CategoryRepositoryInterface::class,
            IngredientRepositoryInterface::class,
        ];
    }
}
