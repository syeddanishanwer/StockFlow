FROM php:8.3-fpm-alpine

# Install system dependencies and PHP extensions for MySQL
RUN apk add --no-cache nginx supervisor bash shadow \
    && docker-php-ext-install pdo pdo_mysql

# Set working directory
WORKDIR /var/www/html

# Copy source code
COPY . .

# Install Composer packages
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Nginx & file permission setup
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80

CMD ["/var/www/html/scripts/00-laravel-deploy.sh"]