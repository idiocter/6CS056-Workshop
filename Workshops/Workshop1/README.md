# Workshop 1

A Laravel 13 Blade application for managing students and courses.

## Production

[Open Workshop 1](https://workshop-1-production.up.railway.app)

The Railway deployment uses MySQL and the `w1_` table prefix. The Free plan sleeps when idle, so the first request can take a few seconds.

## Local setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

Open [http://localhost:8000](http://localhost:8000).

## Checks

```bash
php artisan test --compact
./vendor/bin/pint
```
