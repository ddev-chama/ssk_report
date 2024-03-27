FROM php:7.1-fpm

# Install your extensions
# To connect to MySQL, add mysqli
RUN apt-get update && apt-get install -y \
        libmcrypt-dev \
        libpng-dev \
        libicu-dev \
        libvpx-dev \
        libpq-dev \
        libxpm-dev \
        libvpx-dev \
    && docker-php-ext-install -j$(nproc) pgsql \
    && docker-php-ext-install -j$(nproc) pdo_pgsql 