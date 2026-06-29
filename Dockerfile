FROM php:8.3-fpm-alpine

# Instalar dependencias del sistema
RUN apk add --no-cache \
    git \
    unzip \
    curl \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev

# Instalar extensiones de PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install -j$(nproc) \
    pdo_mysql \
    zip \
    gd \
    opcache

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos de composer primero (mejor para caché)
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --optimize-autoloader

# Copiar el resto de la aplicación
COPY . .

# Configurar permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Comandos de inicio
CMD ["sh", "-c", "php artisan config:cache && php artisan route:cache && php artisan view:cache && php-fpm"]