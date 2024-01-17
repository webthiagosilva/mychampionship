bash:
	docker exec -it mychampionship-backend bash

bash-root:
	docker exec -it -u root mychampionship-backend bash

test:
	docker exec -it mychampionship-backend bash -c "vendor/bin/phpunit"

test-filter:
	docker exec -it mychampionship-backend bash -c "vendor/bin/phpunit --filter $(filter)"
