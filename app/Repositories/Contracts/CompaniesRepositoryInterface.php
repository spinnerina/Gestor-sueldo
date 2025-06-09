<?php

namespace App\Repositories\Contracts;

use App\Models\Companies;
use Illuminate\Database\Eloquent\Collection;

interface CompaniesRepositoryInterface
{
    public function all(array $columns = ['*'], array $relations = []): Collection;
    public function find(int $id, array $columns = ['*'], array $relations = []): ?Companies;
    public function create(array $payload): Companies;
    public function update(int $id, array $payload): Companies;
    public function delete(int $id): ?bool;
    public function findBy($where = [], array $columns = ['*'], array $relations = []): ?Companies;
}