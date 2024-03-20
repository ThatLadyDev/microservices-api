#!/bin/bash

cp .env.example .env

docker compose build
docker compose up backend -d
docker compose exec -u sail backend bash -c "touch storage/logs/worker.log && composer install && php artisan key:generate && php artisan migrate"
docker compose stop

# Add a 3-second sleep
sleep 3

docker compose restart
