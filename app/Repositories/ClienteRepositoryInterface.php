<?php

namespace App\Repositories;

use App\DTOs\CreateClienteDTO;
use App\Models\Cliente;
use Illuminate\Database\Eloquent\Collection;

interface ClienteRepositoryInterface
{
    public function all(): Collection;
    public function find(int $id): Cliente;
    public function create(array $data): Cliente;
    public function update(int $id, array $data): Cliente;
    public function delete(int $id): void;
}
