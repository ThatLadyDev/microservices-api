<?php

namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Eloquent\EloquentRepositoryInterface;

class EloquentRepository implements EloquentRepositoryInterface
{
    public function create(Model $model, array $data): Model
    {
        return $model::query()->create($data);
    }
}
