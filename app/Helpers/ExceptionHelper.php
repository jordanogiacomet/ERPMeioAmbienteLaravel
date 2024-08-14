<?php

namespace App\Helpers;

use Exception;

abstract class ExceptionHelper {    
    /**
     * handleException
     *
     * @param  callable $function
     * @param  string $exceptionClass
     * @throws Exception
     * @return callable
     */
    private static function handleException(callable $function, string $exceptionClass)
    {
        try {
            return $function();
        } catch (Exception $e) {
            throw new $exceptionClass($e->getMessage(), $e->getCode());
        }
    }
}