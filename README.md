# Nova Sandbox

A clean Laravel Nova application for installing and testing Nova packages. It has no domain code of its own: a user resource, a dashboard, a Blade home page and error pages, so whatever a package adds is easy to see and nothing else gets in its way.

| | Version |
|---|---|
| PHP | 8.5 |
| Laravel | 13 |
| Nova | 5.9.3 |
| MySQL | 8.4 |
| Redis | 8 |

Nova is pinned to 5.9.3, the latest release the license covers.

## Requirements

- Docker with Compose
- `make`
- A Nova license in `auth.json` (copy `auth.example.json` and fill in the e-mail and license key). `auth.json` is ignored by git.

## Quick start

```bash
cp auth.example.json auth.json   # then put the Nova credentials in it
make setup
```

`make setup` starts the containers, creates `.env`, installs the dependencies, generates the key, runs the migrations and seeds an administrator.

| | |
|---|---|
| Home page | http://localhost:8081 |
| Nova | http://localhost:8081/nova (`admin@example.com` / `password`) |
| Mailpit | http://localhost:8026 |
| MySQL | `127.0.0.1:33061`, user `root`, password `secret`, databases `sandbox` and `sandbox_test` |
| Redis | `127.0.0.1:63791` |

Change the ports in `.env` (`APP_PORT`, `DB_FORWARD_PORT`, `REDIS_FORWARD_PORT`, `MAILPIT_UI_PORT`, `MAILPIT_SMTP_PORT`).

## Installing a local package

The containers mount the parent folder at `/var/www/portfolio`, with this project at `/var/www/portfolio/laravel-nova-sandbox`, so the relative paths are the same inside Docker and on the host. `composer.json` has a path repository over every sibling folder (`../*`), symlinked, so a package's working copy is installed as it is and every change to it shows up at once.

```bash
make package.require PACKAGE=vendor/package   # composer require vendor/package:*@dev, then migrate
make package.remove PACKAGE=vendor/package
make packages.local                           # what is installed from the sibling folders
```

The home page lists the packages installed from local folders too.

For the Aegis suite (`nova-aegis` and its five modules next to this folder):

```bash
make packages.aegis          # the core and all five modules
make packages.aegis.remove
```

Then register what the package asks for in its README: a tool in `NovaServiceProvider::tools()`, a card in `App\Nova\Dashboards\Main`, a gate in `AppServiceProvider`.

A package is installable only if its `composer.json` allows Laravel 13 (`laravel/framework` or `illuminate/*` `^13.0`).

To try a package without changing the committed `composer.json` and `composer.lock`, restore them afterwards with `git checkout composer.json composer.lock && make install`.

## Checks

```bash
make code.fix        # composer normalize, Rector, php-cs-fixer
make code.check      # composer validate and audit, php-cs-fixer, Rector, PHPStan (max)
make test            # Pest
make test.coverage   # Pest with coverage, at least 90 %
make test.stub       # what CI runs: a copy on the Nova test double, without the license
make ready           # all of the above
```

The tests run against the `sandbox_test` MySQL database inside the PHP container.

## Continuous integration

GitHub Actions run the static checks and the tests on every pull request and on `main`, with a MySQL service and no Nova license: `bin/use-nova-stub` swaps Nova for the test double in `stubs/nova` (Nova's public signatures, no Nova code) and the tests that need the real Nova, tagged `nova`, are left out. Locally everything runs on the real Nova; `make test.stub` reproduces the CI run. An audit workflow checks the locked dependencies when run by hand from the Actions tab, and a `vX.Y.Z` tag on `main` with a matching CHANGELOG entry publishes a GitHub release once CI passes.

## Other commands

```bash
make help            # every target
make shell           # a shell in the PHP container
make fresh           # recreate the database and seed the administrator
make docker.rebuild  # rebuild the PHP image
make docker.down
```

## Access

Locally Nova lets every signed-in user in. In any other environment only users with the administrator flag pass the `viewNova` gate.

## License

[MIT](LICENSE)
