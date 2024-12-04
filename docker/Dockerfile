FROM php:7.4-apache

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-install mbstring pdo pdo_mysql mysqli zip

# Cài đặt Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy VirtualHost config (nếu dùng Apache)
COPY vhost.conf /etc/apache2/sites-available/000-default.conf

# Kích hoạt mod_rewrite cho Apache
RUN a2enmod rewrite

# Thiết lập thư mục làm việc
WORKDIR /var/www/html
