FROM php:8.2-apache

# Install required system packages and PHP extensions
RUN apt-get update && apt-get install -y \
    curl \
    unzip \
    git \
    libzip-dev \
    zip \
    gnupg \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql mysqli pdo_pgsql

# Enable Apache rewrite module for Laravel routes
RUN a2enmod rewrite

# Install Composer globally
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    rm composer-setup.php

# Install Node.js & npm (v18)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

# Set working directory
WORKDIR /var/www/html

# Copy all project files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install JS dependencies and build Vite assets
RUN npm install && npm run build

# Set correct Laravel public path in Apache config
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!/var/www/html/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Clear Laravel config and ensure DB is migrated at runtime
RUN php artisan config:clear

EXPOSE 80

CMD ["bash", "-c", "php artisan migrate --force && apache2-foreground"]
