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

1. Prerequisities

- Clone project and enter to folder:
```
git clone https://github.com/themey99/shop-manager.git && cd shop-manager
```
2. Install dependencies:
```
composer install
```
3. Copy or Create .env:
```
cp .env.example .env
```
3. Set your database config and **[PlacetoPay](https://placetopay.github.io/web-checkout-api-docs)** Login and TranKey
4. Install frontend dependencies:
```
npm install or yarn
```
5. Compile frontend:
```
npm run dev or yarn run dev
```
6. Running seeds:
```
php artisan db:seed
```
7. Start server:
```
php artisan serve
```

### With Sail or Docker

1. Prerequisities

- Install docker in your workstation
- Clone project and enter to folder:
```
git clone https://github.com/themey99/shop-manager.git && cd shop-manager
```
2. Install dependencies:
```
docker run --rm -u "$(id -u):$(id -g)" -v $(pwd):/var/www/html -w /var/www/html laravelsail/php80-composer:latest composer install --ignore-platform-reqs
```

If you are using [sail](https://laravel.com/docs/8.x/sail), only follow these steps:

3. Build image:
```
sail build
```
4. Start containers:
```
sail up -d
```
5. Compile frontend:
```
sail yarn run dev
```
6. Running seeders:
```
sail artisan db:seed
```

But if you are only using [docker](https://docs.docker.com/get-started/), follow these steps:

3. Set environment:
```
export WWWUSER="your $WWWUSER or $UID"
export WWWGROUP="your $WWWGROUP or $(id -g)"
```
4. Start containers:
```
docker-compose up -d
```
5. Compile frontend:
```
docker-compose exec -u sail shopmanager.api yarn run dev
```
6. Running seeders:
```
docker-compose exec -u sail shopmanager.api artisan db:seed
```

## Running tests

1. Prerequisities

- Install [sqlite](https://www.sqlite.org/download.html)
- Enter to root project folder

If you aren't using [docker](https://docs.docker.com/get-started/) or [sail](https://laravel.com/docs/8.x/sail), follow these steps:

2. Eject tests:
```
php artisan test # (--filter is optional to filter by some tests)
```

If you are using [sail](https://laravel.com/docs/8.x/sail), follow these steps:

2. Start containers:
```
sail up -d
```
3. Eject tests:
```
sail test # (--filter is optional to filter by some tests)
```

But, if you are using [docker](https://docs.docker.com/get-started/), follow these steps:

2. Set environment:
```
export WWWUSER="your $WWWUSER or $UID"
export WWWGROUP="your $WWWGROUP or $(id -g)"
```
3. Start containers:
```
docker-compose up -d
```
4. Eject tests:
```
docker-compose exec -u sail shopmanager.api php artisan test # (--filter is optional to filter by some tests)
```