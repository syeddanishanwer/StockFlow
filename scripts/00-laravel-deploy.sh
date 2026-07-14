#!/usr/bin/env bash
echo "Caching configuration assets..."
php artisan config:cache
php artisan route:cache

echo "Executing cloud database migrations..."
php artisan migrate --force

echo "Starting the web server processes..."
# Start PHP-FPM in the background
php-fpm -D

# Start Nginx in the foreground to keep the container running
nginx -g "daemon off;"