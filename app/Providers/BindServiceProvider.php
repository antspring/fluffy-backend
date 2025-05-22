<?php

namespace App\Providers;

use App\Repositories\Category\Contracts\CategoryRepositoryInterface;
use App\Repositories\Category\Implementations\CategoryRepository;
use App\Repositories\Employee\Contracts\EmployeeRepositoryInterface;
use App\Repositories\Employee\Implementations\EmployeeRepository;
use App\Repositories\Ingredient\Contracts\IngredientRepositoryInterface;
use App\Repositories\Ingredient\Implementations\IngredientRepository;
use App\Repositories\Product\Contracts\ProductRepositoryInterface;
use App\Repositories\Product\Implementations\ProductRepository;
use App\Repositories\User\Contracts\UserRepositoryInterface;
use App\Repositories\User\Implementations\UserRepository;
use App\Services\Employee\Contracts\EmployeeServiceInterface;
use App\Services\Employee\Implementations\EmployeeService;
use App\Services\Product\Contracts\ProductServiceInterface;
use App\Services\Product\Implementations\ProductService;
use App\Services\SMSender\Contracts\SMSenderServiceInterface;
use App\Services\SMSender\Implementations\SMSenderFakeService;
use App\Services\SMSender\Implementations\SMSenderService;
use App\Services\User\Contracts\UserServiceInterface;
use App\Services\User\Implementations\UserService;
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
        EmployeeRepositoryInterface::class => EmployeeRepository::class,
        EmployeeServiceInterface::class => EmployeeService::class,
    ];

    public function register(): void
    {
        $this->app->bind(SMSenderServiceInterface::class, function () {
            return match (config('sms.driver')) {
                'fake' => new SMSenderFakeService(),
                default => new SMSenderService(),
            };
        });
    }

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
            EmployeeRepositoryInterface::class,
            EmployeeServiceInterface::class,
        ];
    }
}
