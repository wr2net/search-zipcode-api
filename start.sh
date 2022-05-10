#!/bin/sh

DIR="/vendor/"

#Dependencies Install
if [ ! -d "$DIR" ]; then
  docker-compose up --build -d
  docker exec -it zip-api composer install
fi

#Create Environments
docker exec -it zip-api cp .env.example .env

#Laravel Key Generate
docker exec -it zip-api php artisan key:generate

#Create Tables Database
sleep 5
docker exec -it zip-api php artisan migrate:status
sleep 5
docker exec -it zip-api php artisan migrate
sleep 5
docker exec -it zip-api php artisan migrate:status
sleep 5
docker exec -it zip-api php artisan migrate