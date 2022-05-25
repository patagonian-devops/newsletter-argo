FROM public.ecr.aws/bitnami/wordpress:5.9.3-debian-10-r51

# RUN apt-get update && apt-get install -y zlib1g-dev libpq-dev libmemcached-dev

# RUN pecl install memcached-3.1.5 && \

#   docker-php-ext-enable memcached

# Use the default production configuration

# RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

RUN a2enmod headers

RUN rm -rf /etc/apache2/sites-enabled/

COPY apache_mods.conf /etc/apache2/sites-enabled/

# Copy

COPY --chown=www-data:www-data . /var/www/html/

# COPY --chown=www-data:www-data .htaccess /var/www/html/.htaccess
