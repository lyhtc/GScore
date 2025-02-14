# Sử dụng PHP 8.1 với Apache
FROM php:8.1-apache

# Cài đặt các extensions cần thiết
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev zip unzip git curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql mysqli

# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Chuyển đến thư mục của ứng dụng
WORKDIR /var/www/html

# Sao chép toàn bộ project vào container
COPY . .

# Cấp quyền cho storage
RUN chmod -R 777 storage bootstrap/cache

# Chạy lệnh khởi tạo
RUN composer install --no-dev --optimize-autoloader

# Mở cổng 80
EXPOSE 80

# Lệnh chạy ứng dụng
CMD ["apache2-foreground"]
