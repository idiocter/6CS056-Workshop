# Advanced Full Stack — Laravel with Docker

This folder is the home for the module. Each tutorial or workshop should be a **separate Laravel project directly inside this folder**.

## Correct folder structure

```text
Adv_Fullstack/
├── README.md
├── Tutorial-1/       ← Laravel project root
├── Tutorial-2/       ← another Laravel project root
├── Workshop-0/       ← another Laravel project root
└── Coursework/       ← coursework Laravel project root
```

A Laravel project root contains files such as:

```text
artisan
composer.json
compose.yaml
app/
database/
resources/
routes/
vendor/
```

Do not create an empty `Tutorial-1` folder, enter it, and then ask Laravel to create `workshop-00`. That produces an unnecessary nested structure:

```text
Tutorial-1/workshop-00/   ← avoid this
```

The Laravel installer creates the destination folder itself.

## The development system

- Your source code is stored normally on your Mac.
- You edit the source code with VS Code.
- Docker Desktop runs PHP, Composer, Node, the web server, MySQL, and Mailpit.
- Laravel Sail provides simple commands for controlling those Docker containers.
- No XAMPP is required.
- No MySQL Workbench is required.
- You do not need a separate installation of PHP, Composer, Apache, or MySQL on the Mac.

Official references: [Laravel installation](https://laravel.com/framework/docs) and [Laravel Sail](https://laravel.com/framework/docs/sail).

## Before starting

Start Docker Desktop and wait until its engine is running. Check it with:

```bash
docker info
docker compose version
```

If `docker info` cannot connect to the daemon, Docker Desktop is not ready.

## Lightweight project creator

From `Adv_Fullstack`, run the local creator just like `npm create vite@latest`:

```bash
./laravel-create Workshop2
```

It asks whether the project should use Blade, React, Vue, Svelte, or Livewire. To skip the menu, pass the stack directly:

```bash
./laravel-create Workshop2 --react
./laravel-create Workshop3 --livewire
./laravel-create Tutorial-2 --blade
```

The command uses the lightweight Alpine-based `composer:2` image while creating the files. The temporary container is removed automatically. It does not install Sail or pull Sail's Ubuntu runtime.

Like Vite or `create-next-app`, it scaffolds the application and also adds a lightweight Alpine PHP `Dockerfile` and `compose.yaml`. Start the newly created project with:

```bash
cd Workshop2
docker compose up -d --build
docker compose exec app php artisan migrate
```

Use `--build` on the first start or after changing the `Dockerfile`. On normal daily starts, use `docker compose up -d`.

## Create Tutorial 1 correctly — with a frontend selector

Start from the parent folder—not from inside a manually created `Tutorial-1` folder:

```bash
cd ~/Documents/Herald_Sem_5/Adv_Fullstack

docker run --rm -it \
  -u "$(id -u):$(id -g)" \
  -e COMPOSER_HOME=/tmp/composer \
  -v "$PWD:/workspace" \
  -w /workspace \
  laravelsail/php85-composer:latest \
  sh -lc 'composer global require laravel/installer && /tmp/composer/vendor/bin/laravel new Tutorial-1 --database=sqlite'

cd Tutorial-1

docker run --rm -it \
  -u "$(id -u):$(id -g)" \
  -v "$PWD:/var/www/html" \
  -w /var/www/html \
  laravelsail/php85-composer:latest \
  php artisan sail:install --with=mysql,mailpit --no-interaction

./vendor/bin/sail up -d
./vendor/bin/sail npm install
./vendor/bin/sail npm run build
./vendor/bin/sail artisan migrate
```

The Laravel Installer now runs inside a temporary Docker container and displays the frontend selection. Choose **None** for plain Blade, or select React, Vue, Svelte, or Livewire. SQLite is used only while the installer creates the project; `sail:install` then configures MySQL and Mailpit for Docker.

For `Tutorial-2`, `Workshop-0`, or another new project, replace both occurrences of `Tutorial-1` in the workflow. Use letters, numbers, hyphens, or underscores in project names. Do not use spaces, and do not create the destination folder first.

## Choosing Blade, React, or Livewire

`laravel.build` does not show an interactive frontend selector. It is a non-interactive shortcut that creates a standard Laravel application with Sail, so the default result uses Blade views and already includes Vite.

These names are not three competing choices:

| Technology | What it does |
|---|---|
| Blade | Laravel's server-rendered PHP template system; the simplest course-friendly default |
| React | A JavaScript UI library; Laravel's official React starter kit connects it to Laravel through Inertia |
| Livewire | A PHP-first way to build reactive interfaces while staying close to Blade |
| Vite | The frontend development server and asset bundler used with Blade, React, Livewire, Vue, or Svelte |

Therefore, you choose **Blade, React, or Livewire** as the frontend approach. You normally use **Vite with whichever approach you choose**.

### Faster command when you definitely want plain Blade

If you do not need the selector and already know you want plain Blade, the shorter Sail installer is still valid:

```bash
cd ~/Documents/Herald_Sem_5/Adv_Fullstack
curl -s "https://laravel.build/Tutorial-2?with=mysql,mailpit" | bash
```

This creates plain Laravel with Blade, Vite, and Docker/Sail. It does not include prebuilt login and registration pages.

The selector is shown only by the longer Docker command in **Create Tutorial 1 correctly — with a frontend selector**. The short `laravel.build` command will never ask which frontend you want.

Official references: [Laravel starter kits](https://laravel.com/framework/docs/starter-kits) and [Laravel Vite integration](https://laravel.com/framework/docs/vite).

## Your currently installed version

The installation output supplied for the existing project shows:

- Laravel Framework `13.34.0`
- Laravel application skeleton `13.10.1`
- Laravel Sail `1.68.0`
- Sail PHP runtime `8.5`
- MySQL `8.4`

The plain command `laravel -v` will not work because the Laravel installer is not installed on the Mac. That is expected in this Docker-only setup.

From a Laravel project root, check versions through Sail:

```bash
./vendor/bin/sail up -d
./vendor/bin/sail artisan --version
./vendor/bin/sail php --version
./vendor/bin/sail composer show laravel/framework
```

## Verify that you are in the project root

Before using Sail, run:

```bash
pwd
ls
```

The output from `ls` must include `artisan`, `composer.json`, `compose.yaml`, and `vendor`.

You can also check automatically:

```bash
test -f artisan && echo "Laravel project root" || echo "Wrong folder"
```

## Start Laravel

Enter the Laravel project and start its containers:

```bash
cd ~/Documents/Herald_Sem_5/Adv_Fullstack/Tutorial-1
./vendor/bin/sail up -d
```

The first start may take several minutes because Docker builds the development image. Later starts are faster.

Prepare the database:

```bash
./vendor/bin/sail artisan migrate
```

Install and build frontend dependencies:

```bash
./vendor/bin/sail npm install
./vendor/bin/sail npm run build
```

Open:

- Laravel: <http://localhost>
- Mailpit: <http://localhost:8025>

## How your Mac folder is mapped into Docker

Laravel Sail does not keep your source code only inside a Docker image. The project's `compose.yaml` contains this bind mount:

```yaml
volumes:
  - '.:/var/www/html'
```

The `.` means “the Laravel project folder on the Mac.” Docker makes that folder available inside the PHP container at `/var/www/html`.

For a correctly structured `Tutorial-1` project, the mapping is:

```text
Mac:    ~/Documents/Herald_Sem_5/Adv_Fullstack/Tutorial-1
Docker: /var/www/html
```

You edit the Mac files using VS Code. The running container sees each saved change immediately. Stopping or deleting the container does not delete the source files on the Mac.

The installer may build the Sail image without leaving the application containers running. Start them explicitly before checking the mount:

```bash
./vendor/bin/sail up -d
./vendor/bin/sail ps
```

Verify synchronization safely from the Laravel project root:

```bash
echo "mounted from Mac" > storage/mount-check.txt
./vendor/bin/sail exec laravel.test cat /var/www/html/storage/mount-check.txt
rm storage/mount-check.txt
```

The middle command should print:

```text
mounted from Mac
```

To inspect the resolved bind mount directly:

```bash
docker compose config
```

Look under `laravel.test` for a volume whose `source` is your Mac project directory and whose `target` is `/var/www/html`.

The MySQL database is different: its data lives in a Docker-managed volume named `sail-mysql`. That is intentional. Application source code uses the Mac bind mount; database storage uses a Docker volume.

### Current port mappings

| Service | Mac/host port | Container port | Address |
|---|---:|---:|---|
| Laravel web application | `80` | `80` | <http://localhost> |
| Vite development server | `5173` | `5173` | Used by `sail npm run dev` |
| MySQL | `3306` | `3306` | `127.0.0.1:3306` from the Mac |
| Mailpit SMTP | `1025` | `1025` | Used by Laravel for development mail |
| Mailpit dashboard | `8025` | `8025` | <http://localhost:8025> |

Inside Docker, Laravel connects to MySQL using `mysql:3306`, not `localhost:3306`.

### Show the actual running ports in Terminal

From the Laravel project root, show every running service and its published ports:

```bash
./vendor/bin/sail ps
```

Show only the host port currently mapped to Laravel's container port `80`:

```bash
docker compose port laravel.test 80
```

Print a clickable Laravel URL in Terminal:

```bash
HOST_PORT="$(docker compose port laravel.test 80 | head -n 1 | sed 's/.*://')"
echo "Laravel is running at http://localhost:${HOST_PORT}"
```

Start Sail and print that URL in one command sequence:

```bash
./vendor/bin/sail up -d && \
HOST_PORT="$(docker compose port laravel.test 80 | head -n 1 | sed 's/.*://')" && \
echo "Laravel is running at http://localhost:${HOST_PORT}"
```

Inspect the other mappings individually when needed:

```bash
docker compose port laravel.test 5173
docker compose port mysql 3306
docker compose port mailpit 8025
```

These commands read the live Docker configuration, so they remain accurate if `APP_PORT`, `FORWARD_DB_PORT`, or another `.env` port setting changes.

### Current nested project warning

Your existing installation is currently located at:

```text
~/Documents/Herald_Sem_5/Adv_Fullstack/Tutorial-1/workshop-00
```

Therefore, that inner `workshop-00` directory—not the outer `Tutorial-1` directory—is currently mapped to `/var/www/html`. Run Sail and edit Laravel files from the inner directory unless you later flatten the project structure.

## Daily workflow

Start the project:

```bash
cd ~/Documents/Herald_Sem_5/Adv_Fullstack/Tutorial-1
./vendor/bin/sail up -d
```

For live frontend updates, keep this running in a second terminal:

```bash
./vendor/bin/sail npm run dev
```

Stop the project when finished:

```bash
./vendor/bin/sail stop
```

Stopping containers does not delete the project files or database.

## Translating normal Laravel commands to Sail

When a tutorial shows a PHP, Composer, Artisan, or NPM command, run it through Sail:

| Tutorial command | Docker/Sail command |
|---|---|
| `php artisan migrate` | `./vendor/bin/sail artisan migrate` |
| `php artisan make:model Post` | `./vendor/bin/sail artisan make:model Post` |
| `composer install` | `./vendor/bin/sail composer install` |
| `composer require package/name` | `./vendor/bin/sail composer require package/name` |
| `npm install` | `./vendor/bin/sail npm install` |
| `npm run dev` | `./vendor/bin/sail npm run dev` |
| `php --version` | `./vendor/bin/sail php --version` |
| `php artisan test` | `./vendor/bin/sail artisan test` |

## Frequently used commands

```bash
# Container status
./vendor/bin/sail ps

# Laravel version
./vendor/bin/sail artisan --version

# Create Laravel classes
./vendor/bin/sail artisan make:controller StudentController
./vendor/bin/sail artisan make:model Student -m
./vendor/bin/sail artisan make:migration create_students_table

# Database migrations and seeders
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan migrate:status
./vendor/bin/sail artisan db:seed

# Tests
./vendor/bin/sail artisan test

# Clear cached configuration, routes, and views
./vendor/bin/sail artisan optimize:clear

# Open a shell inside the application container
./vendor/bin/sail shell

# View logs
./vendor/bin/sail logs
./vendor/bin/sail logs -f
```

## MySQL without Workbench

Sail configures Laravel to connect to MySQL through Docker. The project `.env` should contain settings similar to:

```dotenv
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
```

Inside Docker, `DB_HOST` must be `mysql`, not `localhost`.

Open the MySQL terminal:

```bash
./vendor/bin/sail mysql
```

Useful SQL commands:

```sql
SHOW DATABASES;
USE laravel;
SHOW TABLES;
DESCRIBE users;
SELECT * FROM users;
EXIT;
```

Laravel also provides database inspection commands:

```bash
./vendor/bin/sail artisan db:show
./vendor/bin/sail artisan db:table users
./vendor/bin/sail artisan migrate:status
```

## Working with multiple tutorials

Run only one Sail project at a time unless you deliberately configure different ports.

Before moving to another tutorial:

```bash
# Run inside the current project
./vendor/bin/sail stop

# Enter the next project
cd ../Tutorial-2
./vendor/bin/sail up -d
```

If Docker reports `port is already allocated`, find the project that is still running:

```bash
docker ps
```

Then enter that project's folder and run `./vendor/bin/sail stop`.

## Stop, remove, or reset containers

```bash
# Stop containers but retain everything
./vendor/bin/sail stop

# Remove containers but retain the database volume
./vendor/bin/sail down

# DANGER: remove containers and permanently erase this project's Docker database
./vendor/bin/sail down -v
```

To intentionally delete all tables and rebuild them from migrations:

```bash
./vendor/bin/sail artisan migrate:fresh --seed
```

Both `down -v` and `migrate:fresh` destroy development database data.

## VS Code

Open the individual Laravel project rather than the entire semester directory:

```bash
cd ~/Documents/Herald_Sem_5/Adv_Fullstack/Tutorial-1
code .
```

Important locations:

```text
app/             Models, controllers, services, and application classes
database/        Migrations, factories, and seeders
resources/       Blade views, CSS, and JavaScript
routes/web.php   Browser routes
tests/           Automated tests
.env             Local configuration and secrets; do not commit it
compose.yaml     Docker services used by Sail
```

## Troubleshooting

### `zsh: command not found: laravel`

This is expected. Use Sail from the Laravel project root:

```bash
./vendor/bin/sail artisan --version
```

### `vendor/bin/sail: no such file or directory`

You are probably in the wrong directory. Run `pwd` and `ls`, then enter the folder containing `artisan` and `vendor`.

### Docker is not running

Start Docker Desktop, wait for it to become ready, and check:

```bash
docker info
```

### Site does not load

```bash
./vendor/bin/sail ps
./vendor/bin/sail logs
```

### Database connection error

Make sure MySQL is running and `.env` uses `DB_HOST=mysql`:

```bash
./vendor/bin/sail ps
./vendor/bin/sail artisan optimize:clear
./vendor/bin/sail artisan migrate:status
```

### Frontend changes do not appear

```bash
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```

Keep the development command running while editing frontend files.

## New-project checklist

Replace `PROJECT-NAME` with the exact tutorial or workshop folder name:

```bash
cd ~/Documents/Herald_Sem_5/Adv_Fullstack

docker run --rm -it \
  -u "$(id -u):$(id -g)" \
  -e COMPOSER_HOME=/tmp/composer \
  -v "$PWD:/workspace" \
  -w /workspace \
  laravelsail/php85-composer:latest \
  sh -lc 'composer global require laravel/installer && /tmp/composer/vendor/bin/laravel new PROJECT-NAME --database=sqlite'

cd PROJECT-NAME

docker run --rm -it \
  -u "$(id -u):$(id -g)" \
  -v "$PWD:/var/www/html" \
  -w /var/www/html \
  laravelsail/php85-composer:latest \
  php artisan sail:install --with=mysql,mailpit --no-interaction

./vendor/bin/sail up -d
./vendor/bin/sail artisan --version
./vendor/bin/sail artisan migrate
./vendor/bin/sail npm install
./vendor/bin/sail npm run build
```
# 6CS056-Workshop
