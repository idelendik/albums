up:
	XDEBUG_MODE=debug docker compose -f docker-compose.yaml up --build -d
	docker exec -it php-albums sh -c "composer install"

#	docker exec -it php-albums sh -c "composer require pestphp/pest"
#	docker exec -it php-albums sh -c "./vendor/bin/pest --init"

	docker exec php-albums sh -c "composer dump-autoload"

	docker exec node-albums sh -c "npm install webpack webpack-cli --save-dev"

down:
	docker compose -f docker-compose.yaml down

test-php:
	docker exec -it php-albums sh -c "./vendor/bin/phpunit --bootstrap ./vendor/autoload.php tests --colors always"

prod:
	# unfinished
	docker exec php-albums sh -c "composer dump-autoload -o"

watch:
	docker exec node-albums sh -c "npm run watch"

build:
	docker exec node-albums sh -c "npm run build"

test-js:
	docker exec node-albums sh -c "npm run test"

migration-apply:
	docker exec php-albums sh -c "php ./scripts/migration/apply.php"

migration-rollback:
	docker exec php-albums sh -c "php ./scripts/migration/rollback.php"