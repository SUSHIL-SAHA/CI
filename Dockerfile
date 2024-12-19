# official PHP runtime as a parent image
FROM php:7.4-apache

# Set the ServerName to avoid the warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Install necessary PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable mod_rewrite for Apache (needed by CodeIgniter)
RUN a2enmod rewrite

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Copy the current directory contents into the container at /var/www/html
COPY . /var/www/html/

# Expose port 80 for Cloud Run
EXPOSE 80

# Configure the Apache server to listen on port 8080 (Cloud Run default)
CMD ["apache2-foreground"]
