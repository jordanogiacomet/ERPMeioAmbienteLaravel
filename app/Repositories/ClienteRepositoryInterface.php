<?php

namespace App\Repositories;

use App\Models\Cliente;

interface ClienteRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function update(Cliente $cliente, array $data);
    public function delete(Cliente $cliente);
}
