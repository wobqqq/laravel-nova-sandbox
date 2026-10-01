<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Fields;

use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Nova;
use Laravel\Nova\Resource;
use function Orchestra\Sidekick\Eloquent\model_exists;
use function Orchestra\Sidekick\Http\safe_int;

/**
 * @method static static make(\Stringable|string|null $name = null, string|null $attribute = null, callable|null $resolveCallback = null)
 */
class ID extends \Laravel\Nova\Fields\Field
{
    /**
     * @var string
     */
    public $component = 'id-field';
    /**
     * @var string|int|null
     */
    public $pivotValue = null;
    /**
     * @param  \Stringable|string|null  $name
     * @param  (callable(mixed, mixed, ?string):(mixed))|null  $resolveCallback
     */
    public function __construct($name = null, ?string $attribute = null, ?callable $resolveCallback = null) {
    }
    /**
     * @param  \Stringable|string  $name
     */
    public static function hidden($name = 'ID', string $attribute = 'id', ?callable $resolveCallback = null): \Laravel\Nova\Fields\Hidden {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function forResource(\Laravel\Nova\Resource $resource): ?static {
        return new static();
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model  $model
     */
    public static function forModel($model): static {
        return new static();
    }
    /**
     * @param  \Laravel\Nova\Resource|\Illuminate\Database\Eloquent\Model|object  $resource
     */
    protected function resolveAttribute($resource, string $attribute): string|int|null {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return $this
     */
    public function asBigInt() {
        return $this;
    }
    /**
     * @return $this
     */
    public function hide() {
        return $this;
    }
    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
