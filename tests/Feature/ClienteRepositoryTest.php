<?php

namespace Tests\Feature;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Repositories\ClienteRepository;
use App\Models\Cliente;

class ClienteRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected $clienteRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->clienteRepository = new ClienteRepository(new Cliente());
    }

    public function test_can_create_cliente()
    {
        $data = [
            'nome' => 'Cliente Teste',
            'cnpj' => '12.345.678/0001-95',
            'endereco' => 'Rua Teste, 123',
            'contato' => '123456789'
        ];

        $cliente = $this->clienteRepository->create(new \Illuminate\Foundation\Http\FormRequest($data));
        $this->assertInstanceOf(Cliente::class, $cliente);
        $this->assertEquals($data['nome'], $cliente->nome);
    }

    public function test_can_find_cliente_by_id()
    {
        $cliente = Cliente::factory()->create();
        $foundCliente = $this->clienteRepository->find($cliente->id);
        $this->assertInstanceOf(Cliente::class, $foundCliente);
        $this->assertEquals($cliente->id, $foundCliente->id);
    }

    public function test_find_cliente_throws_exception_if_not_found()
    {
        $this->expectException(ModelNotFoundException::class);
        $this->clienteRepository->find(999); // ID que não existe
    }

    public function test_can_update_cliente_by_id()
    {
        $cliente = Cliente::factory()->create();
        $data = [
            'nome' => 'Cliente Atualizado'
        ];
        $updatedCliente = $this->clienteRepository->update($cliente->id, new \Illuminate\Foundation\Http\FormRequest($data));
        $this->assertEquals('Cliente Atualizado', $updatedCliente->nome);
    }

    public function test_can_delete_cliente()
    {
        $cliente = Cliente::factory()->create();

        $this->clienteRepository->delete($cliente->id);

        $this->expectException(ModelNotFoundException::class);
        $this->clienteRepository->find($cliente->id);
    }

    public function test_delete_cliente_throws_exception_if_not_found()
    {
        $this->expectException(ModelNotFoundException::class);
        $this->clienteRepository->delete(999); // ID que não existe
    }

    public function test_can_get_all_clientes()
    {
        Cliente::factory()->count(3)->create();

        $clientes = $this->clienteRepository->all();

        $this->assertCount(3, $clientes);
    }
}
