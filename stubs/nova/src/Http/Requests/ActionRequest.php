<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Http\Requests;

use Closure;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Actions\ActionModelCollection;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\FieldCollection;
use Laravel\Nova\Support\Fluent;
use Laravel\Nova\TrashedStatus;
use Laravel\Nova\Filters\FilterDecoder;

/**
 * @property-read string|null $resources
 * @property-read string|null $pivotAction
 */
class ActionRequest extends \Laravel\Nova\Http\Requests\NovaRequest
{
    /**
     * @return \Laravel\Nova\Actions\Action|\Laravel\Nova\Actions\DestructiveAction
     */
    public function action(): \Laravel\Nova\Actions\Action {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    protected function resolveActions(): \Illuminate\Support\Collection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    protected function availableActions(): \Illuminate\Support\Collection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    protected function actionExists(): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function isPivotAction(): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Closure(\Laravel\Nova\Actions\ActionModelCollection):mixed  $callback
     * @return array<int, mixed>
     */
    public function chunks(int $count, \Closure $callback): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function toSelectedResourceQuery(): \Illuminate\Contracts\Database\Eloquent\Builder {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function toQueryWithoutScopes(): \Illuminate\Contracts\Database\Eloquent\Builder {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    protected function modelsViaRelationship(): \Illuminate\Contracts\Database\Eloquent\Builder {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Illuminate\Support\LazyCollection|\Illuminate\Database\Eloquent\Collection  $chunk
     * @return \Laravel\Nova\Actions\ActionModelCollection<array-key, \Illuminate\Database\Eloquent\Model>
     */
    protected function mapChunk($chunk): \Laravel\Nova\Actions\ActionModelCollection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validateFields(): void {
    }
    public function resolveFieldsForStorage(): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function resolveFields(): \Laravel\Nova\Fields\ActionFields {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model  $model
     */
    public function actionableKey($model): string|int {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function actionableModel() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return int
     */
    public function targetKey($model) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function targetModel() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function pivotRelation(): \Illuminate\Database\Eloquent\Relations\MorphToMany|\Illuminate\Database\Eloquent\Relations\BelongsToMany|null {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function isActionRequest(): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function toQuery(): \Illuminate\Contracts\Database\Eloquent\Builder {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function newQuery(): \Illuminate\Contracts\Database\Eloquent\Builder {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function newQueryWithoutScopes(): \Illuminate\Contracts\Database\Eloquent\Builder {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function orderings(): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function filters(): \Illuminate\Support\Collection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    protected function availableFilters(): \Illuminate\Support\Collection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
