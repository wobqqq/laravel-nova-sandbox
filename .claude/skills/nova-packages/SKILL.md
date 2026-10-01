---
name: nova-packages
description: >-
  Use whenever a Nova package is installed, removed, wired up or tried out in
  this sandbox: make package.require / package.remove / packages.aegis, the
  `local` path repository in composer.json, a tool, card, resource or gate a
  package asks the application to register (NovaServiceProvider,
  App\Nova\Dashboards\Main, AppServiceProvider), its migrations, or a package
  that does not install (version constraints, the Nova registry, auth.json).
---

# Installing and trying a Nova package

## Where packages come from

- The parent folder is mounted at `/var/www/portfolio`, this project at
  `/var/www/portfolio/laravel-nova-sandbox`, so `../package` means the same inside the
  container and on the host.
- `composer.json` has the `local` path repository over `../*` with
  `symlink: true`: the package's working copy is linked into `vendor/`, and an
  edit to it is live without reinstalling.
- `laravel/nova` comes from `nova.laravel.com` with the credentials in
  `auth.json`. It stays at 5.9.3, the last version the license allows.

## Install

1. `make package.require PACKAGE=vendor/name` (requires `vendor/name:*@dev`
   and migrates).
2. Do what the package's README asks of the application, here:
   - a tool: `NovaServiceProvider::tools()`;
   - a card: `App\Nova\Dashboards\Main::cards()`;
   - a gate: `AppServiceProvider::boot()`, against `$user->is_admin`;
   - config: `php artisan vendor:publish --tag=...` only when needed.
3. Sign in at http://localhost:8081/nova as `admin@example.com` / `password`
   and try it. `php artisan route:list --path=nova-vendor` shows its routes.
4. `make test` still passes: the sandbox's own tests must not break because a
   package is installed.

## When it does not install

- `requires laravel/framework ^12.0`: the package does not allow Laravel 13
  yet. Widen the constraint in the package (`^12.0 || ^13.0`), not here.
- `requires laravel/nova ^5.x` above 5.9.3: the package needs a Nova release
  outside the license.
- HTTP 402 from `nova.laravel.com`: a Nova version newer than 5.9.3 was asked
  for.
- A package found twice: the root package and a sibling share a name; rename
  the sibling or require it explicitly with its version.

## Clean up

`make package.remove PACKAGE=vendor/name`, undo the wiring, then
`git checkout composer.json composer.lock && make install` so the committed
lock file stays the clean sandbox. Roll back the package's migrations first
if it has any (`php artisan migrate:rollback`), or `make fresh`.
