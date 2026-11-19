# Advanced Full Stack Development

Laravel coursework is grouped by type. The `main` branch is the complete collection.

```text
Adv_Fullstack/
├── Tutorials/
│   ├── Tutorial-1/
│   ├── Tutorial2/
│   └── Tutorial3-Starter/
└── Workshops/
    ├── Workshop1/
    └── Workshop2/
```

## Production deployments

- [Workshop 1](https://workshop-1-production.up.railway.app)
- [Workshop 2](https://workshop-2-production.up.railway.app)

Both applications run on Railway's Free plan. They use one MySQL service with isolated table prefixes: `w1_` for Workshop 1 and `w2_` for Workshop 2. Free services sleep when idle, so the first request can take a few seconds.

## Local setup

This Mac uses native PHP, Composer and MySQL. DBeaver is the database client. Confirm the commands are available before starting:

```bash
php --version
composer --version
brew services list
```

If MySQL is stopped, run:

```bash
brew services start mysql@8.4
```

## Create a project

Run the creator from the repository root. The project name determines its folder:

```bash
./laravel-create.sh Workshop3 --blade
./laravel-create.sh Tutorial4 --blade
```

These commands create `Workshops/Workshop3` and `Tutorials/Tutorial4`. The script also works when called from another directory because it resolves the repository root from its own location.

Available choices are `--blade`, `--vite`, `--react`, `--vue`, `--svelte` and `--livewire`. Leave the choice out to use the interactive menu.

Start a project with:

```bash
cd Workshops/Workshop3
php artisan serve
```

For a project that uses frontend assets, run `npm install` once and use `npm run dev` in another terminal.

## MySQL and DBeaver

Use a separate database for each project. A typical Laravel `.env` configuration on this Mac is:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=workshop3
DB_USERNAME=laravel
DB_PASSWORD=laravel
```

Create the database before migrating, then run:

```bash
php artisan migrate
```

In DBeaver, create a MySQL connection using host `localhost`, port `3306`, username `laravel`, password `laravel`, and the database name from that project's `.env` file. `.env` files are local and must not be committed.

## Git workflow

`main` keeps every completed tutorial and workshop. Use one branch for the work on each new workshop:

```bash
git switch main
git pull --ff-only
git switch -c Workshop3
./laravel-create.sh Workshop3 --blade
git add Workshops/Workshop3
git commit -m "Complete Workshop 3"
git switch main
git merge --no-ff Workshop3
```

The branch inherits the existing collection from `main`, but its changes stay limited to its own workshop folder. After merging, `main` contains the new workshop as well as all earlier work. Follow the same pattern with branches such as `Tutorial4` and paths such as `Tutorials/Tutorial4`.

The existing `Workshop1` and `Workshop2` branches are retained as isolated workshop snapshots. Do not force-push rewritten branch history unless you intentionally want to replace the corresponding remote branch.
