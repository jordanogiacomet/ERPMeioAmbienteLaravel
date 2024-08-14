<?php

namespace App\Services;

use App\Repositories\ClienteRepositoryInterface;
use App\DTOs\CreateClienteDTO;
use App\DTOs\UpdateClienteDTO;
use App\DTOs\ReadClienteDTO;
use SebastianBergmann\Type\VoidType;

class ClienteService
{
    protected ClienteRepositoryInterface $clienteRepository;

    public function __construct(ClienteRepositoryInterface $clienteRepository)
    {
        $this->clienteRepository = $clienteRepository;
    }    
    /**
     * createCliente
     *
     * @param  CreateClienteDTO $clienteDto
     * @return void
     */
    public function createCliente(CreateClienteDTO $clienteDto): void
    {
        $this->clienteRepository->create((array) $clienteDto);
    }

    /* */    
    /**
     * getAllClientes
     *
     * @return ReadClienteDTO[]
     */
    public function getAllClientes(): array
    {
        $clientes = $this->clienteRepository->all();
        return array_map(function ($cliente) {
            return new ReadClienteDTO($cliente->id, $cliente->nome, $cliente->cnpj, $cliente->endereco, $cliente->contato);
        }, $clientes->toArray());
    }
    
    /**
     * getClienteById
     *
     * @param  int $id
     * @return ReadClienteDTO
     */
    public function getClienteById(int $id): ReadClienteDTO
    {
        $cliente = $this->clienteRepository->find($id);
        return new ReadClienteDTO($cliente->id, $cliente->nome, $cliente->cnpj, $cliente->endereco, $cliente->contato);
    }
    
    /**
     * updateCliente
     *
     * @param  int $id
     * @param  UpdateClienteDTO $clienteDTO
     * @return ReadClienteDTO
     */
    public function updateCliente(int $id, UpdateClienteDTO $clienteDTO): ReadClienteDTO
    {
        $cliente = $this->clienteRepository->update($id, (array)$clienteDTO);
        return new ReadClienteDTO($cliente->id, $cliente->nome, $cliente->cnpj, $cliente->endereco, $cliente->contato);
    }    
    /**
     * deleteCliente
     *
     * @param  int $id
     * @return void
     */
    public function deleteCliente(int $id): void 
    {
        $this->clienteRepository->delete($id);
    }
}