<?php

namespace App\Repositories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ClienteRepository implements ClienteRepositoryInterface
{
    public function all()
    {
        return Cliente::all();
    }

    public function find($id)
    {
        $cliente = Cliente::find($id);
        if (!$cliente) {
            throw new ModelNotFoundException("Cliente não encontrado.");
        }
        return $cliente;
    }

    public function create(array $data)
    {
        return Cliente::create($data);
    }

    public function update($id, array $data)
    {
        $cliente = $this->find($id);
        $cliente->update($data);
        return $cliente;
    }

    public function delete($id)
    {
        $cliente = $this->find($id);
        $cliente->delete();
    }
}