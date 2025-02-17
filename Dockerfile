# Sử dụng PHP 8.2 với Apache
FROM php:8.2.26-bookworm

# Cài đặt các extension PHP cần thiết
RUN apt update
RUN apt install -y libzip-dev unzip zip

ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN install-php-extensions pcntl pdo_pgsql

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
RUN echo "DB_CONNECTION=pgsql" >> .env
RUN echo "DB_HOST=dpg-cuois1bqf0us7392frkg-a" >> .env
RUN echo "DB_PORT=5432" >> .env
RUN echo "DB_DATABASE=gscore_wvjq" >> .env
RUN echo "DB_USERNAME=gscore_wvjq_user" >> .env
RUN echo "DB_PASSWORD=MFf2wTm9fedh6mGjJDXkiGjLgkADSAeP" >> .env
RUN echo "APP_KEY=" >> .env
RUN php artisan key:generate
RUN php artisan config:cache

# Expose port 80 để truy cập từ bên ngoài
EXPOSE 80

# Lệnh chạy khi container khởi động
CMD ["sh", "-c", "php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=80"]
