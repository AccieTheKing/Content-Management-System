# Install php 8.1 apache image
FROM php:8.1-apache

# Script for changing some permissions to use .htaccess file
SHELL ["/bin/bash", "-c"]
RUN ln -s ../mods-available/{expires,headers,rewrite}.load /etc/apache2/mods-enabled/
RUN sed -e '/<Directory \/var\/www\/>/,/<\/Directory>/s/AllowOverride None/AllowOverride All/' -i /etc/apache2/apache2.conf

# Install mysqli and enable it instide the container
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Check for updates and apply these updates
RUN apt-get update && apt-get upgrade -y
