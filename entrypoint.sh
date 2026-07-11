#!/bin/bash
set -e

# Copy .env.example to .env if .env doesn't exist
if [ ! -f /var/www/html/.env ]; then
    cp /var/www/html/.env.example /var/www/html/.env
fi

# Map Railway's auto-injected MYSQL_* variables to Laravel's DB_* variables
if [ -n "$MYSQLHOST" ]; then
    export DB_HOST="$MYSQLHOST"
    export DB_PORT="${MYSQLPORT:-3306}"
    export DB_DATABASE="${MYSQLDATABASE:-railway}"
    export DB_USERNAME="${MYSQLUSER:-root}"
    export DB_PASSWORD="$MYSQLPASSWORD"

    sed -i "s|DB_HOST=.*|DB_HOST=$DB_HOST|" /var/www/html/.env
    sed -i "s|DB_PORT=.*|DB_PORT=$DB_PORT|" /var/www/html/.env
    sed -i "s|DB_DATABASE=.*|DB_DATABASE=$DB_DATABASE|" /var/www/html/.env
    sed -i "s|DB_USERNAME=.*|DB_USERNAME=$DB_USERNAME|" /var/www/html/.env
    sed -i "s|DB_PASSWORD=.*|DB_PASSWORD=$DB_PASSWORD|" /var/www/html/.env
    echo "DB configured: $DB_HOST:$DB_PORT/$DB_DATABASE"
fi

# Set APP_URL from Railway
if [ -n "$RAILWAY_PUBLIC_DOMAIN" ]; then
    sed -i "s|APP_URL=.*|APP_URL=https://$RAILWAY_PUBLIC_DOMAIN|" /var/www/html/.env
fi

# Generate APP_KEY if missing
if ! grep -q "APP_KEY=base64:" /var/www/html/.env; then
    php artisan key:generate --force
fi

# Export APP_KEY
APP_KEY_VAL=$(grep '^APP_KEY=' /var/www/html/.env | cut -d= -f2)
if [ -n "$APP_KEY_VAL" ]; then
    export APP_KEY="$APP_KEY_VAL"
fi

# Wait for MySQL
DB_HOST_VAL="${DB_HOST:-$(grep DB_HOST /var/www/html/.env | cut -d= -f2)}"
DB_PORT_VAL="${DB_PORT:-3306}"
if [ -n "$DB_HOST_VAL" ] && [ "$DB_HOST_VAL" != "127.0.0.1" ]; then
    MAX_RETRIES=30
    RETRY=0
    while [ $RETRY -lt $MAX_RETRIES ]; do
        if php -r "
            \$c = @fsockopen('$DB_HOST_VAL', $DB_PORT_VAL, \$e, \$s, 5);
            if (\$c) { fclose(\$c); exit(0); }
            exit(1);
        " 2>/dev/null; then
            echo "MySQL is ready!"
            break
        fi
        echo "Waiting for MySQL... ($((RETRY+1))/$MAX_RETRIES)"
        sleep 3
        RETRY=$((RETRY+1))
    done
    if [ $RETRY -ge $MAX_RETRIES ]; then
        echo "ERROR: MySQL not available after $MAX_RETRIES attempts"
        exit 1
    fi
fi

# Run migrations
echo "Running database migrations..."
php artisan migrate:fresh --force

echo "Seeding database..."
php artisan db:seed --force

# Cache for production
php artisan config:cache
php artisan view:cache
php artisan route:cache

# Ensure writable permissions
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Fix MPM conflict - ensure only prefork is loaded
rm -f /etc/apache2/mods-enabled/mpm_event.load /etc/apache2/mods-enabled/mpm_event.conf
rm -f /etc/apache2/mods-enabled/mpm_worker.load /etc/apache2/mods-enabled/mpm_worker.conf
if [ ! -f /etc/apache2/mods-enabled/mpm_prefork.load ]; then
    ln -s /etc/apache2/mods-available/mpm_prefork.load /etc/apache2/mods-enabled/mpm_prefork.load
fi
if [ ! -f /etc/apache2/mods-enabled/mpm_prefork.conf ]; then
    ln -s /etc/apache2/mods-available/mpm_prefork.conf /etc/apache2/mods-enabled/mpm_prefork.conf
fi

# Check for any LoadModule mpm directives in apache2.conf and remove duplicates
echo "Listing all MPM load files:"
find /etc/apache2 -name "mpm_*" -type l 2>/dev/null
echo "---"
echo "Checking apache2.conf for MPM LoadModule:"
grep -n "mpm" /etc/apache2/apache2.conf 2>/dev/null || echo "No mpm in apache2.conf"

echo "Starting Apache on port 8080..."
exec apache2-foreground