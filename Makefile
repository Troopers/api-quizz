DOCKER_COMPOSE = docker-compose

EXEC_PHP       = $(DOCKER_COMPOSE) exec -T php /entrypoint

SYMFONY        = $(EXEC_PHP) bin/console
COMPOSER       = $(EXEC_PHP) composer
QA             = docker run --rm -v `pwd`:/project -w /project jakzal/phpqa:1.62-php7.4-alpine

##
## File dependencies
## -----------------
##

composer.lock: composer.json ## Update Composer dependencies and lockfile
	$(COMPOSER) update

vendor: composer.lock ## Install Composer dependencies
	$(COMPOSER) install

##
## Project
## -------
##

install: start vendor database ## Install everything except Docker things

reset: kill clean install ## Reset everything (alias of 'install')

clean: stop ## Remove dependencies and built resources
	rm -Rf vendor
	rm -Rf var/cache/*

##
## Docker
## ------
##

build:
	$(DOCKER_COMPOSE) pull --quiet --ignore-pull-failures
	$(DOCKER_COMPOSE) build --pull

kill:
	$(DOCKER_COMPOSE) kill
	$(DOCKER_COMPOSE) down --volumes --remove-orphans

start: ## Start the project
	$(DOCKER_COMPOSE) up -d --remove-orphans --no-recreate

stop: ## Stop the project
	$(DOCKER_COMPOSE) stop

restart: ## Restart the project
	$(DOCKER_COMPOSE) stop
	$(DOCKER_COMPOSE) up -d --remove-orphans --no-recreate

##
## Utils : Database
## -----
##

build-db: ## Build the database
#	@$(EXEC_PHP) php -r 'echo "Wait database...\n"; set_time_limit(15); require __DIR__."/vendor/autoload.php"; (new \Symfony\Component\Dotenv\Dotenv())->load(__DIR__."/.env"); $$u = parse_url(getenv("DATABASE_URL")); for(;;) { if(@fsockopen($$u["host"].":".($$u["port"] ?? 3306))) { break; }}'
	$(SYMFONY) doctrine:database:drop --if-exists --force
	$(SYMFONY) doctrine:database:create --if-not-exists
	$(SYMFONY) doctrine:migrations:migrate --no-interaction

database: build-db load-fixtures ## Build the database and load fixtures and data

generate-db-diff: build-db ## Generate a migration by comparing your current database to your mapping information
	$(SYMFONY) doctrine:migrations:diff

load-fixtures: ## load fixtures
	$(SYMFONY) doctrine:fixtures:load -n

##
## Utils : Misc
## -----
##

cache-clear:
	$(SYMFONY) cache:clear

shell: ## Enter in web container
	$(DOCKER_COMPOSE) exec php gosu foo sh

##
## Tests
## -----
##

#add behat once done
test: php-cs-fixer phpstan ## Run all tests

doctrine-schema-validate: database ## Run doctrine:schema:validate
	$(SYMFONY) doctrine:schema:validate

behat: database behat-keep-db ## Run Behat tests

behat-keep-db: ## Run Behat tests without resetting database
	mkdir -p var/fails
	$(EXEC_PHP) vendor/bin/behat --strict --verbose --colors

behat-single: ## Run a single Behat test file (option: `FILE=path/to/test.feature`)
	$(EXEC_PHP) vendor/bin/behat $(FILE) --strict --verbose --colors

php-cs-fixer: ## Run PHP-CS fixer
	$(QA) ./ci/src/php-cs-fixer

phpstan: vendor ## Run PHPStan
	$(QA) phpstan analyse --level 4 src templates public

# For GitLab's CI

bin/selenium-server-standalone-2.53.0.jar: ## Download Selenium
	wget "https://selenium-release.storage.googleapis.com/2.53/selenium-server-standalone-2.53.0.jar" --output-document="$@" --quiet

.PHONY: install reset clean
.PHONY: build kill start stop restart
.PHONY: build-db database load-fixtures generate-db-diff
.PHONY: test doctrine-schema-validate behat behat-keep-db behat-single php-cs-fixer phpstan

.DEFAULT_GOAL := help
help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
.PHONY: help
