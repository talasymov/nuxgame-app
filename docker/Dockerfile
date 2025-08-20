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

RUN mkdir -p storage bootstrap/cache database \
    && chown -R www-data:www-data storage bootstrap/cache database \
    && chmod -R 775 storage bootstrap/cache database

COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

RUN cp .env.example .env && \
    php artisan key:generate

EXPOSE 8000

ENTRYPOINT ["/entrypoint.sh"]

CMD ["php", "artisan", "serve", "--host", "0.0.0.0"]
