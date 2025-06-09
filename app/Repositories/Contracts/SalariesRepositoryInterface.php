<?php

namespace App\Repositories\Contracts;

use App\Models\Salaries;
use Illuminate\Database\Eloquent\Collection;

interface SalariesRepositoryInterface
{
    public function all(array $where = [], array $columns = ['*'], array $relations = []): Collection;
    public function find(int $id, array $columns = ['*'], array $relations = []): ?Salaries;
    public function create(array $payload): Salaries;
    public function update(int $id, array $payload): Salaries;
    public function delete(int $id): ?bool;
    public function findBy($where = [], array $columns = ['*'], array $relations = []): ?Salaries;
}