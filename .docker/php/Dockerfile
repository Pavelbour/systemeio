FROM php:8.3.4-alpine3.18
COPY --from=composer/composer:2.7.2-bin /composer /usr/bin/composer

RUN apk update && apk add --no-cache git zip bash libpq-dev icu-dev
RUN docker-php-ext-install pdo_pgsql intl
RUN docker-php-ext-enable intl

ARG USER_ID=1000
RUN adduser -u ${USER_ID} -D -H app
USER app
CMD ["php", "-S", "0.0.0.0:8337", "-t", "public"]
