swagger:
	docker-compose run php ./vendor/bin/openapi -o swagger.yml --format yaml ./src/Infrastructure
