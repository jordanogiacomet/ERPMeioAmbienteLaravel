<?php

namespace App\Helpers;

use App\Exceptions\ModelNotFoundException;
use App\Exceptions\CreateException;
use App\Exceptions\UpdateException;
use App\Exceptions\DeleteException;

class DefaultRepositoryExceptionHelper extends ExceptionHelper
{
    protected static $exceptionMap = [
        'notFound' => ModelNotFoundException::class,
        'create' => CreateException::class,
        'update' => UpdateException::class,
        'delete' => DeleteException::class,
    ];
}