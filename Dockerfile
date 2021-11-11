# Install php 7.4 apache image
FROM php:7.4-apache

# Install mysqli and enable it instide the container
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Check for updates and apply these updates
RUN apt-get update && apt-get upgrade -y
