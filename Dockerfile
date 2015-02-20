FROM php:fpm
MAINTAINER Vlad Fratila <vlad.fratila@gmail.com>

RUN php -r "readfile('https://getcomposer.org/installer');" | php && \
    mv composer.phar /usr/local/bin/composer && \
    apt-get update && apt-get install -y zlib1g-dev --no-install-recommends && docker-php-ext-install zip && \
    rm -rf /var/lib/apt/lists/*

