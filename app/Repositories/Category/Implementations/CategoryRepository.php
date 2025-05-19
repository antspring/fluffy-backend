<?php

namespace App\Repositories\Category\Implementations;

use App\Models\Product\Category;
use App\Repositories\Category\Contracts\CategoryRepositoryInterface;
use App\Repositories\Implementations\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function __construct()
    {
        $this->model = new Category();
    }
}
