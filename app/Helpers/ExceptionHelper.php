<?php

namespace App\Helpers;

use Exception;

abstract class ExceptionHelper
{
    /**
     * handleException
     *
     * @param  callable $function
     * @param  string $exceptionClass
     * @throws Exception
     * @return callable
     */
    public static function handleException(callable $function, string $exceptionKey)
    {
        try {
            return $function();
        } catch (Exception $e) {
            $exceptionClass = static::$exceptionMap[$exceptionKey] ?? Exception::class;
            throw new $exceptionClass($e->getMessage(), $e->getCode(), $e);
        }
    }
}