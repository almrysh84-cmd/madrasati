#!/bin/bash
set -e

# Copy .env.example to .env if .env doesn't exist
if [ ! -f .env ]; then
    cp .env.example .env
fi

# Run migrations
echo "Running migrations..."
php artisan migrate --force

# Seed database
echo "Seeding database..."
php artisan db:seed --force 2>/dev/null || true

# Generate app key if not set
php artisan key:generate --force 2>/dev/null || true

# Cache config
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start Apache
exec apache2-foreground