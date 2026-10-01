.DEFAULT_GOAL := help

PHP := docker compose exec -T php-fpm
AEGIS := wobqqq/nova-aegis wobqqq/nova-aegis-admin-ip-access wobqqq/nova-aegis-ip-blocker \
	wobqqq/nova-aegis-smart-ip-blocker wobqqq/nova-aegis-csp wobqqq/nova-aegis-input-sanitizer

.PHONY: help docker.up docker.down docker.rebuild shell install setup migrate fresh \
	code.fix code.check test test.coverage test.stub stub.generate ready \
	package.require package.remove packages.aegis packages.aegis.remove packages.local

help: ## Show the available targets
	@awk 'BEGIN {FS = ":.*## "} /^[a-zA-Z0-9_.-]+:.*## / {printf "  \033[36m%-22s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

docker.up: ## Start the containers
	docker compose up -d

docker.down: ## Stop the containers
	docker compose down

docker.rebuild: ## Rebuild the PHP image and restart
	docker compose build --pull php-fpm
	docker compose up -d --force-recreate

shell: ## Open a shell in the PHP container
	docker compose exec php-fpm sh

install: ## Install the composer dependencies
	$(PHP) composer install

setup: docker.up ## First run: .env, dependencies, key, database, admin user
	@test -f .env || cp .env.example .env
	@test -f auth.json || { echo "auth.json with the Nova license is missing (see auth.example.json)"; exit 1; }
	$(PHP) composer install
	@grep -q '^APP_KEY=.' .env || $(PHP) php artisan key:generate --ansi
	$(PHP) php artisan storage:link --quiet
	$(PHP) php artisan migrate --seed --force

migrate: ## Run the migrations
	$(PHP) php artisan migrate

fresh: ## Recreate the database and seed the admin user
	$(PHP) php artisan migrate:fresh --seed

code.fix: ## Normalize composer.json, apply Rector and php-cs-fixer
	$(PHP) composer code.fix

code.check: ## Validate, audit, lint and analyse
	$(PHP) composer code.check

test: ## Run the test suite
	$(PHP) composer test

test.coverage: ## Run the test suite with coverage (minimum 90 %)
	$(PHP) composer test.coverage

stub.generate: ## Rebuild stubs/nova from the installed Nova: signatures of every Nova class the code uses
	rm -rf stubs/nova/src
	$(PHP) php bin/nova-stub/generate.php . stubs/nova bin/nova-stub/overrides.php $(shell git grep -h -oE 'Laravel\\Nova\\[A-Za-z\\]+' -- app config routes database bootstrap tests | sort -u | sed "s/.*/'&'/")

test.stub: ## Run the checks and tests as CI does: on a copy, with the Nova test double and no license
	docker compose run --rm -T php-fpm sh -c '\
		rm -rf /tmp/stub && mkdir -p /tmp/stub/laravel-nova-sandbox && \
		tar -C /var/www/portfolio/laravel-nova-sandbox --exclude=./vendor --exclude=./node_modules --exclude=./auth.json --exclude=./.env --exclude='./bootstrap/cache/*.php' -cf - . | tar -C /tmp/stub/laravel-nova-sandbox -xf - && \
		cd /tmp/stub/laravel-nova-sandbox && COMPOSER_AUTH= bin/use-nova-stub && \
		cp .env.example .env && php artisan key:generate --ansi && \
		composer code.check && composer test.stub.coverage'

ready: ## Everything before a commit: fix, check, coverage
	$(PHP) composer ready

package.require: ## Install a package from a sibling folder: make package.require PACKAGE=vendor/name
	@test -n "$(PACKAGE)" || { echo "Usage: make package.require PACKAGE=vendor/name"; exit 1; }
	$(PHP) composer require "$(PACKAGE):*@dev" --no-interaction
	$(PHP) php artisan migrate --force

package.remove: ## Remove a package: make package.remove PACKAGE=vendor/name
	@test -n "$(PACKAGE)" || { echo "Usage: make package.remove PACKAGE=vendor/name"; exit 1; }
	$(PHP) composer remove "$(PACKAGE)" --no-interaction

packages.aegis: ## Install the Aegis core and its five modules from the sibling folders
	$(PHP) composer require $(foreach p,$(AEGIS),"$(p):*@dev") --no-interaction
	$(PHP) php artisan migrate --force

packages.aegis.remove: ## Remove Aegis and its modules
	$(PHP) composer remove $(AEGIS) --no-interaction

packages.local: ## List the packages installed from the sibling folders
	$(PHP) composer show --path | grep -v '/vendor/' || true
