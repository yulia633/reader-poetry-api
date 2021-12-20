up:
	docker-compose up -d --build

down:
	docker-compose down

compose-bash:
	docker-compose run --rm application bash


compose-bash-mysql:
	docker exec -it api-test-container bash


compose-install:
	docker-compose run --rm application make install

ci:
	docker-compose build
	docker-compose -f docker-compose.yml -p api-test-container-ci run --rm application make install
	docker-compose -f docker-compose.yml -p api-test-container-ci up


install:
	composer install


validate:
	composer validate


start:
	php -S 0.0.0.0:8888


lint:
	composer exec phpcs -v -- --standard=PSR12 public src -np


env-prepare:
	cp -n .env.example .env || true
