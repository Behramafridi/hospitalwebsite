#!/bin/sh
set -e

# ---------------------------------------------------------------
# Force file-based drivers so SQLite readonly errors never occur
# These override whatever SESSION_DRIVER/CACHE_STORE is set in env
# ---------------------------------------------------------------
export SESSION_DRIVER=file
export CACHE_STORE=file
export QUEUE_CONNECTION=sync

# Fix SQLite database file permissions at runtime
echo "Setting up database permissions..."
mkdir -p /var/www/html/database
touch /var/www/html/database/database.sqlite
chmod 777 /var/www/html/database
chmod 666 /var/www/html/database/database.sqlite

# Fix storage and bootstrap/cache permissions
chmod -R 777 /var/www/html/storage
chmod -R 777 /var/www/html/bootstrap/cache

# Fix sessions/views/framework directories
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/framework/cache
chmod -R 777 /var/www/html/storage/framework

# Clear cached config first (important: must run before config:cache)
echo "Clearing old caches..."
php artisan config:clear || true
php artisan cache:clear || true

# Run standard optimization/caching commands at runtime
echo "Caching Laravel configuration, routes, and views..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run database migrations and seeders automatically on deploy
echo "Running database migrations..."
php artisan migrate --force || echo "Database migrations failed! Please check your database connection variables."
echo "Running database seeders..."
php artisan db:seed --force || echo "Database seeding failed!"

# Run the default container command (apache2-foreground)
echo "Starting Apache..."
exec apache2-foreground
