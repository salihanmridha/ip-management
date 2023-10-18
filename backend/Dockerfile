FROM php:8.1-fpm-alpine

RUN set -ex \
    && apk --no-cache add mysql-dev nodejs npm\
    && docker-php-ext-install pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

# Copy .env.example to .env
RUN cp .env.example .env

# Install PHP dependencies
RUN composer install

# Generate application key
RUN php artisan key:generate

# Run database migrations and seed data
RUN php artisan migrate --seed
