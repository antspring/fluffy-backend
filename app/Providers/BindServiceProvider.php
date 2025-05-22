<?php

namespace App\Providers;

use App\Repositories\Category\Contracts\CategoryRepositoryInterface;
use App\Repositories\Category\Implementations\CategoryRepository;
use App\Repositories\Ingredient\Contracts\IngredientRepositoryInterface;
use App\Repositories\Ingredient\Implementations\IngredientRepository;
use App\Repositories\Product\Contracts\ProductRepositoryInterface;
use App\Repositories\Product\Implementations\ProductRepository;
use App\Repositories\User\Contracts\UserRepositoryInterface;
use App\Repositories\User\Implementations\UserRepository;
use App\Services\Product\Contracts\ProductServiceInterface;
use App\Services\Product\Implementations\ProductService;
use App\Services\SMSender\Contracts\SMSenderServiceInterface;
use App\Services\SMSender\Implementations\SMSenderService;
use App\Services\User\Contracts\UserServiceInterface;
use App\Services\User\Implementations\Implementations\UserService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class BindServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public $bindings = [
        CategoryRepositoryInterface::class => CategoryRepository::class,
        IngredientRepositoryInterface::class => IngredientRepository::class,
        ProductRepositoryInterface::class => ProductRepository::class,
        ProductServiceInterface::class => ProductService::class,
        UserRepositoryInterface::class => UserRepository::class,
        UserServiceInterface::class => UserService::class,
        SMSenderServiceInterface::class => SMSenderService::class,
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
            ProductRepositoryInterface::class,
            ProductServiceInterface::class,
            UserRepositoryInterface::class,
            UserServiceInterface::class,
            SMSenderServiceInterface::class,
        ];
    }
}
