<?php

namespace App\Repositories;

use App\Models\Salaries;
use App\Repositories\Contracts\SalariesRepositoryInterface;

class SalariesRepository extends BaseRepository implements SalariesRepositoryInterface
{
    public function __construct(Salaries $model)
    {
        parent::__construct($model);
    }

    public function find(int $id, array $columns = ['*'], array $relations = []): ?Salaries
    {
        return parent::find($id, $columns, $relations);
    }

    public function create(array $payload): Salaries
    {
        return parent::create($payload);
    }

    public function update(int $id, array $payload): Salaries
    {
        return parent::update($id, $payload);
    }

    public function findBy($where = [], array $columns = ['*'], array $relations = []): ?Salaries
    {
        return parent::findBy($where, $columns, $relations);
    }
}