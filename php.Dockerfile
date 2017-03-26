FROM php:7.1-apache
RUN docker-php-ext-install mysqli
RUN mkdir -p /var/www/html/settings/files
RUN chown -R www-data /var/www/html/settings/files
