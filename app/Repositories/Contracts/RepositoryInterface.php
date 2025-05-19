<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public Model $model {
        get;
    }

    public function all();

    public function find($id);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);

    public function where($column, $value);
}
