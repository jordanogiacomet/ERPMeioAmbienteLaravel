<?php

namespace App\Exceptions;

use Exception;

class ClienteNotFoundException extends Exception
{
    protected $message = 'Cliente nao encontrado';
}

class ClienteCreateException extends Exception
{
    protected $message = 'Erro ao criar cliente';
}

class ClienteUpdateException extends Exception 
{
    protected $message = 'Erro ao atualizar cliente';
}

class ClienteDeleteException extends Exception
{
    protected $message = 'Erro ao deletar cliente';
}