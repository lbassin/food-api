swagger:
	docker-compose run php ./vendor/bin/openapi -o swagger.yml --format yaml ./src/Infrastructure

behat:
	docker-compose run php ./vendor/bin/behat -f progress -v

migrations:
	docker-compose run php bin/console d:m:m -n

fixtures: migrations
	docker-compose run php bin/console d:f:l --no-interaction