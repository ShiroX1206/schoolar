FROM php:8.2-apache

# Install MySQL extensions required by api/config/database.php (mysqli) and PDO.
RUN docker-php-ext-install mysqli pdo_mysql && docker-php-ext-enable mysqli pdo_mysql

# Enable Apache modules used by docker/apache/schoolar.conf
RUN a2enmod rewrite headers

# Serve the browser UI from public/ (no /SCHOOlar subfolder inside the container).
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf || true

# Project Apache vhost + hardened PHP defaults
COPY docker/apache/schoolar.conf /etc/apache2/sites-available/000-default.conf
COPY docker/php/custom.ini /usr/local/etc/php/conf.d/schoolar-custom.ini

# Copy the whole project (browser UI lives under public/, served as web root).
COPY . /var/www/html/

# Writable dirs for uploads / session files if the app ever writes locally.
RUN chown -R www-data:www-data /var/www/html \
    && find /var/www/html -type d -exec chmod 755 {} \; \
    && find /var/www/html -type f -exec chmod 644 {} \;

EXPOSE 80

CMD ["apache2-foreground"]
