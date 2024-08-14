<?php

namespace App\Repositories;

use App\Helpers\ClienteRepositoryExceptionHelpers;
use App\Models\Cliente;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Collection;

class ClienteRepository implements ClienteRepositoryInterface
{
    /**
     * all
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return ClienteRepositoryExceptionHelpers::handleNotFound(function () {
            return Cliente::all();
        }); 
    }

    /**
     * find
     *
     * @param  int $id
     * @return Cliente
     */
    public function find(int $id): Cliente
    {
        $cliente = Cliente::find($id);
        if (!$cliente) {
            throw new ModelNotFoundException("Cliente não encontrado.");
        }
        return $cliente;
    }

    /**
     * create
     *
     * @param  array $data
     * @return Cliente
     */
    public function create(array $data): Cliente
    {
        return Cliente::create($data);
    }

    /**
     * update
     *
     * @param  int $id
     * @param  array $data
     * @return Cliente
     */
    public function update(int $id, array $data): Cliente
    {
        $cliente = $this->find($id);
        $cliente->update($data);
        return $cliente;
    }
    
    /**
     * delete
     *
     * @param  int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $cliente = $this->find($id);
        $cliente->delete();
    }
}
