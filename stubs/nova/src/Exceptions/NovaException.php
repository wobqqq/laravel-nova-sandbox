<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Exceptions;

use Exception;

class NovaException extends \Exception
{
    /**
     * @param  class-string  $class
     * @return \Laravel\Nova\Exceptions\HelperNotSupported
     */
    public static function helperNotSupported(string $method, string $class) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\Exceptions\ResourceMissingException
     */
    public static function missingResourceForRepeater(string $name) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
