<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Laravel\Nova\TrashedStatus;
use Mockery as m;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Nova;
use Laravel\Nova\Resource;
use Laravel\Nova\Contracts\QueryBuilder;
use Illuminate\Support\Arr;

/**
 * @property-read string|null $resource
 * @property-read int|string|null $resourceId
 * @property-read string|null $relatedResource
 * @property-read int|string|null $relatedResourceId
 * @property-read string|null $viaResource
 * @property-read int|string|null $viaResourceId
 * @property-read string|null $viaRelationship
 * @property-read string|null $relationshipType
 */
class NovaRequest extends \Illuminate\Foundation\Http\FormRequest
{
    /**
     * @param  string|resource|null  $content
     * @param  array<string, mixed>  $routes
     */
    public static function fake(string $uri, string $method = 'GET', array $parameters = [], array $cookies = [], array $files = [], array $server = [], $content = null, array $routes = []): static {
        return new static();
    }
    public function user($guard = null) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function isInlineCreateRequest(): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function isCreateOrAttachRequest(): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function isUpdateOrUpdateAttachedRequest(): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function isResourceIndexRequest(): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function isResourceDetailRequest(): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function isResourcePreviewRequest(): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function isResourcePeekingRequest(): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function isLensRequest(): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function isActionRequest(): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function isFormRequest(): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function isPresentationRequest(): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function trashed(): \Laravel\Nova\TrashedStatus {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function createFromBase(\Symfony\Component\HttpFoundation\Request $request): static {
        return new static();
    }
    protected function shouldFailOnUnknownFields(): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\Resource<\Illuminate\Database\Eloquent\Model>
     */
    public function findParentResource(string|int|null $resourceId = null): \Laravel\Nova\Resource {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\Resource<\Illuminate\Database\Eloquent\Model>
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findParentResourceOrFail(string|int|null $resourceId = null): \Laravel\Nova\Resource {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function findParentModel(string|int|null $resourceId = null): ?\Illuminate\Database\Eloquent\Model {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findParentModelOrFail(string|int|null $resourceId = null): \Illuminate\Database\Eloquent\Model {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\Resource<\Illuminate\Database\Eloquent\Model>
     */
    public function findRelatedResource(string|int|null $resourceId = null): \Laravel\Nova\Resource {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\Resource<\Illuminate\Database\Eloquent\Model>
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findRelatedResourceOrFail(string|int|null $resourceId = null): \Laravel\Nova\Resource {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function findRelatedModel(string|int|null $resourceId = null): \Illuminate\Database\Eloquent\Model {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findRelatedModelOrFail(string|int|null $resourceId = null): \Illuminate\Database\Eloquent\Model {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function pivotName(): string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return class-string<\Laravel\Nova\Resource>|null
     */
    public function relatedResource(): ?string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\Resource<\Illuminate\Database\Eloquent\Model>
     */
    public function newRelatedResource(): \Laravel\Nova\Resource {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return class-string<\Laravel\Nova\Resource>|null
     */
    public function viaResource(): ?string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\Resource<\Illuminate\Database\Eloquent\Model>
     */
    public function newViaResource(): \Laravel\Nova\Resource {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function viaRelationship(): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function viaManyToMany(): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return bool
     */
    public function authorize() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array
     */
    public function rules() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return bool
     */
    public function resourceSoftDeletes() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return class-string<\Laravel\Nova\Resource>
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function resource() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\Resource<\Illuminate\Database\Eloquent\Model>
     */
    public function newResource() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  string|int|null  $resourceId
     * @return \Laravel\Nova\Resource<\Illuminate\Database\Eloquent\Model>
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findResourceOrFail($resourceId = null) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  string|int|null  $resourceId
     * @return \Laravel\Nova\Resource
     */
    public function findResource($resourceId = null) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  string|int|null  $resourceId
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findModelOrFail($resourceId = null) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  string|int|null  $resourceId
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findModel($resourceId = null) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  mixed|null  $resourceId
     * @return \Illuminate\Contracts\Database\Eloquent\Builder
     */
    public function findModelQuery($resourceId = null) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return \Laravel\Nova\Resource<\Illuminate\Database\Eloquent\Model>
     */
    public function newResourceWith($model) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function newQuery() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function newQueryWithoutScopes() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function model() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return bool
     */
    public function allResourcesSelected() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Illuminate\Support\Collection<int, string|int>|null
     */
    public function selectedResourceIds() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|null
     */
    public function selectedResources() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
