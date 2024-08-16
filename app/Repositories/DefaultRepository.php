<?php

namespace App\Repositories;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Helpers\ExceptionHelper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use SebastianBergmann\Type\VoidType;

abstract class DefaultRepository implements DefaultRepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model) 
    {
        $this->model = $model;
    }
    
    /**
     * all
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return ExceptionHelper::handleException(function () {
            return $this->model::all();
        }, 'notFound')();
    }    
    /**
     * find
     *
     * @param  mixed $id
     * @return Model
     */
    public function find(int|string $id): ?Model
    {
        return ExceptionHelper::handleException(function () use ($id) {
            return $this->model::findOrFail($id);
        }, 'notFound')();
    }    
    /**
     * create
     *
     * @param  FormRequest $data
     * @return Model
     */
    public function create(FormRequest $data): Model
    {
        return ExceptionHelper::handleException(function () use ($data) {
            return $this->model::create($data->validated());
        }, 'create')(); 
    }
    
    /**
     * update
     *
     * @param  int|string $id
     * @param  FormRequest $data
     * @return Model
     */
    public function update(int|string $id, FormRequest $data): Model
    {
        return ExceptionHelper::handleException(function () use ($id, $data) {
            $model = $this->find($id);
            $model->update($data->validated());
            return $model;
        }, 'update')();
    }    
    /**
     * delete
     *
     * @param  int|string $id
     * @return void
     */
    public function delete(int|string $id): void
    {
        ExceptionHelper::handleException(function () use ($id){
            $model = $this->find($id);
            $model->delete();
        }, 'delete');
    }
}