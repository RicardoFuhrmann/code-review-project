# Use official PHP image with Apache
FROM php:8.2-apache

# Install Composer and required extensions
RUN apt-get update && apt-get install -y unzip curl \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Enable required PHP modules
RUN docker-php-ext-install pdo pdo_mysql

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install dependencies and generate autoload files
RUN composer install --no-dev --optimize-autoloader && composer dump-autoload

# Set correct Apache document root
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Enable Apache rewrite module
RUN a2enmod rewrite

# Restart Apache
RUN service apache2 restart

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
