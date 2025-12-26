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
# Stage 2 - Backend + Nginx
# =========================
FROM php:8.3-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    curl \
    unzip \
    zip \
    sqlite3 \
    libsqlite3-dev \
    libzip-dev \
    libonig-dev \
    && docker-php-ext-install \
        pdo \
        pdo_sqlite \
        mbstring \
        zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy backend files
COPY . .

# Copy built Vite assets
COPY --from=frontend /app/public/build ./public/build

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Create SQLite database
RUN mkdir -p database \
    && touch database/database.sqlite

# Permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache database public/build

# Laravel optimizations
RUN php artisan key:generate || true && \
    php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear

# Remove default nginx config
RUN rm /etc/nginx/sites-enabled/default

# Copy custom nginx config
COPY nginx/default.conf /etc/nginx/conf.d/default.conf

# Expose Render port
ENV PORT=10000
EXPOSE $PORT

# Replace listen port in Nginx dynamically (Render sets $PORT)
RUN sed -i "s/listen 80;/listen $PORT;/" /etc/nginx/conf.d/default.conf

# Start PHP-FPM + Nginx
CMD sh -c "php artisan migrate --force && [ ! -f database/.seeded ] && php artisan db:seed --force && touch database/.seeded; php-fpm -D && nginx -g 'daemon off;'"
