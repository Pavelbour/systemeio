FROM php:8.3.4-alpine3.18
COPY --from=composer/composer:2.7.2-bin /composer /usr/bin/composer

RUN apk update && apk add libpq-dev
RUN docker-php-ext-install pdo_pgsql

RUN adduser -D app
USER app
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
