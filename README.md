# Laravel-learning
## Getting started

git clone https://git.artjoker.ua/php-group/laravel-learning.git

## Start Docker

docker-compose up --build

## To enter Docker Container

docker-compose exec web bash

## In container
## To db connect

php artisan key:generate

In .env file change APP_KEY parameter to new key
Create db and change config for db

## do migrations
php artisan migrate 

## install npm
npm install && npm run dev
