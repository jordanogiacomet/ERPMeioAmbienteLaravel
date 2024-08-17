<?php

namespace App\Exceptions;

use Exception;

class NotFoundException extends Exception
{
    protected $message = 'Resource not found'; // Mensagem genérica
}

class CreateException extends Exception
{
    protected $message = 'Error creating resource'; // Mensagem genérica
}

class UpdateException extends Exception
{
    protected $message = 'Error updating resource'; // Mensagem genérica
}

class DeleteException extends Exception
{
    protected $message = 'Error deleting resource'; // Mensagem genérica
}
