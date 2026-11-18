FROM node:22-bookworm-slim AS node
FROM composer:2 AS composer
FROM ubuntu:24.04

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update \
    && apt-get install -y --no-install-recommends software-properties-common \
    && add-apt-repository -y ppa:ondrej/php \
    && apt-get update \
    && apt-get install -y --no-install-recommends \
        ca-certificates \
        curl \
        git \
        openssh-server \
        php8.5-bcmath \
        php8.5-cli \
        php8.5-curl \
        php8.5-intl \
        php8.5-mbstring \
        php8.5-mysql \
        php8.5-sqlite3 \
        php8.5-xml \
        php8.5-zip \
        sudo \
        unzip \
    && apt-get purge -y software-properties-common \
    && apt-get autoremove -y \
    && rm -rf /var/lib/apt/lists/*

COPY --from=node /usr/local/ /usr/local/
COPY --from=composer /usr/bin/composer /usr/local/bin/composer

RUN useradd --create-home --shell /bin/bash laravel \
    && echo 'laravel:laravel' | chpasswd \
    && usermod -aG sudo laravel \
    && printf 'laravel ALL=(ALL) NOPASSWD:ALL\n' > /etc/sudoers.d/laravel \
    && chmod 0440 /etc/sudoers.d/laravel \
    && mkdir -p /run/sshd \
    && printf 'PasswordAuthentication yes\nPermitRootLogin no\n' > /etc/ssh/sshd_config.d/laravel.conf

WORKDIR /var/www/html

COPY docker/entrypoint.sh /usr/local/bin/container-entrypoint
RUN chmod +x /usr/local/bin/container-entrypoint

EXPOSE 22 8000 5173

ENTRYPOINT ["container-entrypoint"]
