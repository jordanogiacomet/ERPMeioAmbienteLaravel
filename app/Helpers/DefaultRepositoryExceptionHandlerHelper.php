<?php

namespace App\Helpers;

use App\Exceptions\NotFoundException;
use App\Exceptions\CreateException;
use App\Exceptions\UpdateException;
use App\Exceptions\DeleteException;

class DefaultRepositoryExceptionHandlerHelper extends DefaultRepositoryExceptionHelper
{
    /**
     * handleNotFound
     *
     * @param  callable $function
     * @return callable Exception
     */
    public static function handleNotFound(callable $function): callable
    {
        return self::handleException($function, NotFoundException::class);
    }
    /**
     * handleCreate
     *
     * @param  callable $function
     * @return callable Exception
     */
    public static function handleCreate(callable $function)
    {
        return self::handleException($function, CreateException::class);
    }
    /**
     * handleUpdate
     *
     * @param  callable $function
     * @return callable Exception
     */
    public static function handleUpdate(callable $function)
    {
        return self::handleException($function, UpdateException::class);
    }
    /**
     * handleDelete
     *
     * @param  callable $function
     * @return callable Exception
     */
    public static function handleDelete(callable $function)
    {
        return self::handleException($function, DeleteException::class);
    }
}