swagger:
	docker-compose run php ./vendor/bin/openapi -o swagger.yml --format yaml ./src/Infrastructure

behat:
	docker-compose run php sh -c "APP_ENV=test ./vendor/bin/behat -f progress --strict"

migrations:
	docker-compose run php bin/console d:m:m -n

fixtures: migrations
	docker-compose run php bin/console d:f:l --no-interaction