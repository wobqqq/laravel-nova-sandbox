---
name: pest-testing
description: >-
  Use whenever you write, run or change tests: anything under tests/, Pest
  files, tests/Pest.php, phpunit.xml, factories in database/factories, or a
  request for tests or coverage.
---

# Tests

- Pest 5 on PHPUnit 13. `make test` runs the suite inside the `php-fpm`
  container, `make test.coverage` fails below 90 % (pcov).
- Feature tests use `RefreshDatabase` on the `sandbox_test` MySQL database
  (created by `docker/mysql/create-test-database.sql`); unit tests touch no
  database.
- Use the functions of `Pest\Laravel` (`get`, `post`, `actingAs`, `seed`,
  `assertAuthenticatedAs`) instead of `$this->...`: PHPStan at max cannot type
  `$this` inside a Pest closure. Shared values go in a function, not on `$this`.
- Architecture rules (`tests/Unit/ArchTest.php`) use the closure form,
  `arch('...', function (): void { expect(...)->... })`, for the same reason.
- `User::factory()->admin()` makes an administrator; the default user is not
  one. Nova's gate only applies outside `local`, and tests run as `testing`.
- Error pages are tested through throwaway routes registered in the test
  (`Route::get('/_test/...')`); `APP_DEBUG` is false in `phpunit.xml`, so the
  real error views render.
- Name tests after the behaviour: `it('keeps a user who is not an administrator out of Nova')`.
