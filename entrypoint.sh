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

# ===== Render-specific env var mapping =====
if [ -n "$RENDER_EXTERNAL_URL" ]; then
    sed -i "s|APP_URL=.*|APP_URL=$RENDER_EXTERNAL_URL|" /var/www/html/.env
    echo "Render APP_URL configured: $RENDER_EXTERNAL_URL"
fi

# APP_KEY: prefer the persistent env var (set in Render dashboard) so sessions
# survive redeploys. Only generate one if neither env var nor .env provides it.
if [ -n "$APP_KEY" ]; then
    sed -i "s|APP_KEY=.*|APP_KEY=$APP_KEY|" /var/www/html/.env
elif ! grep -q "APP_KEY=base64:" /var/www/html/.env; then
    php artisan key:generate --force
fi

# ===== Sync Render env vars into .env (config:cache reads from .env) =====
# Session config — CRITICAL for avoiding 419 errors
if [ -n "$SESSION_DRIVER" ]; then
    sed -i "s|SESSION_DRIVER=.*|SESSION_DRIVER=$SESSION_DRIVER|" /var/www/html/.env
fi
if [ -n "$SESSION_LIFETIME" ]; then
    sed -i "s|SESSION_LIFETIME=.*|SESSION_LIFETIME=$SESSION_LIFETIME|" /var/www/html/.env
fi
if [ -n "$SESSION_SECURE_COOKIE" ]; then
    sed -i "s|SESSION_SECURE_COOKIE=.*|SESSION_SECURE_COOKIE=$SESSION_SECURE_COOKIE|" /var/www/html/.env
fi

# App config
if [ -n "$APP_ENV" ]; then
    sed -i "s|APP_ENV=.*|APP_ENV=$APP_ENV|" /var/www/html/.env
fi
if [ -n "$APP_DEBUG" ]; then
    sed -i "s|APP_DEBUG=.*|APP_DEBUG=$APP_DEBUG|" /var/www/html/.env
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

# ===== DB operations (migrate + seed) — OPT-IN via RUN_MIGRATIONS=true =====
# The DB is already fully migrated + seeded from the prior deploy. Connecting to
# the shared Filess MySQL during a zero-downtime deploy can hang (connection
# contention while the live deploy holds the pool), stalling the deploy forever.
# So we SKIP all DB work by default. Set RUN_MIGRATIONS=true only for a one-time
# fresh-DB setup (new empty database). The flow is idempotent and never uses
# migrate:fresh (which destroys data).
if [ "$RUN_MIGRATIONS" = "true" ]; then
    echo "RUN_MIGRATIONS=true — running DB migrations..."
    # Wait for MySQL (TCP check only)
    DB_HOST_VAL="${DB_HOST:-$(grep DB_HOST /var/www/html/.env | cut -d= -f2)}"
    DB_PORT_VAL="${DB_PORT:-3306}"
    if [ -n "$DB_HOST_VAL" ] && [ "$DB_HOST_VAL" != "127.0.0.1" ]; then
        MAX_RETRIES=30; RETRY=0
        while [ $RETRY -lt $MAX_RETRIES ]; do
            if php -r "\$c=@fsockopen('$DB_HOST_VAL',$DB_PORT_VAL,\$e,\$s,5); if(\$c){fclose(\$c);exit(0);} exit(1);" 2>/dev/null; then
                echo "MySQL is ready!"; break
            fi
            echo "Waiting for MySQL... ($((RETRY+1))/$MAX_RETRIES)"; sleep 3; RETRY=$((RETRY+1))
        done
        if [ $RETRY -ge $MAX_RETRIES ]; then echo "ERROR: MySQL not available"; exit 1; fi
    fi
    # Additive migrate (guarded) — never migrate:fresh
    if ! php artisan migrate --force 2>&1; then
        echo "WARN: migrate returned non-zero — continuing (DB likely already migrated)."
    fi
    # Seed only on a truly empty DB (lightweight PDO check)
    USER_COUNT=$(php -r '
$e=parse_ini_file("/var/www/html/.env");
try {
  $pdo=new PDO("mysql:host=".$e["DB_HOST"].";port=".($e["DB_PORT"]??"3306").";dbname=".$e["DB_DATABASE"].";charset=utf8mb4",
    $e["DB_USERNAME"], $e["DB_PASSWORD"], [PDO::ATTR_TIMEOUT=>8]);
  echo (int)$pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
} catch (\Throwable $ex) { echo "err"; }
' 2>/dev/null || echo "err")
    if [ -z "$USER_COUNT" ] || [ "$USER_COUNT" = "err" ]; then USER_COUNT="unknown"; fi
    if [ "$USER_COUNT" = "0" ]; then
        echo "Database is empty — running initial seeder..."
        if ! php artisan db:seed --force 2>&1; then echo "WARN: db:seed returned non-zero — continuing."; fi
    else
        echo "Database has $USER_COUNT users — skipping seed (data preserved)."
    fi
else
    echo "RUN_MIGRATIONS not set — skipping DB operations (DB already migrated+seeded)."
fi

# Publish PHPFlasher (toastr) assets so notifications work
php artisan flasher:install --no-interaction 2>/dev/null || true

# Clear ALL stale caches from previous deploys
php artisan route:clear 2>/dev/null || true
php artisan config:clear 2>/dev/null || true
php artisan view:clear 2>/dev/null || true
php artisan event:clear 2>/dev/null || true
rm -f /var/www/html/bootstrap/cache/routes*.php /var/www/html/bootstrap/cache/config.php /var/www/html/bootstrap/cache/events.php /var/www/html/bootstrap/cache/packages.php /var/www/html/bootstrap/cache/services.php 2>/dev/null || true

# Cache config (DB-free — just compiles the config array, no connection)
php artisan config:cache 2>&1 || echo "WARNING: config:cache failed"
# view:cache precompiles blade templates (perf optimization, optional, DB-free).
# Time-boxed: on 512MB free-tier it can be slow; a hang would stall the deploy.
# If it times out, Laravel still serves (compiles blades on demand).
timeout 90 php artisan view:cache 2>&1 || echo "WARNING: view:cache failed or timed out (continuing)"

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

echo "Listing all MPM load files:"
find /etc/apache2 -name "mpm_*" -type l 2>/dev/null
echo "---"
echo "Checking apache2.conf for MPM LoadModule:"
grep -n "mpm" /etc/apache2/apache2.conf 2>/dev/null || echo "No mpm in apache2.conf"

# ===== Dynamic port (Render injects $PORT, default 10000; Railway uses 8080) =====
RENDER_PORT="${PORT:-8080}"
if [ -n "$PORT" ]; then
    sed -i "s/^Listen .*/Listen $RENDER_PORT/" /etc/apache2/ports.conf
    if [ -f /etc/apache2/sites-enabled/000-default.conf ]; then
        sed -i "s|<VirtualHost \*:[0-9]*>|<VirtualHost *:$RENDER_PORT>|" /etc/apache2/sites-enabled/000-default.conf
    fi
    echo "Apache reconfigured to listen on Render port $RENDER_PORT"
fi

echo "Starting Apache on port ${RENDER_PORT}..."
exec apache2-foreground
