FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev \
    sqlite3 libsqlite3-dev

RUN docker-php-ext-install pdo pdo_mysql pdo_sqlite mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN cp .env.example .env || true

RUN mkdir -p database && touch database/database.sqlite

RUN composer install --no-dev --optimize-autoloader

RUN chmod -R 777 storage bootstrap/cache

RUN php artisan config:clear
RUN php artisan cache:clear

RUN php artisan migrate --force || true

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000