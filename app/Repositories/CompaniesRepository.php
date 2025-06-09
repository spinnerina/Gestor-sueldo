<?php

namespace App\Repositories;

use App\Models\Companies;
use App\Repositories\Contracts\CompaniesRepositoryInterface;

/**
 * @extends BaseRepository<\App\Models\Companies>
 */
class CompaniesRepository extends BaseRepository implements CompaniesRepositoryInterface
{
    public function __construct(Companies $model)
    {
        parent::__construct($model);
    }

    public function find(int $id, array $columns = ['*'], array $relations = []): ?Companies
    {
        return parent::find($id, $columns, $relations);
    }

    public function create(array $payload): Companies
    {
        return parent::create($payload);
    }

    public function update(int $id, array $payload): Companies
    {
        return parent::update($id, $payload);
    }

    public function findBy($where = [], array $columns = ['*'], array $relations = []): ?Companies
    {
        return parent::findBy($where, $columns, $relations);
    }
}