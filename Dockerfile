# 1. Imagen base PHP con FPM
FROM php:8.2-fpm

# 2. Instalar utilidades y extensiones necesarias
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl \
    libpng-dev libonig-dev libxml2-dev \
    nodejs npm \
    && docker-php-ext-install pdo pdo_mysql mbstring zip

# 3. Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 4. Establecer directorio de trabajo
WORKDIR /var/www/html

# 5. Copiar archivos del proyecto
COPY . .

# 6. Instalar dependencias PHP
RUN composer install --no-dev --optimize-autoloader

# 7. Instalar dependencias JS y compilar Vite
RUN npm install && npm run build

# 8. Permisos para Laravel
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# 9. Exponer el puerto del servidor
EXPOSE 8080

# 10. Comando de inicio para Render
CMD php artisan migrate --force && \
    php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear && \
    php artisan serve --host=0.0.0.0 --port=$PORT
