#!/bin/bash
set -e

# === Deploy progress logger (diagnostic) — writes markers to deploy_log table
# in the DB so we can see exactly where the entrypoint reaches/hangs, since
# Render free-tier runtime logs aren't exposed via API. Uses env vars (Render-
# injected DB_*), not .env (which still holds .env.example defaults at this point).
log_step() {
  STEP_MSG="$1" php -r '
    $h=getenv("DB_HOST"); $p=getenv("DB_PORT")?:"3306";
    $d=getenv("DB_DATABASE"); $u=getenv("DB_USERNAME"); $w=getenv("DB_PASSWORD");
    $msg=getenv("STEP_MSG");
    try {
      $pdo=new PDO("mysql:host=$h;port=$p;dbname=$d;charset=utf8mb4", $u, $w, [PDO::ATTR_TIMEOUT=>5]);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $pdo->exec("CREATE TABLE IF NOT EXISTS deploy_log (id INT AUTO_INCREMENT PRIMARY KEY, step VARCHAR(120), ts VARCHAR(40))");
      $st=$pdo->prepare("INSERT INTO deploy_log (step, ts) VALUES (?, ?)");
      $st->execute([$msg, date("Y-m-d H:i:s")]);
    } catch (\Throwable $ex) {}
  ' 2>/dev/null || true
  echo "[deploy-log] $1"
}
log_step "entrypoint_start"

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
# Render injects RENDER_EXTERNAL_URL (e.g. https://madrasati.onrender.com)
# and does NOT auto-inject MYSQLHOST/MYSQLPORT like Railway.
# DB_* must be provided as Render env vars directly.
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

# ===== CRITICAL: Map Railway env vars to .env file =====
# Railway injects env vars at runtime, but Laravel's config:cache reads from .env.
# If we don't sync them, config:cache will use the .env.example defaults (which may
# be wrong for production, e.g. SESSION_DRIVER=file instead of database).

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
        log_step "db_wait_failed"
        exit 1
    fi
fi
log_step "db_ready"

# Idempotent migrations + conditional seed (NEVER migrate:fresh — it destroys
# data and fails when the live deploy holds locks on the tables being dropped).
# Works the same in every APP_ENV: additive migrate, seed only on a truly empty DB.
echo "Running database migrations (additive, idempotent)..."
log_step "migrate_start"
if ! php artisan migrate --force 2>&1; then
    echo "WARN: php artisan migrate returned non-zero — continuing (DB likely already migrated)."
    log_step "migrate_failed_nonzero"
fi
log_step "migrate_done"
# Seed only when the users table is empty (brand-new DB). Preserves all data
# on subsequent deploys. Uses a lightweight raw PDO query (NOT tinker, which
# boots the full Laravel stack and OOMs on 512MB when combined with view:cache).
USER_COUNT=$(php -r '
$e=parse_ini_file("/var/www/html/.env");
try {
  $pdo=new PDO("mysql:host=".$e["DB_HOST"].";port=".($e["DB_PORT"]??"3306").";dbname=".$e["DB_DATABASE"].";charset=utf8mb4",
    $e["DB_USERNAME"], $e["DB_PASSWORD"], [PDO::ATTR_TIMEOUT=>8]);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo (int)$pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
} catch (\Throwable $ex) { echo "err"; }
' 2>/dev/null || echo "err")
if [ -z "$USER_COUNT" ] || [ "$USER_COUNT" = "err" ]; then USER_COUNT="unknown"; fi
log_step "user_count=$USER_COUNT"
if [ "$USER_COUNT" = "0" ]; then
    echo "Database is empty — running initial seeder..."
    log_step "seed_start"
    if ! php artisan db:seed --force 2>&1; then
        echo "WARN: db:seed returned non-zero — continuing."
        log_step "seed_failed_nonzero"
    fi
    log_step "seed_done"
else
    echo "Database has $USER_COUNT users — skipping seed (data preserved)."
    log_step "seed_skipped"
fi

# Publish PHPFlasher (toastr) assets so notifications work
php artisan flasher:install --no-interaction 2>/dev/null || true

# Clear ALL stale caches from previous deploys
php artisan route:clear 2>/dev/null || true
php artisan config:clear 2>/dev/null || true
php artisan view:clear 2>/dev/null || true
php artisan event:clear 2>/dev/null || true
# Force-remove any cached route file that may have been baked into the Docker image
rm -f /var/www/html/bootstrap/cache/routes*.php /var/www/html/bootstrap/cache/config.php /var/www/html/bootstrap/cache/events.php /var/www/html/bootstrap/cache/packages.php /var/www/html/bootstrap/cache/services.php 2>/dev/null || true
log_step "caches_cleared"

# Cache for production — these dramatically improve performance
php artisan config:cache 2>&1 || echo "WARNING: config:cache failed"
log_step "config_cached"
# view:cache precompiles all blade templates (perf optimization, optional).
# Time-boxed: on 512MB free-tier it can be slow or OOM; a hang here would stall
# the deploy forever. If it times out, Laravel still serves (compiles on demand).
timeout 90 php artisan view:cache 2>&1 || echo "WARNING: view:cache failed or timed out (continuing)"
log_step "view_cached"
# Note: route:cache disabled because LaravelLocalization::setLocale()
# does not work with cached routes (prefix is evaluated at compile time)
# php artisan route:cache

# Optimize autoloader for production (already done in Dockerfile but re-run to be safe)
# composer dump-autoload --optimize --no-dev 2>/dev/null || true

# Ensure writable permissions
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
log_step "chown_done"

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

# ===== Dynamic port (Render injects $PORT, default 10000; Railway uses 8080) =====
RENDER_PORT="${PORT:-8080}"
if [ -n "$PORT" ]; then
    sed -i "s/^Listen .*/Listen $RENDER_PORT/" /etc/apache2/ports.conf
    # Update the default vhost VirtualHost directive to match
    if [ -f /etc/apache2/sites-enabled/000-default.conf ]; then
        sed -i "s|<VirtualHost \*:[0-9]*>|<VirtualHost *:$RENDER_PORT>|" /etc/apache2/sites-enabled/000-default.conf
    fi
    echo "Apache reconfigured to listen on Render port $RENDER_PORT"
fi

echo "Starting Apache on port ${RENDER_PORT}..."
log_step "apache_start"
exec apache2-foreground