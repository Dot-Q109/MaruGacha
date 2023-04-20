FROM php:8-apache

RUN apt-get update \
  && apt-get -y install unzip \
  && pecl install xdebug \
  && docker-php-ext-enable xdebug \
  && docker-php-ext-install pdo_mysql \
  && a2enmod rewrite \
  && a2enmod headers

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY ./docker/app/php.ini /usr/local/etc/php
COPY ./docker/app/000-default.conf /etc/apache2/sites-enabled/000-default.conf
