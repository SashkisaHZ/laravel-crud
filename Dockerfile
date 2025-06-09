FROM php:8.2-apache

# Enable required PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Enable Apache rewrite module for Laravel routes
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

COPY . /var/www/html

# Copy composer and install dependencies inside container
# COPY composer.json composer.lock ./
# RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
#     php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
#     php composer.phar install

# Set Apache DocumentRoot to Laravel public folder
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!/var/www/html/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Set permissions for storage and cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80
CMD ["apache2-foreground"]

