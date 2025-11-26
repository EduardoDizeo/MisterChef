# Imagen base PHP con FPM
FROM php:8.2-fpm

# Instalar dependencias del sistema necesarias para Laravel
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl \
    libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Crear directorio de la app
WORKDIR /var/www/html

# Copiar archivos de composer primero para cachear dependencias
COPY composer.json composer.lock ./

# Instalar dependencias PHP
RUN composer install --no-dev --optimize-autoloader

# Copiar el resto de la aplicación
COPY . .

# Permisos necesarios
RUN chown -R www-data:www-data storage bootstrap/cache

# Exponer puerto
EXPOSE 8080

# Comando por defecto
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
