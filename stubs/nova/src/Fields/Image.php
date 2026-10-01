<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Fields;

use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Contracts\Cover;

class Image extends \Laravel\Nova\Fields\File implements \Laravel\Nova\Contracts\Cover
{
    public const ASPECT_AUTO = 'aspect-auto';
    public const ASPECT_SQUARE = 'aspect-square';
    /**
     * @var bool
     */
    public $showOnIndex = true;
    /**
     * @var int|null
     */
    public $maxWidth = null;
    /**
     * @var int
     */
    public $indexWidth = 32;
    /**
     * @var int
     */
    public $detailWidth = 128;
    /**
     * @var bool
     */
    public $rounded = false;
    /**
     * @var string
     */
    public $aspect = 'aspect-auto';
    /**
     * @param  \Stringable|string  $name
     * @param  string|callable|null  $attribute
     * @param  (callable(\Illuminate\Http\Request, object, string, string, ?string, ?string):(mixed))|null  $storageCallback
     */
    public function __construct($name, mixed $attribute = null, ?string $disk = null, ?callable $storageCallback = null) {
    }
    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return $this
     */
    public function maxWidth(int $maxWidth) {
        return $this;
    }
    /**
     * @return $this
     */
    public function indexWidth(int $width) {
        return $this;
    }
    /**
     * @return $this
     */
    public function detailWidth(int $detailWidth) {
        return $this;
    }
    /**
     * @return $this
     */
    public function rounded() {
        return $this;
    }
    /**
     * @return $this
     */
    public function squared() {
        return $this;
    }
    /**
     * @return $this
     */
    public function aspect(string $aspect) {
        return $this;
    }
    /**
     * @return bool
     */
    public function isRounded() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function isSquared(): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function imageAttributes(): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
