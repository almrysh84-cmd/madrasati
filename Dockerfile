FROM php:8.2-apache

# System dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    curl \
    git \
    libicu-dev \
    libonig-dev \
    default-mysql-client \
    && rm -rf /var/lib/apt/lists/*

# PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    pdo_mysql \
    mysqli \
    gd \
    mbstring \
    intl \
    zip \
    bcmath \
    opcache

# OPcache + performance tuning — keeps compiled PHP bytecode in memory
# so Laravel doesn't recompile on every request. Major speed boost.
RUN echo "[opcache]\n\
opcache.enable=1\n\
opcache.enable_cli=1\n\
opcache.memory_consumption=256\n\
opcache.max_accelerated_files=20000\n\
opcache.validate_timestamps=0\n\
opcache.revalidate_freq=0\n\
opcache.save_comments=1\n\
opcache.fast_shutdown=1\n\
opcache.jit=1255\n\
opcache.jit_buffer_size=128M\n" > /usr/local/etc/php/conf.d/opcache-recommended.ini

# Raise PHP memory + execution limits for PDF generation + large pages
RUN echo "memory_limit=512M\n\
max_execution_time=120\n\
upload_max_filesize=20M\n\
post_max_size=25M\n" > /usr/local/etc/php/conf.d/limits.ini

# Set Apache document root and configure for Laravel
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf \
    && sed -ri -e 's!Listen 80!Listen 8080!g' /etc/apache2/ports.conf \
    && rm -f /etc/apache2/mods-enabled/mpm_event.load \
    && rm -f /etc/apache2/mods-enabled/mpm_event.conf \
    && rm -f /etc/apache2/mods-enabled/mpm_worker.load \
    && rm -f /etc/apache2/mods-enabled/mpm_worker.conf \
    && rm -f /etc/apache2/mods-enabled/mpm_prefork.load \
    && rm -f /etc/apache2/mods-enabled/mpm_prefork.conf \
    && a2enmod mpm_prefork rewrite headers deflate filter expires \
    && rm -f /etc/apache2/mods-enabled/alias.conf /etc/apache2/mods-enabled/autoindex.conf

# Apache performance tuning: enable gzip compression + browser caching
# + tune prefork MPM for better concurrency
RUN echo '\n\
<IfModule mod_deflate.c>\n\
    AddOutputFilterByType DEFLATE text/html text/plain text/xml text/css text/javascript application/javascript application/json application/xml image/svg+xml\n\
    DeflateCompressionLevel 6\n\
    DeflateMemLevel 12\n\
    DeflateWindowSize 15\n\
</IfModule>\n\
\n\
<IfModule mod_expires.c>\n\
    ExpiresActive On\n\
    ExpiresByType text/css "access plus 1 year"\n\
    ExpiresByType application/javascript "access plus 1 year"\n\
    ExpiresByType image/jpeg "access plus 1 year"\n\
    ExpiresByType image/png "access plus 1 year"\n\
    ExpiresByType image/gif "access plus 1 year"\n\
    ExpiresByType image/svg+xml "access plus 1 year"\n\
    ExpiresByType image/x-icon "access plus 1 year"\n\
    ExpiresByType font/woff "access plus 1 year"\n\
    ExpiresByType font/woff2 "access plus 1 year"\n\
    ExpiresByType application/font-woff "access plus 1 year"\n\
    ExpiresByType application/pdf "access plus 1 month"\n\
</IfModule>\n\
\n\
<IfModule mpm_prefork_module>\n\
    StartServers             5\n\
    MinSpareServers          5\n\
    MaxSpareServers          10\n\
    MaxRequestWorkers        150\n\
    MaxConnectionsPerChild   1000\n\
</IfModule>\n' >> /etc/apache2/apache2.conf

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Copy application
COPY . /var/www/html
WORKDIR /var/www/html

# Composer install
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && COMPOSER_ALLOW_SUPERUSER=1 composer install --no-dev --optimize-autoloader --no-interaction

# Permissions and create required directories
RUN mkdir -p /var/www/html/storage/framework/{sessions,views,cache} \
    /var/www/html/storage/logs \
    /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Copy entrypoint
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 8080

HEALTHCHECK --interval=30s --timeout=5s --retries=3 \
  CMD curl -f http://localhost:8080/ || exit 1

CMD ["/usr/local/bin/entrypoint.sh"]