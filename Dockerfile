FROM php:8.3.0RC3-apache-bullseye
COPY . /var/www/html
RUN docker-php-ext-install pdo_mysql
RUN a2enmod rewrite
