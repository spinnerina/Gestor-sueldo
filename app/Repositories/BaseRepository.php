<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    /**
     * Model instance
     */
    protected Model $model;

    /**
     * Constructor to BaseRepository
     */ 
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all records
     */
    public function all(array $where = [], array $columns = ['*'], array $relations = []): Collection
    {
        return $this->model->with($relations)->where($where)->get($columns);
    }

    /**
     * Find a record by id
     */
    public function find(int $id, array $columns = ['*'], array $relations = []): ?Model
    {
        return $this->model->with($relations)->find($id, $columns);
    }

    /**
     * Create a new record
     */
    public function create(array $payload): Model
    {
        return $this->model->create($payload);
    }

    /**
     * Update a record
     */
    public function update(int $id, array $payload): Model
    {
        $model = $this->model->find($id);
        $model->update($payload);
        return $model;
    }

    /**
     * Delete a record
     * Only use this method by super admin
     */
    public function delete(int $id): ?bool
    {
        return $this->find($id)?->delete();
    }

    /**
     * Find a record
     */
    public function findBy($where = [], array $columns = ['*'], array $relations = []): ?Model
    {
        return $this->model->with($relations)->where($where)->first($columns);
    }
}
