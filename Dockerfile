FROM php:8.1-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip zip libpng-dev libjpeg62-turbo-dev libfreetype6-dev \
    libxml2-dev libcurl4-openssl-dev libicu-dev libonig-dev libzip-dev \
    default-mysql-client \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    pdo_mysql mysqli mbstring xml bcmath intl gd curl zip opcache pcntl exif

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Fix Apache MPM - PHP requires prefork, not event
RUN a2dismod mpm_event 2>/dev/null || true \
    && a2dismod mpm_itk 2>/dev/null || true \
    && a2enmod mpm_prefork rewrite 2>/dev/null || true

# Set Apache document root to Laravel public
ENV APACHE_DOCUMENT_ROOT /app/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

WORKDIR /app

# Copy application files
COPY . .

# Copy .env.example as .env (Railway env vars will override at runtime)
RUN if [ ! -f /app/.env ] && [ -f /app/.env.example ]; then cp /app/.env.example /app/.env; fi

# Install PHP dependencies
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts
RUN composer run-script post-autoload-dump 2>/dev/null || true
RUN rm -rf /root/.composer/cache

# Create required directories and set permissions
RUN mkdir -p storage/framework/{sessions,views,cache,testing} \
    storage/logs bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache
RUN chown -R www-data:www-data /app

# Use production PHP config
RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini

# Copy and configure entrypoint
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Configure Apache port for Railway
RUN sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf
RUN echo 'ServerName localhost' >> /etc/apache2/apache2.conf

EXPOSE 8080

CMD ["/usr/local/bin/entrypoint.sh"]