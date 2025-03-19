# Usa una imagen base de PHP con Apache
FROM php:8.3-apache

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Habilita el módulo de reescritura de Apache
RUN a2enmod rewrite

# Configura Apache para usar /var/www/public como raíz
RUN sed -ri -e 's!/var/www/html!/var/www/public!g' /etc/apache2/sites-available/000-default.conf
RUN sed -ri -e 's!/var/www/!/var/www/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Instala dependencias del sistema
RUN apt-get update && apt-get install -y \
    build-essential \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    git \
    curl \
    ffmpeg \
    libpq-dev \
&& apt-get clean && rm -rf /var/lib/apt/lists/*

# Instala extensiones de PHP necesarias
RUN docker-php-ext-install pdo pdo_pgsql pgsql zip exif pcntl bcmath
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd

# Configura PHP para producción
RUN echo "max_input_vars = 5000" >> /usr/local/etc/php/php.ini
RUN echo "memory_limit = 256M" >> /usr/local/etc/php/php.ini
RUN echo "upload_max_filesize = 64M" >> /usr/local/etc/php/php.ini
RUN echo "post_max_size = 64M" >> /usr/local/etc/php/php.ini

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Copia el código fuente
COPY . .

# Instala dependencias de Composer (sin dependencias de desarrollo)
RUN composer install --optimize-autoloader --no-dev

# Establece permisos
RUN chown -R www-data:www-data /var/www
RUN chmod -R 775 storage bootstrap/cache

# Limpia el caché de Laravel



# Expone el puerto 80 (HTTP)
EXPOSE 80

# Comando para iniciar Apache
CMD ["apache2-foreground"]