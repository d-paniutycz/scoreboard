FROM php:8.2-fpm-alpine3.18 AS php

COPY --from=composer:2.6 /usr/bin/composer /usr/local/bin/composer
