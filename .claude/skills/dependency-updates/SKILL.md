---
name: dependency-updates
description: >-
  Use whenever dependencies move: composer update, a version range changed in
  composer.json, a failing composer audit, the PHP version of the Docker
  image, or the Nova registry credentials.
---

# Updating dependencies

- `docker compose exec php-fpm composer update -W`, then `make ready`.
- `laravel/nova` stays exactly `5.9.3`: the license does not cover newer
  releases and the registry answers 402. `composer validate` runs with
  `--no-check-all` for that reason only.
- Laravel moves to a new major only when Nova 5.9.3 allows it (check
  `vendor/laravel/nova/composer.json`).
- The PHP version is the Docker image's (`docker/php-fpm/Dockerfile`) and the
  `php` constraint in composer.json: change both, then `make docker.rebuild`.
- `composer audit` must be clean; fix an advisory by updating the package.
- Never print or commit `auth.json`.
