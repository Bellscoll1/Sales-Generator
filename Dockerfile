FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libpng-dev libicu-dev libonig-dev \
    && docker-php-ext-install pdo pdo_mysql intl zip \
    && pecl install redis \
    && docker-php-ext-enable redis

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html

COPY . .
RUN composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader || true

CMD ["php-fpm"]
