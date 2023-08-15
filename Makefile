init: install-app

install-app:
	docker-compose run --rm php composer install --prefer-dist

run-app:
	docker-compose run --rm php php public/index.php

run-test:
	docker-compose run --rm php php vendor/bin/phpunit
