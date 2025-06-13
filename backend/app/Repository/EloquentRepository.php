<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;

abstract class EloquentRepository
{
    private Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(array $data): Model
    {
        return $this->model
            ->create($data);
    }
}