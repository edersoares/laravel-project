FROM php:cli

MAINTAINER Eder Soares

RUN apt-get update -y

RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo_mysql

RUN pecl install redis
RUN docker-php-ext-enable redis
RUN rm -rf /tmp/pear

RUN docker-php-ext-install pcntl

COPY php.ini /usr/local/etc/php/php.ini
