#!/bin/bash
set -e

# NIHSA Laravel Application Entry Point Script
# This script handles container initialization and startup

echo "🚀 Starting NIHSA Laravel Application..."

# Function to wait for service
wait_for_service() {
    local service=$1
    local host=$2
    local port=$3
    local max_attempts=${4:-30}
    local attempt=1

    echo "⏳ Waiting for $service at $host:$port..."
    until nc -z $host $port || [ $attempt -eq $max_attempts ]; do
        echo "$service is unavailable - sleeping (attempt $attempt/$max_attempts)"
        sleep 2
        attempt=$((attempt + 1))
    done

    if [ $attempt -eq $max_attempts ]; then
        echo "❌ $service did not become available in time"
        exit 1
    fi

    echo "✅ $service is ready!"
}

# Wait for database if DATABASE_URL is not set (using external DB)
if [ -z "$DATABASE_URL" ] && [ "$DB_HOST" != "localhost" ]; then
    wait_for_service "PostgreSQL" "$DB_HOST" "${DB_PORT:-5432}" 60
fi

# Wait for Redis if configured
if [ "$REDIS_HOST" != "127.0.0.1" ] && [ "$REDIS_HOST" != "localhost" ]; then
    wait_for_service "Redis" "$REDIS_HOST" "${REDIS_PORT:-6379}" 30
fi

# Create necessary directories
echo "📁 Creating directories..."
mkdir -p storage/logs
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/app/public
mkdir -p bootstrap/cache
mkdir -p public/build

# Set proper permissions
echo "🔐 Setting permissions..."
chown -R appuser:appuser /var/www
chmod -R 755 storage bootstrap/cache public/build

# Generate application key if not set
if [ -z "$APP_KEY" ] || [ "$APP_KEY" == "base64:C5Bgg+ldaEFOdpXCHnF2Pkk1TPx/VH4J+Uzl8KtB9FE=" ]; then
    echo "🔑 Generating application key..."
    php artisan key:generate --force
else
    echo "🔑 Using existing application key"
fi

# Clear and cache configuration
echo "⚡ Optimizing application..."
php artisan config:cache --force
php artisan route:cache --force
php artisan view:cache --force

# Clear and warm caches
php artisan cache:clear --force
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Run database migrations
echo "🗄️ Running database migrations..."
php artisan migrate --force --no-interaction

# Seed database if in development and not already seeded
if [ "$APP_ENV" == "local" ] && [ ! -f "database/.seeded" ]; then
    echo "🌱 Seeding database..."
    php artisan db:seed --force --no-interaction
    touch database/.seeded
fi

# Install Laravel Horizon for queue management (if not already installed)
if [ "$APP_ENV" != "local" ]; then
    echo "📊 Setting up Laravel Horizon..."
    php artisan horizon:install --force || true
    php artisan horizon:publish --force || true
fi

# Create storage link for public files
echo "🔗 Creating storage link..."
php artisan storage:link --force

# Optimize composer autoloader
echo "🎼 Optimizing Composer autoloader..."
composer dump-autoload --optimize --classmap-authoritative --no-dev --no-interaction

# Set file permissions for uploaded files
chmod -R 775 storage/app/public
chown -R www-data:www-data storage/app/public

# Health check endpoint creation
echo "🏥 Setting up health check..."
echo "healthy" > /var/www/public/health

# Display environment information
echo "ℹ️ Environment Information:"
echo "  - APP_ENV: $APP_ENV"
echo "  - APP_DEBUG: $APP_DEBUG"
echo "  - DB_CONNECTION: $DB_CONNECTION"
echo "  - CACHE_DRIVER: $CACHE_DRIVER"
echo "  - SESSION_DRIVER: $SESSION_DRIVER"

echo "✅ Application initialization complete!"

# Start services with supervisor
echo "🚀 Starting services with Supervisor..."
exec /usr/bin/supervisord -c /etc/supervisord.conf