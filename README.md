<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Shop manager

Simple store where a customer can buy and manage the payment of their orders through **[PlacetoPay](https://placetopay.github.io/web-checkout-api-docs)**

## Steps to install

### Without Sail or Docker

- git clone https://github.com/themey99/shop-manager.git
- cd shop-manager
- composer install
- cp .env.example .env
- set your database config and **[PlacetoPay](https://placetopay.github.io/web-checkout-api-docs)** login and 
- npm install or yarn
- npm run dev or yarn run dev
- php artisan serve

### With Sail or Docker

- git clone https://github.com/themey99/shop-manager.git
- cd shop-manager
- docker run --rm -u "$(id -u):$(id -g)" -v $(pwd):/var/www/html -w /var/www/html laravelsail/php80-composer:latest composer install --ignore-platform-reqs

If you are using [sail](https://laravel.com/docs/8.x/sail), only follow these steps:

- sail build
- sail up -d
- sail yarn run dev

But if you are only using [docker](https://docs.docker.com/get-started/), follow these steps:

- export WWWUSER="your $WWWUSER or $UID"
- export WWWGROUP="your $WWWGROUP or $(id -g)"
- docker-compose up -d
- docker-compose exec -u sail shopmanager.api yarn run dev

## Running tests

This project require [sqlite](https://www.sqlite.org/download.html) to run tests.

- cd shop-manager

If you aren't using [docker](https://docs.docker.com/get-started/) or [sail](https://laravel.com/docs/8.x/sail), follow these steps:

- php artisan test (--filter is optional to filter by some tests)

If you are using [sail](https://laravel.com/docs/8.x/sail), follow these steps:

- sail up -d
- sail test (--filter is optional to filter by some tests)

But, if you are using [docker](https://docs.docker.com/get-started/), follow these steps:

- export WWWUSER="your $WWWUSER or $UID"
- export WWWGROUP="your $WWWGROUP or $(id -g)"
- docker-compose up -d
- docker-compose exec -u sail shopmanager.api php artisan test (--filter is optional to filter by some tests)