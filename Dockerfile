# Sử dụng PHP 8.2 với Apache
FROM php:8.2-apache

# Cài đặt các extension PHP cần thiết
RUN apt-get update && apt-get install -y libzip-dev unzip && docker-php-ext-install zip pdo pdo_mysql

# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set thư mục làm việc
WORKDIR /var/www/html

# Copy toàn bộ code vào container
COPY . .

# Cấp quyền cho storage và bootstrap/cache
RUN chmod -R 777 storage bootstrap/cache

# Cài đặt các package PHP
RUN composer install --no-dev --optimize-autoloader

# Chạy lệnh cache config để tối ưu hiệu suất
RUN php artisan config:cache

# Expose port 80 để truy cập từ bên ngoài
EXPOSE 80

# Lệnh chạy khi container khởi động
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]
