FROM php:7.2.12-fpm

RUN apt-get update && apt-get install -y libmcrypt-dev mysql-client libpq-dev netcat \
    && docker-php-ext-install pdo pdo_pgsql pdo_mysql

WORKDIR /var/www