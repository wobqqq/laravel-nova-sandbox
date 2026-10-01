<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova;

use BackedEnum;
use BadMethodCallException;
use Carbon\CarbonInterval;
use Closure;
use Illuminate\Console\Command;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Http\Client\Response as ClientResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Laravel\Nova\Actions\ActionResource;
use Laravel\Nova\Contracts\ImpersonatesUsers;
use Laravel\Nova\Exceptions\ResourceMissingException;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Menu\Menu;
use Laravel\Nova\Support\PendingTranslation;
use Laravel\Prompts\PasswordPrompt;
use Laravel\Prompts\Prompt;
use Laravel\Prompts\TextPrompt;
use ReflectionClass;
use Stringable;
use Symfony\Component\Finder\Finder;
use function Illuminate\Filesystem\join_paths;
use function Orchestra\Sidekick\is_safe_callable;
use Illuminate\Routing\RouteRegistrar;
use Illuminate\Support\Facades\Route;
use Laravel\Nova\PendingRouteRegistration;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Actions\ActionEvent;
use Laravel\Nova\Script;
use Laravel\Nova\Style;
use Illuminate\Support\Facades\Event;
use Laravel\Nova\Events\NovaServiceProviderRegistered;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\PendingFortifyConfiguration;

/**
 * @method static bool runsMigrations()
 */
