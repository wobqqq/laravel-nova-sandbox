FROM composer:2 AS composer

FROM node:24-alpine AS node

FROM php:8.5-fpm-alpine

RUN apk add --no-cache \
        freetype-dev \
        git \
        icu-dev \
        jpeg-dev \
        libpng-dev \
        libwebp-dev \
        libzip-dev \
        linux-headers \
        oniguruma-dev \
        unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install bcmath gd intl pcntl pdo_mysql zip \
    && apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
    && pecl install redis pcov \
    && docker-php-ext-enable redis pcov \
    && pecl clear-cache \
    && apk del .build-deps \
    && rm -rf /tmp/* /var/cache/apk/*

COPY docker/php-fpm/php.ini /usr/local/etc/php/conf.d/zz-sandbox.ini

ARG UID=1000
ARG GID=1000

RUN deluser --remove-home www-data \
    && addgroup -g $GID www-data \
    && adduser -S -G www-data -u $UID www-data

COPY --from=node /usr/local /usr/local
COPY --from=composer /usr/bin/composer /usr/local/bin/composer

USER www-data

WORKDIR /var/www/portfolio/laravel-nova-sandbox

CMD ["php-fpm"]
