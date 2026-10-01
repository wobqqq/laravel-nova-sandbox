<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Fields;

use Carbon\CarbonInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Support\FluentDecorator;

/**
 * @template TKey of array-key
 * @template TValue
 * @extends \Laravel\Nova\Support\FluentDecorator<TKey, TValue>
 */
class FormData extends \Laravel\Nova\Support\FluentDecorator
{
    /**
     * @param  iterable<TKey, TValue>  $attributes
     */
    public function __construct($attributes, protected \Laravel\Nova\Http\Requests\NovaRequest $request) {
    }
    /**
     * @param  array<string, mixed>  $fields
     * @return static
     */
    public static function make(\Laravel\Nova\Http\Requests\NovaRequest $request, array $fields) {
        return new static();
    }
    /**
     * @param  array<int, string>  $onlyAttributes
     * @return static
     */
    public static function onlyFrom(\Laravel\Nova\Http\Requests\NovaRequest $request, array $onlyAttributes) {
        return new static();
    }
    public function resource(string $uriKey, mixed $default = null): mixed {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function str(string $key, mixed $default = ''): \Illuminate\Support\Stringable {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function string(string $key, mixed $default = ''): \Illuminate\Support\Stringable {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  string  $key
     * @param  mixed  $default
     * @return mixed
     */
    public function json($key, $default = null) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function boolean(string $key, bool $default = false): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function integer(string $key, int $default = 0): int {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function float(string $key, float $default = 0.0): float {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @throws \Carbon\Exceptions\InvalidFormatException
     */
    public function date(string $key, ?string $format = null, ?string $tz = null): ?\Carbon\CarbonInterface {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
