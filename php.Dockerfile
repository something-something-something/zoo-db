FROM php:7.1-apache
COPY src/ /var/www/html/
RUN docker-php-ext-install mysqli
RUN chown -R www-data /var/www/html/settings/files
