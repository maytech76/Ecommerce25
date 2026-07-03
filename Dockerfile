FROM php:8.3-fpm-alpine

RUN apk add --no-cache git unzip curl libzip-dev libpng-dev libjpeg-turbo-dev freetype-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) pdo_mysql zip gd opcache

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html

COPY composer.json ./
RUN composer install --no-dev --no-interaction --optimize-autoloader --no-scripts --no-progress

COPY . .

# ✅ Crear carpetas y asignar permisos
RUN mkdir -p storage bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

RUN composer run-script post-autoload-dump || true
RUN php artisan key:generate --force || true

CMD ["sh", "-c", "php artisan config:cache && php artisan route:cache && php artisan view:cache && php-fpm -F"]