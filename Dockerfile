# =========================
# Stage 1 - Build Frontend (Vite)
# =========================
FROM node:18 AS frontend
WORKDIR /app

COPY package*.json ./
RUN npm install

COPY . .
RUN npm run build


# =========================
# Stage 2 - Backend (Laravel + PHP)
# =========================
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl unzip libonig-dev libzip-dev zip sqlite3 \
    && docker-php-ext-install \
        pdo \
        pdo_sqlite \
        mbstring \
        zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy application files
COPY . .

# Copy built frontend assets
COPY --from=frontend /app/public/dist ./public/dist

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Create SQLite database
RUN mkdir -p database \
    && touch database/database.sqlite

# Set permissions (important for Laravel)
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache database

# Laravel optimizations
RUN php artisan key:generate || true && \
    php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear

EXPOSE 9000

CMD ["php-fpm"]
