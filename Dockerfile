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
    && docker-php-ext-install -j$(nproc) pdo_pgsql \
# RUN apt-get update && apt-get install -y \
#         libfreetype6-dev \
#         libjpeg62-turbo-dev \
#         libmcrypt-dev \
#         libpng-dev \
#         libicu-dev \
#         libpq-dev \
#         libxpm-dev \
#         libvpx-dev \
#     && docker-php-ext-install -j$(nproc) mcrypt \
#     && docker-php-ext-install -j$(nproc) gd \
#     && docker-php-ext-install -j$(nproc) intl \
#     && docker-php-ext-install -j$(nproc) zip \
#     && docker-php-ext-install -j$(nproc) pgsql \
#     && docker-php-ext-install -j$(nproc) pdo_pgsql \
#     && docker-php-ext-install -j$(nproc) exif \
#     && docker-php-ext-configure gd \
#         --with-freetype-dir=/usr/include/ \
#         --with-jpeg-dir=/usr/include/ \
#         --with-xpm-dir=/usr/lib/x86_64-linux-gnu/ \
#         --with-vpx-dir=/usr/lib/x86_64-linux-gnu/ \