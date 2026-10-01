<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Fields;

use Laravel\Nova\Contracts\Cover;
use Laravel\Nova\Nova;

/**
 * @method static static make(\Stringable|string|null $name = null, string|callable|null $attribute = null, string|null $disk = null, callable|null $storageCallback = null)
 */
class Avatar extends \Laravel\Nova\Fields\Image
{
    /**
     * @param  \Stringable|string|null  $name
     * @param  string|callable|null  $attribute
     * @param  (callable(\Illuminate\Http\Request, object, string, string, ?string, ?string):(mixed))|null  $storageCallback
     */
    public function __construct($name = null, mixed $attribute = null, ?string $disk = null, ?callable $storageCallback = null) {
    }
    /**
     * @param  \Stringable|string|null  $name
     */
    public static function gravatar($name = null, string $attribute = 'email'): \Laravel\Nova\Fields\Gravatar {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Stringable|string|null  $name
     */
    public static function uiavatar($name = null, string $attribute = 'name'): \Laravel\Nova\Fields\UiAvatar {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
