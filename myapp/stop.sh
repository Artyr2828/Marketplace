#!/bin/bash

echo "🛑 Остановка воркера..."
pkill -f "php artisan queue:work"

echo "🛑 Остановка Laravel..."
pkill -f "php artisan serve"

echo "🛑 Остановка Redis..."
redis-cli shutdown

echo "🛑 Остановка PostgreSQL..."
pg_ctl -D $HOME/postgres_data stop
