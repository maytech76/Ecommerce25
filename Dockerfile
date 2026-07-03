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

# Instalar Composer (para usarlo después)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar TODO el código (incluyendo composer.json)
COPY . .

# ✅ Crear carpetas necesarias (incluso si no existen)
RUN mkdir -p storage bootstrap/cache

# ✅ Asignar permisos (con verificación)
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# ✅ NO ejecutamos Composer aquí, lo haremos manualmente después

# Comando de inicio (sin composer)
CMD ["sh", "-c", "php-fpm -F"]