#!/usr/bin/env bash
echo "Caching configuration assets..."
php artisan config:cache
php artisan route:cache

echo "Executing cloud database migrations..."
php artisan migrate --force