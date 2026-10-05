# Advanced Full Stack Development

This folder contains separate Laravel workshop projects. Everything runs with Docker, so you do not need XAMPP, a local PHP installation, or MySQL Workbench.

## 1. Install the required applications

Install:

- Docker Desktop
- Visual Studio Code
- DBeaver Community

On this Mac, DBeaver was installed with:

```bash
brew install --cask dbeaver-community
```

Open it with:

```bash
open -a DBeaver
```

Check Docker before creating a project:

```bash
docker --version
docker compose version
```

Docker Desktop must be running.

## 2. Create a Laravel project

Go to this main folder:

```bash
cd ~/Documents/Herald_Sem_5/Adv_Fullstack
```

Create a Blade-only project using one exact folder name:

```bash
./laravel-create Workshop2 --blade
```

Available frontend choices:

```text
--blade
--vite
--react
--vue
--svelte
--livewire
```

Examples:

```bash
./laravel-create Workshop2 --vite
./laravel-create Workshop3 --react
./laravel-create Workshop4 --vue
```

You can also omit the frontend option and select it interactively:

```bash
./laravel-create Workshop2
```

The option is explicit for every project:

- `--blade` uses Blade views and does not start the Vite development server.
- `--vite` uses the standard Laravel project and starts Vite for CSS and JavaScript assets.
- `--react`, `--vue`, and `--svelte` install that frontend starter kit and run it through Vite.
- `--livewire` installs the Livewire starter kit and starts its asset tooling.

Blade is Laravel's server-rendered template system. Vite is an asset development server, so they are not technically competing frameworks; a Laravel project can use Blade templates and Vite assets together. These flags let you explicitly decide whether Vite should run for that workshop.

Do not write `Workshop1/2`; that means a nested path. Use `Workshop1` or `Workshop2`.

The creator uses a temporary lightweight Composer container to download Laravel. It then adds the Docker configuration to the new project. It does not install PHP, Composer, Node, or MySQL directly on your Mac.

## 3. Start the project

```bash
cd Workshop2
docker compose up -d --build
```

The word `up` is required. `docker compose -d --build` is not a valid command.

The first start builds the Ubuntu development image. Later, normally use:

```bash
docker compose up -d
```

The container automatically starts Laravel. It starts Vite only when the project was created with `--vite`, `--react`, `--vue`, `--svelte`, or `--livewire`. MySQL and Mailpit also start automatically.

## 4. Open the services

| Service | Address |
| --- | --- |
| Laravel | http://localhost:8000 |
| Vite, when selected | http://localhost:5173 |
| Mailpit | http://localhost:8025 |
| MySQL | localhost:3306 |
| SSH | localhost:2222 |

Only one workshop can use these default ports at a time. Stop the current workshop before starting another one.

## 5. Daily commands

Run these inside the workshop folder:

```bash
docker compose up -d
docker compose ps
docker compose logs -f app
docker compose down
```

After changing the Dockerfile:

```bash
docker compose up -d --build
```

Run Laravel commands:

```bash
docker compose exec app php artisan migrate
docker compose exec app php artisan make:controller ExampleController
docker compose exec app php artisan test
```

Open a shell in the app container:

```bash
docker compose exec app bash
```

## 6. SSH into the Ubuntu container

```bash
ssh -p 2222 developer@localhost
```

Password:

```text
developer
```

The Laravel code is mounted at:

```text
/var/www/html
```

Editing files in the container or on your Mac changes the same project files.

## 7. Configure DBeaver

Start the workshop first:

```bash
docker compose up -d
```

In DBeaver:

1. Select **Database > New Database Connection**.
2. Choose **MySQL**.
3. Enter these values:

| Setting | Value |
| --- | --- |
| Host | localhost |
| Port | 3306 |
| Database | laravel |
| Username | laravel |
| Password | password |

4. Select **Test Connection**.
5. Allow DBeaver to download the MySQL driver if prompted.
6. Select **Finish**.

DBeaver connects to the MySQL container through port 3306. You do not need MySQL Workbench.

## 8. Troubleshooting

Check whether the containers are running:

```bash
docker compose ps
```

Check the app logs:

```bash
docker compose logs app
```

If a port is already in use, stop the other workshop:

```bash
cd ~/Documents/Herald_Sem_5/Adv_Fullstack/Workshop1
docker compose down
```

Then return to the workshop you want and start it:

```bash
docker compose up -d
```

For a clean rebuild:

```bash
docker compose down
docker compose up -d --build
```
