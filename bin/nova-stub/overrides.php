<?php

declare(strict_types=1);

$N = 'Laravel\\Nova\\';

return [
    $N . 'Nova::version' => "return \\Composer\\InstalledVersions::getPrettyVersion('laravel/nova') ?? '5.x';",
    $N . 'Nova::user' => "return (\$request ?? request())->user(config('nova.guard'));",
    $N . 'Nova::serving' => "\\Illuminate\\Support\\Facades\\Event::listen(\\Laravel\\Nova\\Events\\ServingNova::class, \$callback);",
    $N . 'Nova::path' => "return \\sprintf('/%s', ltrim((string) config('nova.path', '/nova'), '/'));",
    $N . 'Nova::url' => "return rtrim(static::path(), '/') . '/' . ltrim((string) \$url, '/');",
    $N . 'Nova::router' => "return \\Illuminate\\Support\\Facades\\Route::domain(config('nova.domain'))\n    ->prefix(static::url(\$prefix))\n    ->middleware(\$middleware ?? config('nova.middleware', []));",
    $N . 'Nova::routes' => "return static::\$routesResolver ??= new \\Laravel\\Nova\\PendingRouteRegistration();",
    $N . 'Nova::fortify' => "return static::\$fortifyResolver ??= new \\Laravel\\Nova\\PendingFortifyConfiguration();",
    $N . 'PendingRouteRegistration::defaultAuthentication' => 'return true;',
    $N . 'PendingFortifyConfiguration::enabled' => 'return false;',
    $N . 'PendingFortifyConfiguration::hasSecurityFeatures' => 'return false;',
    $N . 'PendingFortifyConfiguration::canManageTwoFactorAuthentication' => 'return false;',
    $N . 'PendingFortifyConfiguration::usingIdenticalGuardOrModel' => 'return true;',
    $N . 'NovaApplicationServiceProvider::register' => "\$this->fortify();\n\n\$this->booted(function (): void {\n    \$this->gate();\n    \$this->bootAuthentication();\n    \$this->bootRoutes();\n});",
    $N . 'NovaApplicationServiceProvider::boot' => "\\Laravel\\Nova\\Nova::serving(function (): void {\n    \$this->authorization();\n    \$this->resources();\n    \\Laravel\\Nova\\Nova::dashboards(\$this->dashboards());\n    \\Laravel\\Nova\\Nova::tools(\$this->tools());\n});",
    $N . 'NovaApplicationServiceProvider::bootRoutes' => '$this->routes();',
    $N . 'NovaApplicationServiceProvider::fortify' => '\\Laravel\\Nova\\Nova::fortify()->register();',
    $N . 'NovaApplicationServiceProvider::routes' => '\\Laravel\\Nova\\Nova::routes()->register();',
    $N . 'NovaApplicationServiceProvider::authorization' => "\\Laravel\\Nova\\Nova::auth(static fn (\$request): bool => app()->environment('local') || \\Illuminate\\Support\\Facades\\Gate::check('viewNova', [\\Laravel\\Nova\\Nova::user(\$request)]));",
    $N . 'NovaApplicationServiceProvider::gate' => "\\Illuminate\\Support\\Facades\\Gate::define('viewNova', static fn (\$user): bool => false);",
    $N . 'NovaApplicationServiceProvider::dashboards' => 'return [];',
    $N . 'NovaApplicationServiceProvider::tools' => 'return [];',
    $N . 'NovaApplicationServiceProvider::resources' => "\\Laravel\\Nova\\Nova::resourcesIn(app_path('Nova'));",
];
