FROM php:8.1.2-apache

RUN docker-php-ext-install \
    pdo_mysql \
    && a2enmod \
    rewrite