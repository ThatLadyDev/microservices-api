<?php

namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

interface EloquentRepositoryInterface
{
    public function findByUuid(Model $model, string $uuid): ?Model;
    public function create(Model $model, array $data): Model;
    public function update(Model $model, array $data): Model;
    public function delete(Model $model): bool|null;
    public function getAll(Model $model): Collection;
    public function getCount(Model $model): int;
}
