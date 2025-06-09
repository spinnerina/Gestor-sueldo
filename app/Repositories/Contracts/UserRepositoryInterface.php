<?php

namespace App\Repositories\Contracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function all(array $where = [], array $columns = ['*'], array $relations = []): Collection;
    public function find(int $id, array $columns = ['*'], array $relations = []): ?User;
    public function delete(int $id): ?bool;
    public function findBy($where = [], array $columns = ['*'], array $relations = []): ?User;
}