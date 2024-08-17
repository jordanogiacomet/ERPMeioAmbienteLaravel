<?php

namespace App\Services;

use App\Repositories\ClienteRepositoryInterface;
use App\DTOs\CreateClienteDTO;
use App\DTOs\UpdateClienteDTO;
use App\DTOs\ReadClienteDTO;
use CreateClienteRequest;
use Illuminate\Foundation\Http\FormRequest;
use SebastianBergmann\Type\VoidType;
use UpdateClienteRequest;

class ClienteService
{
    // Propriedade para armazenar a instacia do repositorio de clientes
    protected ClienteRepositoryInterface $clienteRepository;

    public function __construct(ClienteRepositoryInterface $clienteRepository)
    {
        // Atribuimos a instancia do repositorio a propriedade da classe
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
        // Converte o dto para um array de dados-> lembrar que o form request precisa estar em array entao em preciso mapear dentro do dto um metodo para transformar em array
        $data = $clienteDto->toArray();

        // A partir do array criamos a instancia da requisicao com as validacoes que queremos fazer
        $request = new CreateClienteRequest();
        // Mesclamos os dados, criando assim um FormRequest propriamente dito
        $request->merge($data);

        // Passamos para a requisicao o metodo de criacao do repositorio
        $this->clienteRepository->create($request);
    }

    /* */
    /**
     * getAllClientes
     *
     * @return array
     */
    public function getAllClientes(): array
    {
        // Obtem todos os clientes do repositorio
        $clientes = $this->clienteRepository->all();

        // Mapeia cada cliente para um dto de leitura e converte para um array
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

    /**
     * getClienteById
     *
     * @param  int $id
     * @return ReadClienteDTO
     */
    public function getClienteById(int $id): ReadClienteDTO
    {   // Obtem o cliente pelo id do repositorio
        $cliente = $this->clienteRepository->find($id);
        // Converte o cliente para um dto de leitura
        return new ReadClienteDTO($cliente->id, $cliente->nome, $cliente->cnpj, $cliente->endereco, $cliente->contato);
    }

    /**
     * updateCliente
     *
     * @param  int $id
     * @param  UpdateClienteDTO $clienteDTO
     * @return ReadClienteDTO
     */
    public function updateCliente(int $id, UpdateClienteDTO $clienteDto)
    {
        $data = $clienteDto->toArray();
        $request = new UpdateClienteRequest();
        $request->merge($data);

        $cliente = $this->clienteRepository->update($id, $request);

        return new ReadClienteDTO(
            $cliente->id,
            $cliente->nome,
            $cliente->cnpj,
            $cliente->endereco,
            $cliente->contato
        );
    }
    /**
     * deleteCliente
     *
     * @param int $id
     * @return void
     */
    public function deleteCliente(int $id): void
    {
        $this->clienteRepository->delete($id);
    }
}