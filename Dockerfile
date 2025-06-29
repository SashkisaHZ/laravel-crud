FROM php:8.2-apache

# Install required system packages
RUN apt-get update && apt-get install -y \
    curl \
    unzip \
    git \
    libzip-dev \
    zip \
    gnupg \
    && docker-php-ext-install pdo pdo_mysql mysqli

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

# Copy project files
COPY . /var/www/html

# Set correct Laravel public path in Apache
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!/var/www/html/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Set permissions for storage and cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80
CMD ["apache2-foreground"]


# Install essential PHP extensions for Laravel
RUN docker-php-ext-install pdo pdo_mysql
