<?php

namespace App\DTOs;

class ReadClienteDTO
{
    public int $id;
    public ?string $nome;
    public ?string $cnpj;
    public ?string $endereco;
    public ?string $contato;

    public function __construct(int $id, ?string $nome = null, ?string $cnpj = null, ?string $endereco = null, ?string $contato = null)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->cnpj = $cnpj;
        $this->endereco = $endereco;
        $this->contato = $contato;
    }
}
