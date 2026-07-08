#!/bin/sh
set -e

# Run standard optimization/caching commands at runtime so they pick up active environment variables
echo "Caching Laravel configuration, routes, and views..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run database migrations automatically on deploy
echo "Running database migrations..."
php artisan migrate --force || echo "Database migrations failed! Please check your database connection variables."

# Run the default container command (apache2-foreground)
echo "Starting Apache..."
exec apache2-foreground
