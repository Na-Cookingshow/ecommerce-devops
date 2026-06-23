FROM php:8.4

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . .

RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-scripts

RUN php artisan config:clear || true

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000