# Changelog

All notable changes are documented here. The format follows [Keep a Changelog](https://keepachangelog.com/en/1.1.0/).

## [Unreleased]

## [1.0.0] - 2026-10-01

### Added

- Laravel 13 application with Nova 5.9.3 on PHP 8.5, in Docker: nginx, PHP-FPM, MySQL 8.4, Redis and Mailpit.
- A Blade home page with the PHP, Laravel and Nova versions and the packages installed from local folders.
- Blade error pages for 401, 402, 403, 404, 419, 429, 500 and 503, with generic 4xx and 5xx fallbacks.
- An administrator flag on users behind the `viewNova` gate, and a seeded `admin@example.com` account.
- A path repository over the sibling folders and `make package.require` / `make packages.aegis` to install local Nova packages.
- The quality gate: PHPStan at max with Larastan and the strict rules, Rector, php-cs-fixer, composer normalize and audit, Pest with a 90 % coverage minimum.
- GitHub Actions: checks and tests (with the license secrets), a weekly audit and tagged releases.

[Unreleased]: https://github.com/wobqqq/laravel-nova-sandbox/compare/v1.0.0...HEAD
[1.0.0]: https://github.com/wobqqq/laravel-nova-sandbox/releases/tag/v1.0.0
