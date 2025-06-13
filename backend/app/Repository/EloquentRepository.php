<?php

namespace App\Repository;

use App\Data\DataInterface;
use Illuminate\Database\Eloquent\Model;

abstract class EloquentRepository
{
    private Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(DataInterface $data): Model
    {
        return $this->model
            ->create($data->toArray());
    }
}