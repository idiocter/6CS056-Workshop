#!/bin/sh

set -eu

mkdir -p /run/sshd
ssh-keygen -A

if [ -f /var/www/html/artisan ] && [ -f /var/www/html/vendor/autoload.php ]; then
    cd /var/www/html
    php artisan migrate --force || printf '%s\n' 'Warning: database migration failed; Laravel will still be started.' >&2
    php artisan serve --host=0.0.0.0 --port=8000 &
fi

frontend_mode=$(cat /var/www/html/.laravel-frontend 2>/dev/null || printf '%s' 'vite')

if [ "$frontend_mode" != "blade" ] && [ -f /var/www/html/package.json ]; then
    (
        cd /var/www/html
        npm install --no-audit --no-fund
        npm run dev -- --host=0.0.0.0
    ) &
fi

exec /usr/sbin/sshd -D -e
