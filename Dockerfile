FROM php:7.4-apache

# Install ekstensi yang dibutuhkan CodeIgniter dan Database
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Aktifkan mod_rewrite untuk URL cantik CodeIgniter
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html
# 532E48647974