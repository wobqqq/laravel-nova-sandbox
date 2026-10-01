<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

use function Pest\Laravel\get;

beforeEach(function (): void {
    Route::get('/_test/abort/{code}', fn (int $code) => abort($code))->whereNumber('code');
    Route::get('/_test/fail', fn () => throw new RuntimeException('Broken'));
});

it('renders its own page for each error', function (int $code, string $title): void {
    get("/_test/abort/{$code}")
        ->assertStatus($code)
        ->assertSee("Error {$code}")
        ->assertSee($title)
        ->assertSee('Back to home');
})->with([
    [401, 'Unauthorized'],
    [402, 'Payment required'],
    [403, 'Forbidden'],
    [404, 'Page not found'],
    [419, 'Page expired'],
    [429, 'Too many requests'],
    [500, 'Server error'],
    [503, 'Service unavailable'],
]);

it('falls back to the generic page of the error class', function (int $code, string $title): void {
    get("/_test/abort/{$code}")
        ->assertStatus($code)
        ->assertSee("Error {$code}")
        ->assertSee($title);
})->with([
    [405, 'Request error'],
    [422, 'Request error'],
    [502, 'Server error'],
]);

it('renders a missing page with the 404 view', function (): void {
    get('/this-page-does-not-exist')
        ->assertNotFound()
        ->assertSee('Page not found');
});

it('hides the exception of an unexpected error', function (): void {
    get('/_test/fail')
        ->assertInternalServerError()
        ->assertSee('Server error')
        ->assertDontSee('Broken');
});
