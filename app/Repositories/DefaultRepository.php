<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Helpers\DefaultRepositoryExceptionHelper;

class DefaultRepository implements DefaultRepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        if ($model === null) {
            throw new \InvalidArgumentException("Model cannot be null");
        }
        $this->model = $model;
    }

    /**
     * Retrieve all records.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return DefaultRepositoryExceptionHelper::handleException(function () {
            return $this->model::all();
        }, 'notFound');
    }

    /**
     * Find a record by its ID.
     *
     * @param  int|string $id
     * @return Model
     */
    public function find(int|string $id): Model
    {
        return DefaultRepositoryExceptionHelper::handleException(function () use ($id) {
            return $this->model::findOrFail($id);
        }, 'notFound');
    }

    /**
     * Create a new record.
     *
     * @param  array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return DefaultRepositoryExceptionHelper::handleException(function () use ($data) {
            return $this->model::create($data);
        }, 'create');
    }

    /**
     * Update an existing record by its ID.
     *
     * @param  int|string $id
     * @param  array $data
     * @return Model
     */
    public function update(int|string $id, array $data): Model
    {
        return DefaultRepositoryExceptionHelper::handleException(function () use ($id, $data) {
            $model = $this->find($id);
            $model->update($data);
            return $model;
        }, 'update');
    }

    /**
     * Delete a record by its ID.
     *
     * @param  int|string $id
     * @return void
     */
    public function delete(int|string $id): void
    {
        DefaultRepositoryExceptionHelper::handleException(function () use ($id) {
            $model = $this->find($id);
            $model->delete();
        }, 'delete');
    }
}
