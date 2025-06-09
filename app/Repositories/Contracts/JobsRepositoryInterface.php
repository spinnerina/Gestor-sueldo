<?php

namespace App\Repositories\Contracts;

use App\Models\Jobs;
use Illuminate\Database\Eloquent\Collection;

interface JobsRepositoryInterface
{
    public function all(array $columns = ['*'], array $relations = []): Collection;
    public function find(int $id, array $columns = ['*'], array $relations = []): ?Jobs;
    public function create(array $payload): Jobs;
    public function update(int $id, array $payload): Jobs;
    public function delete(int $id): ?bool;
    public function findBy($where = [], array $columns = ['*'], array $relations = []): ?Jobs;
}