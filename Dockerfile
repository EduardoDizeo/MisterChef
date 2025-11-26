# 1. Imagen base PHP con FPM
FROM php:8.2-fpm

# 2. Instalar extensiones PHP necesarias y utilidades
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl \
    libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip

# 3. Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 4. Establecer directorio de trabajo
WORKDIR /var/www/html

# 5. Copiar archivos de Composer primero (para cachear dependencias)
COPY composer.json composer.lock ./

# 6. Instalar dependencias sin ejecutar scripts aún
RUN composer install --no-dev --optimize-autoloader --no-scripts

# 7. Copiar todo el proyecto
COPY . .

# 8. Ejecutar scripts de Composer que requieren artisan
RUN php artisan package:discover --ansi

# 9. Dar permisos a storage y cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 10. Exponer puerto del servidor (Render asigna $PORT automáticamente)
EXPOSE 8080

# 11. Comando de inicio
CMD php artisan migrate --force && \
    php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear && \
    php artisan serve --host=0.0.0.0 --port=$PORT
