# Use the highly optimized ServerSideUp PHP image which includes Nginx and PHP-FPM configured for Laravel
FROM serversideup/php:8.3-fpm-nginx

# Switch to root to configure permissions
USER root

# Copy application files and set ownership to www-data (the web server user)
COPY --chown=www-data:www-data . /var/www/html

# Switch back to www-data for security
USER www-data

# Install Composer dependencies automatically during build (ignoring dev packages and caching)
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Note: Render executes the container automatically.
# Nginx and PHP-FPM will start by default and serve the /var/www/html/public directory.
