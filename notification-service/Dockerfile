# Dockerfile
FROM laravelsail/php83-composer:latest

WORKDIR /var/www/html

COPY . .

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo_mysql zip

RUN composer install

EXPOSE 80

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]
