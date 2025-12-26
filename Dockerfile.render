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
# Stage 2 - Backend (Laravel + PHP 8.3)
# =========================
FROM php:8.3-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
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

# Copy backend application files
COPY . .

# ✅ Copy built Vite assets (FIXED)
COPY --from=frontend /app/public/build ./public/build

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Create SQLite database
RUN mkdir -p database \
    && touch database/database.sqlite

# Permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache database

# Laravel optimizations
RUN php artisan key:generate || true && \
    php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear

ENV PORT=8080

EXPOSE 8080


CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]

