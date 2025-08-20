#!/bin/sh

# если нет .env — создаём
if [ ! -f /app/.env ]; then
  cp /app/.env.example /app/.env
fi

# генерируем ключ (только если пустой)
if ! grep -q "APP_KEY=" /app/.env || grep -q "APP_KEY=$" /app/.env; then
  php artisan key:generate --force
fi

# создаём sqlite-базу, если её нет
if [ ! -f /app/database/database.sqlite ]; then
  touch /app/database/database.sqlite
fi

# выполняем миграции
php artisan migrate --force

# запускаем laravel
exec "$@"
