# Sử dụng PHP với Apache
FROM php:8.1-apache

# Cài đặt các extension cần thiết
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Cài Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Cài Laravel
WORKDIR /var/www
COPY . .
RUN composer install --no-dev --optimize-autoloader

# Chỉnh quyền thư mục storage và bootstrap/cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Cấu hình Apache
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# Expose cổng
EXPOSE 80

# Chạy server
CMD ["apache2-foreground"]
