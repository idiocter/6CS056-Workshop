#!/bin/sh

set -eu

mkdir -p /run/sshd
ssh-keygen -A

if [ -f /var/www/html/artisan ] && [ -f /var/www/html/vendor/autoload.php ]; then
    cd /var/www/html
    php artisan migrate --force || printf '%s\n' 'Warning: database migration failed; Laravel will still be started.' >&2
    php artisan serve --host=0.0.0.0 --port=8000 &
fi

exec /usr/sbin/sshd -D -e
