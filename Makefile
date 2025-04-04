# Variables
COMPOSE_FILE := docker-compose.yml
CONTAINER_PHP := php
CONTAINER_MYSQL := mysql
# Comandos
build:
	docker compose build --no-cache php

up:
	docker compose up -d

down:
	docker compose down

exec:
	docker compose exec $(CONTAINER_PHP) bash

logs:
	docker compose logs -f $(CONTAINER_PHP)

restart:
	docker compose restart $(CONTAINER_PHP)

clean: down
	docker system prune -a --volumes --force

composer:
	docker-compose exec $(CONTAINER_PHP) bash -c "composer install"

doctrine:
	docker-compose exec $(CONTAINER_PHP) bash -c "composer require doctrine/orm doctrine/migrations"

init: build up composer doctrine