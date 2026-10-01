<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Actions;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Laravel\Nova\Http\Requests\ActionRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Nova;
use Laravel\Nova\Util;
use Throwable;
use function Orchestra\Sidekick\Eloquent\model_state;

/**
 * @property \Illuminate\Database\Eloquent\Model $target
 * @property \Illuminate\Foundation\Auth\User $user
 * @property array|null $changes
 * @property array|null $original
 */
class ActionEvent extends \Illuminate\Database\Eloquent\Model
{
    /**
     * @var array<string>
     */
    protected $guarded = [];
    /**
     * @var array<string, string>
     */
    protected $casts = ['changes' => 'array', 'original' => 'array'];
    /**
     * @var string
     */
    protected $dateFormat = 'Y-m-d H:i:s';
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function target() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return static
     */
    public static function forResourceCreate($user, $model) {
        return new static();
    }
    /**
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return static
     */
    public static function forResourceUpdate($user, $model) {
        return new static();
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model  $parent
     * @param  \Illuminate\Database\Eloquent\Relations\Pivot  $pivot
     * @return static
     */
    public static function forAttachedResource(\Laravel\Nova\Http\Requests\NovaRequest $request, $parent, $pivot) {
        return new static();
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model  $parent
     * @param  \Illuminate\Database\Eloquent\Relations\Pivot  $pivot
     * @return static
     */
    public static function forAttachedResourceUpdate(\Laravel\Nova\Http\Requests\NovaRequest $request, $parent, $pivot) {
        return new static();
    }
    /**
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     */
    public static function forResourceDelete($user, \Illuminate\Support\Collection $models): \Illuminate\Support\Collection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     */
    public static function forResourceRestore($user, \Illuminate\Support\Collection $models): \Illuminate\Support\Collection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     */
    public static function forSoftDeleteAction(string $action, $user, \Illuminate\Support\Collection $models): \Illuminate\Support\Collection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \Illuminate\Database\Eloquent\Model  $parent
     */
    public static function forResourceDetach($user, $parent, \Illuminate\Support\Collection $models, string $pivotClass): \Illuminate\Support\Collection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function createForModels(\Laravel\Nova\Http\Requests\ActionRequest $request, \Laravel\Nova\Actions\Action $action, string $batchId, \Illuminate\Support\Collection $models, string $status = 'running'): void {
    }
    /**
     * @return array<string, mixed>
     */
    public static function defaultAttributes(\Laravel\Nova\Http\Requests\ActionRequest $request, \Laravel\Nova\Actions\Action $action, string $batchId, string $status = 'running'): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function prune(\Illuminate\Support\Collection $models, int $limit = 25): void {
    }
    public static function markBatchAsRunning(string $batchId): int {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function markBatchAsFinished(string $batchId): int {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model  $model
     */
    public static function markAsFinished(string $batchId, $model): int {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Throwable  $e
     */
    public static function markBatchAsFailed(string $batchId, \Throwable|string|null $e = null): int {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model  $model
     */
    public static function markAsFailed(string $batchId, $model, \Throwable|string|null $e = null): int {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model  $model
     */
    public static function updateStatus(string $batchId, $model, string $status, \Throwable|string|null $e = null): int {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function getTable(): string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
