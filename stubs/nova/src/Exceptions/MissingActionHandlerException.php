<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Exceptions;

use Exception;

class MissingActionHandlerException extends \Exception
{
    /**
     * @param  object  $action
     * @return static
     */
    public static function make($action, string $method) {
        return new static();
    }
}
