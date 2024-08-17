<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Services\ClienteService;
use App\DTOs\CreateClienteDTO;
use App\DTOs\UpdateClienteDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClienteController extends Controller
{
    protected ClienteService $clienteService;

    public function __construct(ClienteService $clienteService)
    {
        $this->clienteService = $clienteService;
    }

    public function index()
    {
        $clientes = $this->clienteService->getAllClientes();
        return response()->json($clientes);
    }

    public function show($id)
    {
        $cliente = $this->clienteService->getClienteById($id);
        return response()->json($cliente);
    }

    public function store(CreateClienteRequest $request)
    {
        $clienteDto = new CreateClienteDTO(
            $request->input('nome'),
            $request->input('cnpj'),
            $request->input('endereco'),
            $request->input('contato')
        );

        $this->clienteService->createCliente($clienteDto);

        return response()->json(['message' => 'Cliente criado com sucesso'], Response::HTTP_CREATED);
    }

    public function update($id, UpdateClienteRequest $request)
    {
        $clienteDto = new UpdateClienteDTO(
            $id,
            $request->input('nome'),
            $request->input('cnpj'),
            $request->input('endereco'),
            $request->input('contato')
        );

        $cliente = $this->clienteService->updateCliente($id, $clienteDto);

        return response()->json($cliente);
    }

    public function destroy($id)
    {
        $this->clienteService->deleteCliente($id);
        return response()->json(['message' => 'Cliente deletado com sucesso']);
    }
}
