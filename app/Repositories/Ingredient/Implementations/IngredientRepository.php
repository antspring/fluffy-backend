<?php

namespace App\Repositories\Ingredient\Implementations;

use App\Models\Product\Ingredient;
use App\Repositories\Implementations\BaseRepository;
use App\Repositories\Ingredient\Contracts\IngredientRepositoryInterface;

class IngredientRepository extends BaseRepository implements IngredientRepositoryInterface
{
    public function __construct()
    {
        $this->model = new Ingredient();
    }
}
