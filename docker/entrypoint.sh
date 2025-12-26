#!/bin/bash
set -e

echo "Starting entrypoint script..."

# Ensure storage and cache directories exist and have correct permissions
mkdir -p /var/www/html/storage/framework/cache
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/bootstrap/cache

# Set permissions
chown -R www-data:www-data /var/www/html/storage
chown -R www-data:www-data /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage
chmod -R 775 /var/www/html/bootstrap/cache

# Ensure database directory exists with correct permissions
mkdir -p /var/www/html/database
touch /var/www/html/database/database.sqlite
chmod 666 /var/www/html/database/database.sqlite
chown www-data:www-data /var/www/html/database/database.sqlite

# Clear and cache config
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations
php artisan migrate --force

# Start supervisord
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
