<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Fields;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Contracts\Deletable as DeletableContract;
use Laravel\Nova\Contracts\Downloadable as DownloadableContract;
use Laravel\Nova\Contracts\Storable as StorableContract;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Laravel\Nova\Resource;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;
use RuntimeException;

/**
 * @method static static make(\Stringable|string $name, string|callable|null $attribute = null, string|null $disk = null, callable|null $storageCallback = null)
 */
class File extends \Laravel\Nova\Fields\Field implements \Laravel\Nova\Contracts\Deletable, \Laravel\Nova\Contracts\Downloadable, \Laravel\Nova\Contracts\Storable
{
    /**
     * @var string
     */
    public $component = 'file-field';
    /**
     * @var string
     */
    public $textAlign = 'center';
    /**
     * @var bool
     */
    public $showOnIndex = false;
    /**
     * @var callable(\Illuminate\Http\Request, \Illuminate\Database\Eloquent\Model|\Laravel\Nova\Support\Fluent, string, string, ?string, ?string):mixed
     */
    public $storageCallback = null;
    /**
     * @var (callable(\Illuminate\Http\Request, \Illuminate\Database\Eloquent\Model|\Laravel\Nova\Support\Fluent, string, string, ?string, ?string):string)|null
     */
    public $storeAsCallback = null;
    /**
     * @var string|null
     */
    public $originalNameColumn = null;
    /**
     * @var string|null
     */
    public $sizeColumn = null;
    /**
     * @var string|null
     */
    public $acceptedTypes = null;
    /**
     * @var callable|null
     */
    public $deleteCallback = null;
    /**
     * @var bool
     */
    public $deletable = true;
    /**
     * @var bool
     */
    public $prunable = false;
    /**
     * @var (callable(\Laravel\Nova\Http\Requests\NovaRequest, object, ?string, ?string):(mixed))|null
     * @phpstan-var TDownloadResponseCallback|null
     */
    public $downloadResponseCallback = null;
    /**
     * @var bool
     */
    public $downloadsAreEnabled = true;
    /**
     * @var (callable(mixed, ?string, mixed):(?string))|null
     */
    public $previewUrlCallback = null;
    /**
     * @var (callable(mixed, string, mixed):?string)|null
     */
    public $thumbnailUrlCallback = null;
    /**
     * @var string|null
     */
    public $disk = null;
    /**
     * @var string
     */
    public $storagePath = '/';
    /**
     * @var array<int, \Laravel\Nova\Fields\Dependent>
     */
    protected $fieldDependencies = [];
    /**
     * @param  \Stringable|string  $name
     * @param  string|callable|null  $attribute
     * @param  (callable(\Illuminate\Http\Request, \Illuminate\Database\Eloquent\Model|\Laravel\Nova\Support\Fluent, string, string, ?string, ?string):(mixed))|null  $storageCallback
     */
    public function __construct($name, mixed $attribute = null, ?string $disk = null, ?callable $storageCallback = null) {
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model|\Laravel\Nova\Support\Fluent  $model
     */
    protected function storeFile(\Illuminate\Http\Request $request, $model, string $attribute, string $requestAttribute): string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    protected function mergeExtraStorageColumns(\Illuminate\Http\Request $request, string $requestAttribute, array $attributes): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    protected function columnsThatShouldBeDeleted(): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return string|null
     */
    public function getStorageDisk() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  callable(\Illuminate\Http\Request, \Illuminate\Database\Eloquent\Model|\Laravel\Nova\Support\Fluent, string, string, ?string, ?string):mixed  $storageCallback
     * @return $this
     */
    public function store(callable $storageCallback) {
        return $this;
    }
    /**
     * @param  callable(\Illuminate\Http\Request, \Illuminate\Database\Eloquent\Model|\Laravel\Nova\Support\Fluent, string, string, ?string, ?string):string  $storeAsCallback
     * @return $this
     */
    public function storeAs(callable $storeAsCallback) {
        return $this;
    }
    /**
     * @param  callable(mixed, string, mixed):?string  $thumbnailUrlCallback
     * @return $this
     */
    public function thumbnail(callable $thumbnailUrlCallback) {
        return $this;
    }
    /**
     * @param  callable(mixed, ?string, mixed):?string  $previewUrlCallback
     * @return $this
     */
    public function preview(callable $previewUrlCallback) {
        return $this;
    }
    /**
     * @return $this
     */
    public function storeOriginalName(string $column) {
        return $this;
    }
    /**
     * @return $this
     */
    public function storeSize(string $column) {
        return $this;
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model|\Laravel\Nova\Support\Fluent  $model
     */
    public function fillForAction(\Laravel\Nova\Http\Requests\NovaRequest $request, object $model): void {
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model|\Laravel\Nova\Support\Fluent  $model
     */
    protected function fillAttribute(\Laravel\Nova\Http\Requests\NovaRequest $request, string $requestAttribute, object $model, string $attribute): mixed {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return string|null
     */
    public function getStoragePath() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    protected function retrieveFileFromRequest(\Illuminate\Http\Request $request, string $requestAttribute): ?\Illuminate\Http\UploadedFile {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return $this
     */
    public function acceptedTypes(string $acceptedTypes) {
        return $this;
    }
    /**
     * @return $this
     */
    public function delete(callable $deleteCallback) {
        return $this;
    }
    /**
     * @return $this
     */
    public function deletable(bool $deletable = true) {
        return $this;
    }
    /**
     * @return bool
     */
    public function isPrunable() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  bool  $prunable
     * @return $this
     */
    public function prunable($prunable = true) {
        return $this;
    }
    /**
     * @return $this
     */
    public function disableDownload() {
        return $this;
    }
    /**
     * @param  callable(\Laravel\Nova\Http\Requests\NovaRequest, object, ?string, ?string):mixed  $downloadResponseCallback
     * @phpstan-param TDownloadResponseCallback $downloadResponseCallback
     * @return $this
     */
    public function download(callable $downloadResponseCallback) {
        return $this;
    }
    public function toDownloadResponse(\Laravel\Nova\Http\Requests\NovaRequest $request, \Laravel\Nova\Resource $resource): \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\BinaryFileResponse|\Symfony\Component\HttpFoundation\StreamedResponse {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function resolvePreviewUrl(): ?string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return string|null
     */
    public function resolveThumbnailUrl() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  string  $disk
     * @return $this
     */
    public function disk($disk) {
        return $this;
    }
    /**
     * @param  string  $path
     * @return $this
     */
    public function path($path) {
        return $this;
    }
    /**
     * @return string
     */
    public function getDefaultStorageDisk() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return string|null
     */
    public function getStorageDir() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Laravel\Nova\Fields\Field|array<int, string|\Laravel\Nova\Fields\Field>|string  $attributes
     * @param  (callable(static, \Laravel\Nova\Http\Requests\NovaRequest, \Laravel\Nova\Fields\FormData):(void))|class-string  $mixin
     * @return $this
     */
    public function dependsOn(\Laravel\Nova\Fields\Field|array|string $attributes, callable|string $mixin) {
        return $this;
    }
    /**
     * @param  \Laravel\Nova\Fields\Field|array<int, string|\Laravel\Nova\Fields\Field>|string  $attributes
     * @param  (callable(static, \Laravel\Nova\Http\Requests\NovaRequest, \Laravel\Nova\Fields\FormData):(void))|class-string  $mixin
     * @return $this
     */
    public function dependsOnCreating(\Laravel\Nova\Fields\Field|array|string $attributes, callable|string $mixin) {
        return $this;
    }
    /**
     * @param  string|\Laravel\Nova\Fields\Field|array<int, string|\Laravel\Nova\Fields\Field>  $attributes
     * @param  (callable(static, \Laravel\Nova\Http\Requests\NovaRequest, \Laravel\Nova\Fields\FormData):(void))|class-string  $mixin
     * @return $this
     */
    public function dependsOnUpdating($attributes, $mixin) {
        return $this;
    }
}
