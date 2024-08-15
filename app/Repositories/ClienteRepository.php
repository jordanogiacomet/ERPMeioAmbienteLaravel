<?php

namespace App\Repositories;

use App\Helpers\ClienteRepositoryExceptionHelpers;
use App\Models\Cliente;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Http\FormRequest;

class ClienteRepository implements ClienteRepositoryInterface
{
    /**
     * all
     *
     * @return \Illuminate\Support\Collection
     * th
     */
    public function all(): Collection
    {
        return ClienteRepositoryExceptionHelpers::handleNotFound(function () {
            return Cliente::all();
        })();
    }

    /**
     * find
     *
     * @param  int|string $id
     * @return Cliente
     */
    public function find(int|string $id): Cliente
    {
        return ClienteRepositoryExceptionHelpers::handleNotFound(function () use ($id) {
            return Cliente::findOrFail($id);
        })();
    }

    /**
     * create
     *
     * @param  FormRequest $data
     * @return Cliente
     */
    public function create(FormRequest $data): Cliente
    {
        return ClienteRepositoryExceptionHelpers::handleCreate(function () use ($data) {
            return Cliente::create($data->validated());
        })();
    }

    /**
     * update
     *
     * @param  int|string $id
     * @param  FormRequest $data
     * @return Cliente
     */
    public function update(int|string $id, FormRequest $data): Cliente
    {   

        $cliente = $this->find($id);
        return ClienteRepositoryExceptionHelpers::handleUpdate(function () use ($cliente, $data) {
            $cliente->update($data->validated());
            return $cliente;
        })();
    }

    /**
     * delete
     *
     * @param  int|string $id
     * @return void
     */
    public function delete(int|string $id): void
    {
        $cliente = $this->find($id);
        return ClienteRepositoryExceptionHelpers::handleDelete(function () use ($cliente) {
            $cliente->delete();  
        })();
    }
}
