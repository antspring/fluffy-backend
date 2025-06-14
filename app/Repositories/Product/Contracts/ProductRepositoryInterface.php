<?php

namespace App\Repositories\Product\Contracts;

use App\Repositories\Contracts\RepositoryInterface;

interface ProductRepositoryInterface extends RepositoryInterface
{
    public function getMany(array $ids);

    public function subtractionAmount(array $products);
}
