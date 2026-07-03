FROM php:8.3-fpm-alpine

# Instalar dependencias del sistema
RUN apk add --no-cache \
    git \
    unzip \
    curl \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    pdo_mysql \
    zip \
    gd \
    opcache

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer directorio de trabajo
WORKDIR /var/www/html

# ✅ CORREGIDO: Copiar composer.json (composer.lock es opcional)
COPY composer.json ./
# Si tienes composer.lock, descomenta la siguiente línea
# COPY composer.lock ./

# ✅ CORREGIDO: Instalar dependencias
RUN composer install --no-dev --no-interaction --optimize-autoloader --no-scripts

# Copiar el resto de la aplicación
COPY . .

# ✅ CORREGIDO: Ejecutar scripts de composer
RUN composer run-script post-autoload-dump || true

# Configurar permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Comandos de inicio
CMD ["sh", "-c", "php artisan config:cache && php artisan route:cache && php artisan view:cache && php-fpm -F"]