class Nova
{
    /**
     * @var array<int, \Laravel\Nova\Dashboard>
     */
    public static array $dashboards = [];
    /**
     * @var array<int, class-string<\Laravel\Nova\Resource>>
     */
    public static array $resources = [];
    /**
     * @var array<class-string<\Illuminate\Database\Eloquent\Model>, class-string<\Laravel\Nova\Resource>>
     */
    public static array $resourcesByModel = [];
    /**
     * @var (callable(mixed...):(\Illuminate\Database\Eloquent\Model))|(\Closure(mixed...):(\Illuminate\Database\Eloquent\Model))|null
     */
    public static $createUserCallback = null;
    /**
     * @var (callable(\Illuminate\Console\Command):(array<int, \Laravel\Prompts\Prompt|mixed>))|null
     */
    public static $createUserCommandCallback = null;
    /**
     * @var (callable(\Illuminate\Http\Request):(?string))|null
     */
    public static $userLocaleCallback = null;
    /**
     * @var (callable(\Illuminate\Http\Request):(?string))|null
     */
    public static $userTimezoneCallback = null;
    /**
     * @var array<int, \Laravel\Nova\Tool>
     */
    public static array $tools = [];
    /**
     * @var array<string, mixed>
     */
    public static array $jsonVariables = [];
    /**
     * @var (callable(\Throwable):(void))|null
     */
    public static $reportCallback = null;
    public static bool $runsMigrations = true;
    /**
     * @var array<string, string>
     */
    public static array $translations = [];
    /**
     * @var (callable(class-string<\Laravel\Nova\Resource>):(mixed))|null
     */
    public static $sortCallback = null;
    /**
     * @var float
     */
    public static $debounce = 0.5;
    /**
     * @var (callable(\Illuminate\Http\Request, \Laravel\Nova\Menu\Menu):(\Laravel\Nova\Menu\Menu|iterable))|null
     */
    public static $mainMenuCallback = null;
    /**
     * @var (callable(\Illuminate\Http\Request, \Laravel\Nova\Menu\Menu):(\Laravel\Nova\Menu\Menu|array))|null
     */
    public static $userMenuCallback = null;
    /**
     * @var (callable(\Illuminate\Http\Request):(string|\Stringable))|null
     */
    public static $footerCallback = null;
    /**
     * @var (\Closure(\Laravel\Nova\Http\Requests\NovaRequest):(bool))|bool|null
     */
    public static \Closure|bool|null $rtlCallback;
    /**
     * @var (callable(\Laravel\Nova\Http\Requests\NovaRequest):(bool))|bool
     */
    public static $withBreadcrumbs = false;
    public static int $notificationPollingInterval = 7;
    public static bool $withGlobalSearch = true;
    public static bool $withNotificationCenter = true;
    public static bool $withThemeSwitcher = true;
    public static bool $showUnreadCountInNotificationCenter = false;
    /**
     * @var (\Closure(\Illuminate\Http\Request):(bool))|null
     */
    public static $authUsing = null;
    /**
     * @var (\Closure(\Illuminate\Http\Request):(string|null))|string
     */
    public static \Closure|string $initialPath = '/dashboards/main';
    public static ?\Laravel\Nova\PendingRouteRegistration $routesResolver = null;
    /**
     * @var array<int, \Laravel\Nova\Script>
     */
    public static array $scripts = [];
    /**
     * @var array<int, \Laravel\Nova\Style>
     */
    public static array $styles = [];
    public static ?\Laravel\Nova\PendingFortifyConfiguration $fortifyResolver = null;
    public static function version(): string {
        return \Composer\InstalledVersions::getPrettyVersion('laravel/nova') ?? '5.x';
    }
    public static function name(): \Stringable|string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  callable(\Laravel\Nova\Http\Requests\NovaRequest):mixed  $callback
     * @param  (callable(\Illuminate\Http\Request):(mixed))|null  $default
     */
    public static function whenServing(callable $callback, ?callable $default = null): mixed {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Illuminate\Foundation\Auth\User|null
     */
    public static function user(?\Illuminate\Http\Request $request = null) {
        return ($request ?? request())->user(config('nova.guard'));
    }
    public static function impersonator(): \Laravel\Nova\Contracts\ImpersonatesUsers {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function withAuthentication(): static {
        return new static();
    }
    public static function withPasswordReset(): static {
        return new static();
    }
    public static function bootResources(): void {
    }
    public static function resourcesForNavigation(\Illuminate\Http\Request $request): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\ResourceCollection<int, class-string<\Laravel\Nova\Resource>>
     */
    public static function authorizedResources(\Illuminate\Http\Request $request): \Laravel\Nova\ResourceCollection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\ResourceCollection<int, class-string<\Laravel\Nova\Resource>>
     */
    public static function resourceCollection(): \Laravel\Nova\ResourceCollection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return callable(class-string<\Laravel\Nova\Resource>):mixed
     */
    public static function sortResourcesWith(): callable {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  array<int, class-string<\Laravel\Nova\Resource>>  $resources
     */
    public static function replaceResources(array $resources): static {
        return new static();
    }
    public static function groups(\Illuminate\Http\Request $request): \Illuminate\Support\Collection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array<int, class-string<\Laravel\Nova\Resource>>
     */
    public static function availableResources(\Illuminate\Http\Request $request): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array<string, \Laravel\Nova\ResourceCollection<int, class-string<\Laravel\Nova\Resource>>>
     */
    public static function groupedResources(\Illuminate\Http\Request $request): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Illuminate\Support\Collection<array-key, \Laravel\Nova\ResourceCollection<array-key, class-string<\Laravel\Nova\Resource>>>
     */
    public static function groupedResourcesForNavigation(\Illuminate\Http\Request $request): \Illuminate\Support\Collection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function resourcesIn(string $directory): void {
    }
    /**
     * @param  array<int, class-string<\Laravel\Nova\Resource>>  $resources
     */
    public static function resources(array $resources): static {
        return new static();
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return \Laravel\Nova\Resource<\Illuminate\Database\Eloquent\Model>
     * @throws \Laravel\Nova\Exceptions\ResourceMissingException
     */
    public static function newResourceFromModel($model): \Laravel\Nova\Resource {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model|class-string<\Illuminate\Database\Eloquent\Model>  $class
     * @return class-string<\Laravel\Nova\Resource>|null
     */
    public static function resourceForModel($class): ?string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\Resource|null
     */
    public static function resourceInstanceForKey(?string $key): ?\Laravel\Nova\Resource {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return class-string<\Laravel\Nova\Resource>|null
     */
    public static function resourceForKey(?string $key): ?string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public static function modelInstanceForKey(?string $key) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function createUser(\Illuminate\Console\Command $command): mixed {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  (callable(\Illuminate\Console\Command):(array<int, \Laravel\Prompts\Prompt|mixed>))|null  $createUserCommandCallback
     * @param  (callable(mixed...):(\Illuminate\Database\Eloquent\Model))|(\Closure(mixed...):(\Illuminate\Database\Eloquent\Model))|null  $createUserCallback
     */
    public static function createUserUsing(?callable $createUserCommandCallback = null, ?callable $createUserCallback = null): static {
        return new static();
    }
    /**
     * @return \Closure(\Illuminate\Console\Command):array<int, \Laravel\Prompts\Prompt|mixed>
     */
    protected static function defaultCreateUserCommandCallback(): callable {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Closure(string, string, string):\Illuminate\Database\Eloquent\Model
     */
    protected static function defaultCreateUserCallback(): \Closure {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  (callable(\Illuminate\Http\Request):(?string))|null  $userTimezoneCallback
     */
    public static function userTimezone(?callable $userTimezoneCallback): static {
        return new static();
    }
    public static function resolveUserTimezone(\Illuminate\Http\Request $request): ?string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  array<int, \Laravel\Nova\Tool>  $tools
     */
    public static function tools(array $tools): static {
        return new static();
    }
    /**
     * @return array<int, \Laravel\Nova\Tool>
     */
    public static function registeredTools(): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function bootTools(\Illuminate\Http\Request $request): void {
    }
    /**
     * @return array<int, \Laravel\Nova\Tool>
     */
    public static function availableTools(\Illuminate\Http\Request $request): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array<int, \Laravel\Nova\Dashboard>
     */
    public static function availableDashboards(\Illuminate\Http\Request $request): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  array<int, \Laravel\Nova\Dashboard>  $dashboards
     */
    public static function dashboards(array $dashboards): static {
        return new static();
    }
    public static function dashboardForKey(string $dashboard, \Laravel\Nova\Http\Requests\NovaRequest $request): ?\Laravel\Nova\Dashboard {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function availableDashboardCardsForDashboard(string $dashboard, \Laravel\Nova\Http\Requests\NovaRequest $request): \Illuminate\Support\Collection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  array<string, string>|string  $translations
     */
    public static function translations(array|string $translations): static {
        return new static();
    }
    /**
     * @return array<string, string>
     */
    public static function allTranslations(): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array<string, mixed>
     */
    public static function jsonVariables(\Illuminate\Http\Request $request): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function ignoreMigrations(): static {
        return new static();
    }
    public static function humanize(object|string $value): string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  (callable(\Throwable):(void))|null  $callback
     */
    public static function report(?callable $callback): static {
        return new static();
    }
    /**
     * @param  array<string, mixed>  $variables
     */
    public static function provideToScript(array $variables): static {
        return new static();
    }
    public static function checkLicenseValidity(): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function checkLicense(): \Illuminate\Http\Client\Response {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function logo(): ?string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function rtlEnabled(): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  (\Closure(\Laravel\Nova\Http\Requests\NovaRequest):(bool))|bool  $rtlCallback
     */
    public static function enableRTL(\Closure|bool $rtlCallback = true): static {
        return new static();
    }
    public static function hasGloballySearchableResources(): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function globalSearchIsEnabled(): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array<int, class-string<\Laravel\Nova\Resource>>
     */
    public static function globallySearchableResources(\Illuminate\Http\Request $request): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function resolveMainMenu(\Illuminate\Http\Request $request): \Laravel\Nova\Menu\Menu|\Traversable|array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function defaultMainMenu(\Illuminate\Http\Request $request): \Laravel\Nova\Menu\Menu {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function resolveUserMenu(\Illuminate\Http\Request $request): \Laravel\Nova\Menu\Menu {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function defaultUserMenu(\Illuminate\Http\Request $request): \Laravel\Nova\Menu\Menu {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array<int, array<string, mixed>>
     */
    public static function resourceInformation(\Illuminate\Http\Request $request): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return mixed
     * @throws \BadMethodCallException
     */
    public static function __callStatic(string $method, array $parameters) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  callable(class-string<\Laravel\Nova\Resource>):mixed  $callback
     */
    public static function sortResourcesBy(callable $callback): static {
        return new static();
    }
    public static function globalSearchDebounce(\Carbon\CarbonInterval|int $debounce): static {
        return new static();
    }
    /**
     * @param  callable(\Illuminate\Http\Request, \Laravel\Nova\Menu\Menu):(\Laravel\Nova\Menu\Menu|iterable)  $callback
     */
    public static function mainMenu(callable $callback): static {
        return new static();
    }
    /**
     * @param  callable(\Illuminate\Http\Request, \Laravel\Nova\Menu\Menu):(\Laravel\Nova\Menu\Menu|array)  $userMenuCallback
     */
    public static function userMenu(callable $userMenuCallback): static {
        return new static();
    }
    /**
     * @param  (callable(\Laravel\Nova\Http\Requests\NovaRequest):(bool))|bool  $withBreadcrumbs
     */
    public static function withBreadcrumbs(callable|bool $withBreadcrumbs = true): static {
        return new static();
    }
    public static function breadcrumbsEnabled(): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function notificationPollingInterval(\Carbon\CarbonInterval|int $seconds): static {
        return new static();
    }
    /**
     * @param  callable(\Illuminate\Http\Request):(\Stringable|string)  $footerCallback
     */
    public static function footer(callable $footerCallback): static {
        return new static();
    }
    public static function resolveFooter(\Illuminate\Http\Request $request): string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function defaultFooter(\Illuminate\Http\Request $request): string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function withoutGlobalSearch(): static {
        return new static();
    }
    public static function withoutNotificationCenter(): static {
        return new static();
    }
    public static function withoutThemeSwitcher(): static {
        return new static();
    }
    public static function brandColors(): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function brandColorsCSS(): string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  (callable(\Illuminate\Http\Request):(?string))|null  $userLocaleCallback
     */
    public static function userLocale(?callable $userLocaleCallback): static {
        return new static();
    }
    public static function resolveUserLocale(\Illuminate\Http\Request $request): string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  array<string, string>  $replace
     */
    public static function __(\Laravel\Nova\Support\PendingTranslation|string|null $key = null, array $replace = [], ?string $locale = null): \Laravel\Nova\Support\PendingTranslation {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function showUnreadCountInNotificationCenter(): static {
        return new static();
    }
    /**
     * @param  \Closure(\Illuminate\Http\Request):bool  $callback
     */
    public static function auth(\Closure $callback): static {
        return new static();
    }
    /**
     * @param  \Illuminate\Http\Request  $request
     */
    public static function check($request): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function path(): string {
        return \sprintf('/%s', ltrim((string) config('nova.path', '/nova'), '/'));
    }
    public static function url(?string $url = null): string {
        return rtrim(static::path(), '/') . '/' . ltrim((string) $url, '/');
    }
    /**
     * @param  array<int, class-string|string>|null  $middleware
     */
    public static function router(?array $middleware = null, ?string $prefix = null): \Illuminate\Routing\RouteRegistrar {
        return \Illuminate\Support\Facades\Route::domain(config('nova.domain'))
            ->prefix(static::url($prefix))
            ->middleware($middleware ?? config('nova.middleware', []));
    }
    public static function routes(): \Laravel\Nova\PendingRouteRegistration {
        return static::$routesResolver ??= new \Laravel\Nova\PendingRouteRegistration();
    }
    /**
     * @param  (\Closure(\Illuminate\Http\Request):(string|null))|string  $path
     */
    public static function initialPath(\Closure|string $path): static {
        return new static();
    }
    public static function resolveInitialPath(\Illuminate\Http\Request $request): string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function initialPathUrl(\Illuminate\Http\Request $request): string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return class-string<\Laravel\Nova\Actions\ActionResource>
     */
    public static function actionResource(): string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function actionEvent(): \Illuminate\Database\Eloquent\Model|\Laravel\Nova\Actions\ActionEvent {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  callable(\Laravel\Nova\Actions\ActionEvent):mixed  $callback
     */
    public static function usingActionEvent(callable $callback): mixed {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function withoutActionEvents(): static {
        return new static();
    }
    /**
     * @return array<int, \Laravel\Nova\Script>
     */
    public static function allScripts(): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array<int, \Laravel\Nova\Script>
     */
    public static function availableScripts(\Illuminate\Http\Request $request): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array<int, \Laravel\Nova\Style>
     */
    public static function allStyles(): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array<int, \Laravel\Nova\Style>
     */
    public static function availableStyles(\Illuminate\Http\Request $request): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function remoteScript(string $path): static {
        return new static();
    }
    public static function script(\Laravel\Nova\Script|string $name, string $path): static {
        return new static();
    }
    public static function remoteStyle(string $path): static {
        return new static();
    }
    public static function style(\Laravel\Nova\Style|string $name, string $path): static {
        return new static();
    }
    /**
     * @param  array<int, string>|null  $assets
     */
    public static function mix(string $name, string $path, ?array $assets = null): static {
        return new static();
    }
    /**
     * @param  (\Closure(\Laravel\Nova\Events\NovaServiceProviderRegistered):(void))|string|array  $callback
     * @return void
     */
    public static function booted(\Closure|array|string $callback) {
    }
    /**
     * @param  (\Closure(\Laravel\Nova\Events\ServingNova):(void))|string|array  $callback
     * @return void
     */
    public static function serving(\Closure|array|string $callback) {
        \Illuminate\Support\Facades\Event::listen(\Laravel\Nova\Events\ServingNova::class, $callback);
    }
    /**
     * @return void
     */
    public static function flushState() {
    }
    public static function fortify(): \Laravel\Nova\PendingFortifyConfiguration {
        return static::$fortifyResolver ??= new \Laravel\Nova\PendingFortifyConfiguration();
    }
}
