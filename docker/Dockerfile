FROM php:8.2-fpm

WORKDIR /app

RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    nodejs \
    npm \
    && docker-php-ext-install pdo_sqlite

COPY . /app

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install --no-dev --no-scripts --optimize-autoloader
RUN npm install
RUN npm run build
#
#RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
#RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host", "0.0.0.0"]
