<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Actions;

use ArrayAccess;
use JsonSerializable;
use Laravel\Nova\Exceptions\HelperNotSupported;
use Laravel\Nova\Makeable;
use Laravel\Nova\URL;
use Stringable;

class ActionResponse implements \ArrayAccess, \JsonSerializable
{
    private ?\Laravel\Nova\Actions\Responses\Message $message = null;
    private ?\Laravel\Nova\Actions\Responses\Message $danger = null;
    private ?\Laravel\Nova\Actions\Responses\DownloadFile $download = null;
    private ?\Laravel\Nova\Actions\Responses\Event $event = null;
    private ?\Laravel\Nova\Actions\Responses\Redirect $redirect = null;
    private ?\Laravel\Nova\Actions\Responses\Visit $visit = null;
    private ?\Laravel\Nova\Actions\Responses\Modal $modal = null;
    private ?bool $deleted = null;
    /**
     * @return static
     */
    public static function message(\Stringable|string $message) {
        return new static();
    }
    /**
     * @return $this
     */
    public function withMessage(\Stringable|string $message) {
        return $this;
    }
    /**
     * @return static
     */
    public static function danger(\Stringable|string $message) {
        return new static();
    }
    /**
     * @return $this
     */
    public function withDangerMessage(\Stringable|string $message) {
        return $this;
    }
    /**
     * @return static
     */
    public static function deleted() {
        return new static();
    }
    /**
     * @return $this
     */
    public function withDeleted() {
        return $this;
    }
    /**
     * @param  array<string, mixed>  $data
     * @return static
     */
    public static function emit(string $event, array $data = []) {
        return new static();
    }
    /**
     * @param  array<string, mixed>  $data
     * @return $this
     */
    public function withEvent(string $event, array $data = []) {
        return $this;
    }
    /**
     * @return static
     */
    public static function redirect(string $url, bool $openInNewTab = false) {
        return new static();
    }
    /**
     * @return static
     */
    public static function openInNewTab(string $url) {
        return new static();
    }
    /**
     * @return $this
     */
    public function withRedirect(string $url, bool $openInNewTab = false) {
        return $this;
    }
    /**
     * @return $this
     * @throws \Laravel\Nova\Exceptions\HelperNotSupported
     */
    public function usingNewTab() {
        return $this;
    }
    /**
     * @param  array<string, mixed>  $options
     * @return static
     */
    public static function visit(\Laravel\Nova\URL|string $path, array $options = []) {
        return new static();
    }
    /**
     * @param  array<string, mixed>  $options
     * @return $this
     */
    public function withVisitOptions(\Laravel\Nova\URL|string $path, array $options = []) {
        return $this;
    }
    /**
     * @return static
     */
    public static function download(\Stringable|string $name, string $url) {
        return new static();
    }
    /**
     * @return $this
     */
    public function withDownload(\Stringable|string $name, string $url) {
        return $this;
    }
    /**
     * @return static
     */
    public static function modal(string $modal, array $data) {
        return new static();
    }
    /**
     * @return $this
     */
    public function withModal(string $modal, array $data = []) {
        return $this;
    }
    /**
     * @param  string  $offset
     */
    public function offsetExists($offset): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  string  $offset
     * @return mixed|null
     */
    public function offsetGet($offset): mixed {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  string  $offset
     */
    public function offsetSet($offset, $value): void {
    }
    /**
     * @param  string  $offset
     */
    public function offsetUnset($offset): void {
    }
    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return static
     */
    public static function make(...$arguments) {
        return new static(...$arguments);
    }
}
