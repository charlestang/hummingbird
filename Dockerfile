FROM php:7.4.33-apache
RUN docker-php-ext-install pdo_mysql
RUN apt-get -y update \
    && apt-get install -y libicu-dev\
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl
RUN a2enmod rewrite
RUN chown -R www-data:www-data /var/www
RUN sed -i 's/\/var\/www\/html/${APACHE_DOCUMENT_ROOT}/' /etc/apache2/sites-available/000-default.conf
CMD [ "apache2-foreground" ]