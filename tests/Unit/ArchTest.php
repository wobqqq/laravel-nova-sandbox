<?php

declare(strict_types=1);
use App\Nova\User;

arch('the code is strictly typed', function (): void {
    expect(['App', 'Database', 'Tests'])->toUseStrictTypes();
});

arch('no debugging calls are left behind', function (): void {
    expect(['dd', 'ddd', 'dump', 'ray', 'var_dump', 'var_export', 'print_r', 'debug_print_backtrace', 'die', 'phpinfo'])
        ->not->toBeUsed();
});

arch('no insecure functions are used', function (): void {
    expect(['md5', 'sha1', 'uniqid', 'rand', 'mt_rand', 'eval', 'exec', 'shell_exec', 'system', 'passthru', 'unserialize', 'extract'])
        ->not->toBeUsed();
});

arch('controllers are invokable and final', function (): void {
    expect('App\Http\Controllers')
        ->toBeFinal()
        ->toHaveMethod('__invoke');
});

arch('application classes are final', function (): void {
    expect(['App\Http', 'App\Models', 'App\Nova\Dashboards', User::class, 'App\Providers', 'App\Support'])
        ->toBeFinal();
});

arch('value objects are readonly', function (): void {
    expect('App\Support')->toBeReadonly();
});

arch('support classes get their collaborators injected, not from facades', function (): void {
    expect('App\Support')->not->toUse('Illuminate\Support\Facades');
});
