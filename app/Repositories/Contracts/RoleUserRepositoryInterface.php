<?php

namespace App\Repositories\Contracts;

use App\Models\RoleUser;
use Illuminate\Database\Eloquent\Collection;

interface RoleUserRepositoryInterface
{
    public function all(array $columns = ['*'], array $relations = []): Collection;
    public function find(int $id, array $columns = ['*'], array $relations = []): ?RoleUser;
    public function create(array $payload): RoleUser;
    public function findBy($where = [], array $columns = ['*'], array $relations = []): ?RoleUser;
    public function delete(int $id): ?bool;
}