<?php

namespace App\Repositories;

use App\DTOs\CreateClienteDTO;
use App\Models\Cliente;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Http\FormRequest;

interface ClienteRepositoryInterface
{
    public function all(): Collection;
    public function find(int|string $id): Cliente;
    public function create(FormRequest $data): Cliente;
    public function update(int|string $id, FormRequest $data): Cliente;
    public function delete(int|string $id): void;
}
