<?php

namespace App\Repository;

use App\Data\DataInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class EloquentRepository
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(): Collection
    {
        return $this->model
            ->all();
    }

    public function find(string $id): ?Model
    {
        return $this->model
            ->find($id);
    }

    public function create(DataInterface $data): Model
    {
        return $this->model
            ->create($data->toArray());
    }

    public function update(Model $model, DataInterface $data): bool
    {
        return $this->model
            ->where('id', $model->id)
            ->update($data->toArray());
    }
}