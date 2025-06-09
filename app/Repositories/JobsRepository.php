<?php

namespace App\Repositories;

use App\Models\Jobs;
use App\Repositories\Contracts\JobsRepositoryInterface;


class JobsRepository extends BaseRepository implements JobsRepositoryInterface
{
    public function __construct(Jobs $model)
    {
        parent::__construct($model);
    }

    
    public function find(int $id, array $columns = ['*'], array $relations = []): ?Jobs
    {
        return parent::find($id, $columns, $relations);
    }

    public function create(array $payload): Jobs
    {
        return parent::create($payload);
    }

    public function update(int $id, array $payload): Jobs
    {
        return parent::update($id, $payload);
    }

    public function findBy($where = [], array $columns = ['*'], array $relations = []): ?Jobs
    {
        return parent::findBy($where, $columns, $relations);
    }
}