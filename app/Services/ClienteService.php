<?php

namespace App\Services;

use App\Repositories\ClienteRepositoryInterface;
use App\DTOs\CreateClienteDTO;
use App\DTOs\UpdateClienteDTO;
use App\DTOs\ReadClienteDTO;

class ClienteService
{
    protected ClienteRepositoryInterface $clienteRepository;

    public function __construct(ClienteRepositoryInterface $clienteRepository)
    {
        $this->clienteRepository = $clienteRepository;
    }

    public function createCliente(CreateClienteDTO $clienteDto): void
    {
        $data = $clienteDto->toArray();
        $this->clienteRepository->create($data);
    }

    public function getAllClientes(): array
    {
        $clientes = $this->clienteRepository->all();
        return $clientes->map(function ($cliente) {
            return new ReadClienteDTO(
                $cliente->id,
                $cliente->nome,
                $cliente->cnpj,
                $cliente->endereco,
                $cliente->contato
            );
        })->toArray();
    }

    public function getClienteById(int $id): ReadClienteDTO
    {
        $cliente = $this->clienteRepository->find($id);
        return new ReadClienteDTO($cliente->id, $cliente->nome, $cliente->cnpj, $cliente->endereco, $cliente->contato);
    }

    public function updateCliente(int $id, UpdateClienteDTO $clienteDto)
    {
        $data = $clienteDto->toArray();
        $cliente = $this->clienteRepository->update($id, $data);
        return new ReadClienteDTO(
            $cliente->id,
            $cliente->nome,
            $cliente->cnpj,
            $cliente->endereco,
            $cliente->contato
        );
    }

    public function deleteCliente(int $id): void
    {
        $this->clienteRepository->delete($id);
    }
}
