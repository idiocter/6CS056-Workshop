# Workshop 2: MVC in Laravel

A Blade-based Training Institute Management System built with Laravel 13. The application provides complete CRUD workflows for students and courses, using resource controllers, route model binding, shared validation rules, Blade layouts, partials, and reusable components.

## Production

[Open Workshop 2](https://workshop-2-production.up.railway.app)

The Railway deployment uses MySQL and the `w2_` table prefix. The Free plan sleeps when idle, so the first request can take a few seconds.

## Run with Docker

Docker Desktop must be running. From this folder:

```bash
docker compose up -d
```

The first clean setup can be built with:

```bash
docker compose up -d --build
```

Open [http://localhost:8000](http://localhost:8000).

| Service | Address |
| --- | --- |
| Laravel | http://localhost:8000 |
| Mailpit | http://localhost:8025 |
| MySQL | localhost:3306 |
| SSH | localhost:2222 |

MySQL uses database `laravel`, username `laravel`, and password `password` by default. These values can be changed through the environment variables in `compose.yaml`.

## Useful commands

```bash
docker compose exec app php artisan route:list --except-vendor
docker compose exec app php artisan migrate
docker compose exec app php artisan test
docker compose exec app ./vendor/bin/pint
docker compose logs -f app
docker compose down
```

The app container runs database migrations when it starts. The project is Blade-only, so no Vite development server is required.
