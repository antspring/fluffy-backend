<?php

namespace App\Providers;

use App\Repositories\Category\Contracts\CategoryRepositoryInterface;
use App\Repositories\Category\Implementations\CategoryRepository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class BindServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public $bindings = [
        CategoryRepositoryInterface::class => CategoryRepository::class,
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
        ];
    }
}
