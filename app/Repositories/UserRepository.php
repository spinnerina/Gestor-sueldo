<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function find(int $id, array $columns = ['*'], array $relations = []): ?User
    {
        return parent::find($id, $columns, $relations);
    }

    public function findBy($where = [], array $columns = ['*'], array $relations = []): ?User
    {
        return parent::findBy($where, $columns, $relations);
    }

    public function hasRole(User $user): ?User
    {
        return $user->roleUser()->where('user_id', $user->id)->exists();
    }
}