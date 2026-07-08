#!/bin/sh
set -e

# Fix SQLite database file permissions at runtime (in case the container remounts)
echo "Setting up database permissions..."
touch /var/www/html/database/database.sqlite
chown www-data:www-data /var/www/html/database/database.sqlite
chmod 664 /var/www/html/database/database.sqlite
chown -R www-data:www-data /var/www/html/database
chmod -R 775 /var/www/html/database

# Fix storage and bootstrap/cache permissions
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

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
