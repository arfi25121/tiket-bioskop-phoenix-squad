FROM php:8.1.11-apache

# copy the source code
COPY src/ /var/www/html

# Copy database file
COPY database/database.db /var/www/

# enabling mod_rewrite
RUN cp /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/

# RUN docker-php-ext-install \
#     mysqli pdo pdo_mysql && \
#     docker-php-ext-enable \
#     pdo_mysql

# Expose port 80
EXPOSE 80