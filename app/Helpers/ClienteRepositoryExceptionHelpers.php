<?php

namespace App\Helpers;

use App\Exceptions\ClienteNotFoundException;
use App\Exceptions\ClienteCreateException;
use App\Exceptions\ClienteUpdateException;
use App\Exceptions\ClienteDeleteException;

class ClienteRepositoryExceptionHelpers extends ExceptionHelper{    
    /**
     * handleNotFound
     *
     * @param  callable $function
     * @return callable Exception
     */
    public static function handleNotFound(callable $function): callable
    {
        return self::handleException($function, ClienteNotFoundException::class);
    }    
    /**
     * handleCreate
     *
     * @param  callable $function
     * @return callable Exception
     */
    public static function handleCreate(callable $function)
    {
        return self::handleException($function, ClienteCreateException::class);
    }    
    /**
     * handleUpdate
     *
     * @param  callable $function
     * @return callable Exception
     */
    public static function handleUpdate(callable $function)
    {
        return self::handleException($function, ClienteUpdateException::class);
    }    
    /**
     * handleDelete
     *
     * @param  callable $function
     * @return callable Exception
     */
    public static function handleDelete(callable $function)
    {
        return self::handleException($function, ClienteDeleteException::class);
    }
}