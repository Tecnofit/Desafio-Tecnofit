FROM php:7.4-fpm-alpine

RUN apk add --no-cache --virtual .deps \
    autoconf \
    make \
    g++

RUN apk add --no-cache \
    openssl-dev \
    libzip-dev

RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    zip
    
RUN pecl install mongodb-1.6.1
RUN docker-php-ext-enable mongodb

RUN apk del .deps

ADD docker/php-fpm/confs/php-ini-overrides.ini /usr/local/etc/php/conf.d/99-overrides.ini