<?php

namespace App\Http\Controllers;

use App\Services\ClienteService;
use App\DTOs\CreateClienteDTO;
use App\DTOs\UpdateClienteDTO;
use App\DTOs\ReadClienteDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClienteController extends Controller
{
    protected ClienteService $clienteService;

    public function __construct(ClienteService $clienteService)
    {
        $this->clienteService = $clienteService;
    }
    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $clientes = $this->clienteService->getAllClientes();
        return response()->json($clientes);
    }
    
    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        $cliente = $this->clienteService->getClienteById($id);
        return response()->json($cliente);
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cnpj' => 'required|string|max:14',
            'endereco' => 'required|string|max:255',
            'contato' => 'required|string|max:255',
        ]);

        $clienteDto = new CreateClienteDTO(
            $request->input('nome'),
            $request->input('cnpj'),
            $request->input('endereco'),
            $request->input('contato')
        );

        $this->clienteService->createCliente($clienteDto);

        return response()->json(['message' => 'Cliente criado com sucesso'], Response::HTTP_CREATED);
    }
    
    /**
     * update
     *
     * @param  mixed $id
     * @param  mixed $request
     * @return void
     */
    public function update($id, Request $request)
    {
        $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'cnpj' => 'sometimes|required|string|max:14',
            'endereco' => 'sometimes|required|string|max:255',
            'contato' => 'sometimes|required|string|max:255',
        ]);

        $clienteDto = new UpdateClienteDTO(
            $request->input('nome', ''),
            $request->input('cnpj', ''),
            $request->input('endereco', ''),
            $request->input('contato', '')
        );

        $cliente = $this->clienteService->updateCliente($id, $clienteDto);

        return response()->json($cliente);
    }
    
    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        $this->clienteService->deleteCliente($id);
        return response()->json(['message' => 'Cliente deletado com sucesso']);
    }
}
