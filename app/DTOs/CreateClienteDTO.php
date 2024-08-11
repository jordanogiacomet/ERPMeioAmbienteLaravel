<?php

namespace App\DTOs;

class CreateClienteDTO 
{
    public string $nome;
    public string $cnpj;
    public string $endereco;
    public string $contato;
    public function __construct(string $nome, string $cnpj, string $endereco, string $contato)
    {
        $this->nome = $nome;
        $this->cnpj = $cnpj;
        $this->endereco = $endereco;
        $this->contato = $contato;
    }
}