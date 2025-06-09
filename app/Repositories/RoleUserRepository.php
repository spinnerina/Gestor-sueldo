<?php

namespace App\Repositories;

use App\Models\RoleUser;
use App\Repositories\Contracts\RoleUserRepositoryInterface;

class RoleUserRepository extends BaseRepository implements RoleUserRepositoryInterface
{
    public function __construct(RoleUser $model)
    {
        parent::__construct($model);
    }

    public function find(int $id, array $columns = ['*'], array $relations = []): ?RoleUser
    {
        return parent::find($id, $columns, $relations);
    }

    public function create(array $payload): RoleUser
    {
        return parent::create($payload);
    }

    public function findBy($where = [], array $columns = ['*'], array $relations = []): ?RoleUser
    {
        return parent::findBy($where, $columns, $relations);
    }
}