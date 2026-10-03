# AGENTS.md

Guidance for coding agents working in this repository.

## What this is

A clean Laravel 13 application with Nova 5.9.3 (PHP 8.5, Docker) for installing and testing Nova packages. It holds no domain code: the `User` model with an `is_admin` flag, the Nova `User` resource, the `Main` dashboard, a Blade home page (`resources/views/home.blade.php`) and Blade error pages (`resources/views/errors`). Keep it that way: a package under test is installed from a sibling folder, not copied in.

## The gate (run before every commit)

Everything runs in the `php-fpm` container; the host needs only Docker and `make`.

```bash
make code.fix        # composer normalize, Rector, php-cs-fixer
make code.check      # validate, audit, php-cs-fixer, Rector, PHPStan max
make test            # Pest on the sandbox_test MySQL database
make test.coverage   # fails below 90 %
make test.stub       # CI's run: the Nova test double, no license
make ready           # all of the above
```

PHPStan runs at `level: max` with Larastan and the strict rules and no baseline: fix the type, never add an ignore. `composer audit` findings are fixed by updating, never ignored.

## Installing a package under test

- The parent folder is mounted at `/var/www/portfolio`; the project is `/var/www/portfolio/laravel-nova-sandbox`. The `local` path repository (`../*`, symlinked) offers every sibling folder.
- `make package.require PACKAGE=vendor/name` / `make package.remove PACKAGE=vendor/name`; `make packages.aegis` for the Aegis core and modules.
- Do not commit a package under test into `composer.json` / `composer.lock` unless asked; restore them with `git checkout composer.json composer.lock && make install`.
- Read the `nova-packages` skill.

## Rules

- `declare(strict_types=1);` in every PHP file, PSR-12 through php-cs-fixer.
- Names over comments; a comment only for a non-obvious why, in one line.
- Typing: native types for every parameter, return and property PHP allows; typed class constants; `#[\Override]` on every overriding method; every class `final` (only `App\Nova\Resource` is abstract), value objects `final readonly`. PHPDoc only for what PHP cannot express (`list<Card>`, generics, shapes) or where Laravel forbids a native type (`$title`, `$fillable`). Models carry no `@property` blocks: Larastan reads the columns from the migrations.
- Architecture: the skills `application-layer`, `dependency-injection`, `error-handling`, `validation`, `events`, `testing-architecture`, `domain-layer-cqrs` and `package-boundaries` hold the rules. This app is a thin host for packages under test, so most of them apply when a package is written, not here: controllers stay one call deep and get what they need injected (`LocalPackages` is bound in `AppServiceProvider`).
- PHPStan runs at max on bleeding edge with the strict, deprecation and shipmonk rules, no baseline; the only ignore is Pest's `@internal` expectation API in `tests/`.
- Controllers are final and invokable. Tests use the `Pest\Laravel` functions, not `$this`, so PHPStan can type them.
- Never read or print `.env` or `auth.json` (the Nova license), never commit them.
- Nova stays at 5.9.3: newer releases are outside the license (the registry answers 402).

## Git

- `main` is protected: never push to it and never force-push. Work on a branch (`feat/…`, `fix/…`, `chore/…`, `docs/…`) and open a pull request.
- Code, comments, commit messages and documentation are written in English.
- Commit subjects are imperative and say what the change does.
