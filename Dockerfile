# Use official PHP Apache image
FROM php:8.2-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy all files to the Apache server root
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html/

# Set permissions (optional but helpful)
RUN chown -R www-data:www-data /var/www/html/

# Expose default web port
EXPOSE 80
