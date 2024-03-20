<?php

namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Eloquent\EloquentRepositoryInterface;

class EloquentRepository implements EloquentRepositoryInterface
{
    public function findByUuid(Model $model, string $uuid, array $columns = ['*']): ?Model
    {
        return $model::query()->where('uuid', $uuid)->first($columns);
    }

    public function create(Model $model, array $data): Model
    {
        return $model::query()->create($data);
    }

    public function update(Model $model, array $data): Model
    {
        foreach ($data as $column  => $value){
            $model->$column = $value;
        }
        $model->save();
        return $model;
    }

    public function delete(Model $model): bool|null
    {
        return $model->delete();
    }

    public function getAll(Model $model): Collection
    {
        return $model->all();
    }

    public function getCount(Model $model): int
    {
        return $model::count();
    }
}
