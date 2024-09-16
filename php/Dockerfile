FROM php:8.0-fpm as app

RUN apt-get update && apt-get upgrade -y

RUN apt-get -y install git

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN set -eux; \
    install-php-extensions pdo pdo_mysql gd;

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www/html

FROM app as app_dev

ENV XDEBUG_MODE=off

COPY ./php/conf.d/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

RUN set -eux; \
    install-php-extensions xdebug;