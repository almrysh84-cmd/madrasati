#!/bin/bash
set -e

echo "=== Madrasati Start Script ==="

# Fix Apache MPM conflict - disable event, keep only prefork
echo "Fixing Apache MPM..."
a2dismod mpm_event 2>/dev/null || true
a2enmod mpm_prefork 2>/dev/null || true
a2enmod rewrite headers 2>/dev/null || true

# Create .env from .env.example
cd /app
if [ ! -f .env ]; then
    cp .env.example .env
    echo "Created .env from .env.example"
fi

# Configure DB from Railway env vars
if [ -n "$MYSQLHOST" ]; then
    sed -i "s|DB_HOST=.*|DB_HOST=$MYSQLHOST|" .env
    sed -i "s|DB_PORT=.*|DB_PORT=${MYSQLPORT:-3306}|" .env
    sed -i "s|DB_DATABASE=.*|DB_DATABASE=${MYSQLDATABASE:-railway}|" .env
    sed -i "s|DB_USERNAME=.*|DB_USERNAME=${MYSQLUSER:-root}|" .env
    sed -i "s|DB_PASSWORD=.*|DB_PASSWORD=$MYSQLPASSWORD|" .env
    echo "DB configured: $MYSQLHOST:${MYSQLPORT:-3306}/${MYSQLDATABASE:-railway}"
fi

# Set APP_URL
if [ -n "$RAILWAY_PUBLIC_DOMAIN" ]; then
    sed -i "s|APP_URL=.*|APP_URL=https://$RAILWAY_PUBLIC_DOMAIN|" .env
fi

# Generate APP_KEY
if ! grep -q 'APP_KEY=base64:' .env 2>/dev/null; then
    php artisan key:generate --force --ansi 2>/dev/null || echo "WARN: key:generate failed"
fi

# Wait for MySQL
if [ -n "$MYSQLHOST" ]; then
    echo "Waiting for MySQL at $MYSQLHOST:${MYSQLPORT:-3306}..."
    for i in $(seq 1 30); do
        if php -r "
            \$c = @fsockopen(getenv('MYSQLHOST'), intval(getenv('MYSQLPORT') ?: 3306), \$e, \$s, 5);
            if (\$c) { fclose(\$c); exit(0); }
            exit(1);
        " 2>/dev/null; then
            echo "MySQL is ready!"
            break
        fi
        echo "  Waiting... ($i/30)"
        sleep 3
    done
fi

# Run migrations and seed
echo "Running migrate:fresh..."
php artisan migrate:fresh --force --no-interaction 2>&1

echo "Running db:seed..."
php artisan db:seed --force 2>&1

# Cache (skip route:cache to avoid serialization errors)
echo "Caching config and views..."
php artisan config:cache 2>/dev/null || true
php artisan view:cache 2>/dev/null || true

# Fix permissions
mkdir -p storage/framework/{sessions,views,cache} storage/logs bootstrap/cache
chmod -R 777 storage bootstrap/cache 2>/dev/null || true

echo "Starting Apache on port 8080..."
exec apache2-foreground