# Tutorial 3 Starter

This project runs directly on macOS with PHP, Composer, and the Laravel installer provided by Laravel's native `php.new` setup.

## Install the dependencies

From this directory, run:

```bash
composer install
npm install
```

If `.env` does not exist yet, create it and generate the application key:

```bash
cp .env.example .env
php artisan key:generate
```

The local setup uses MySQL 8.4. Start the Homebrew service and run the migrations:

```bash
brew services start mysql@8.4
php artisan migrate
```

## DBeaver connection

Create a MySQL connection in DBeaver with these values:

- Host: `127.0.0.1`
- Port: `3306`
- Database: `tutorial3`
- Username: `laravel`
- Password: `laravel`

This account has access only to the `tutorial3` database. It is intended for local development.

## Run the project

Start Laravel and Vite together:

```bash
composer run dev
```

Open <http://localhost:8000> in your browser.

Run the test suite with:

```bash
php artisan test
```
