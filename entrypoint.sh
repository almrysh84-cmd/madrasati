#!/bin/bash

# Fix Apache MPM conflict
a2dismod mpm_event 2>/dev/null || true
a2enmod mpm_prefork rewrite 2>/dev/null || true

# Configure Apache port from Railway env
export PORT=${PORT:-8080}
sed -i "s/Listen .*/Listen ${PORT}/" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:.*>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf 2>/dev/null || true

# Check vendor directory
if [ ! -d "/app/vendor" ]; then
    echo "ERROR: /app/vendor not found. Starting Apache anyway..."
    exec apache2-foreground
fi

# Map Railway auto-injected MYSQL_* variables to Laravel DB_* variables
# Railway injects: MYSQLHOST, MYSQLPORT, MYSQLUSER, MYSQLPASSWORD, MYSQLDATABASE
if [ -n "$MYSQLHOST" ]; then
    export DB_HOST="$MYSQLHOST"
    export DB_PORT="${MYSQLPORT:-3306}"
    export DB_DATABASE="${MYSQLDATABASE:-railway}"
    export DB_USERNAME="${MYSQLUSER:-root}"
    export DB_PASSWORD="$MYSQLPASSWORD"
    export DB_CONNECTION=mysql
    echo "Mapped Railway MySQL vars -> DB_* variables"
fi

# Generate APP_KEY if not set
if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "SomeRandomString" ] || [ "$APP_KEY" = "" ]; then
    echo "Generating APP_KEY..."
    php artisan key:generate --force --ansi 2>/dev/null || echo "WARNING: key:generate failed"
fi

# Run migrations if MySQL is configured
if [ "$DB_CONNECTION" = "mysql" ] && [ -n "$DB_HOST" ]; then
    echo "Waiting for MySQL to be ready..."
    MAX_RETRIES=30
    RETRY=0
    while [ $RETRY -lt $MAX_RETRIES ]; do
        if php artisan migrate:status > /dev/null 2>&1; then
            echo "MySQL is ready!"
            break
        fi
        RETRY=$((RETRY+1))
        echo "Waiting for MySQL... ($RETRY/$MAX_RETRIES)"
        sleep 3
    done

    if [ $RETRY -lt $MAX_RETRIES ]; then
        echo "Running migrations..."
        php artisan migrate --force 2>&1
        echo "Migrations done!"

        # Seed demo data only on first boot (when the users table is empty),
        # so redeploys/restarts never wipe or duplicate existing data.
        USER_COUNT=$(php artisan tinker --execute="echo \App\Models\User::count();" 2>/dev/null | tail -n 1)
        if [ "$USER_COUNT" = "0" ]; then
            echo "No users found, running database seeders..."
            php artisan db:seed --force 2>&1
            echo "Seeding done!"
        else
            echo "Users already exist ($USER_COUNT), skipping seeders."
        fi
    else
        echo "WARNING: MySQL not available, skipping migrations"
    fi
fi

# Cache configuration
echo "Caching configuration..."
php artisan config:clear 2>/dev/null || true
php artisan config:cache 2>/dev/null || true
php artisan view:cache 2>/dev/null || true

echo "Starting Apache on port ${PORT}..."
exec apache2-foreground