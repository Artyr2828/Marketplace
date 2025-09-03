#!/bin/bash

# 1. Запускаем Redis в фоне
echo "🚀 Запуск Redis..."
redis-server

# 2. Запускаем PostgreSQL (путь зависит от твоей установки)
echo "🚀 Запуск PostgreSQL..."
pg_ctl -D $PREFIX/var/lib/postgresql -l $PREFIX/var/lib/postgresql/logfile start

# 3. Запускаем Laravel server в фоне
echo "🚀 Запуск Laravel..."
php artisan serve &

# 4. Запускаем воркер в фоне

echo "✅ Все сервисы запущены"
echo "🌐 Laravel доступен на http://127.0.0.1:8000"

# 5. Чтобы скрипт не завершился, ждём
wait
