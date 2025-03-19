# Usa la imagen oficial de PHP 8.4 con FPM y Nginx
FROM php:8.4-fpm-alpine

# Instala las extensiones de PHP necesarias
RUN apk update && apk add --no-cache \
    nginx \
    supervisor \
    zip \
    unzip \
    git \
    libzip-dev \
    icu-dev \
    g++ \
    autoconf \
    make \
    pcre-dev \
    $PHPIZE_DEPS \
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

RUN pecl install redis \
    && docker-php-ext-enable redis

# Instala extensiones de PHP necesarias
RUN docker-php-ext-install pdo pdo_pgsql pgsql zip exif pcntl bcmath
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd


# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Copia los archivos de la aplicación
COPY . /var/www/html

# Configura Nginx
COPY ./nginx/nginx.conf /etc/nginx/nginx.conf

# Configura Supervisor
COPY ./nginx/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Otorga permisos a los directorios de Laravel
RUN chown -R www-data:www-data \
    /var/www/html/storage \
    /var/www/html/bootstrap/cache

# Expone el puerto 80
EXPOSE 80

# Inicia Supervisor
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]