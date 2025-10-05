# My API
REST API для интернет-магазина с поддержкой пользователей, заказов и админ панели.

# Marketplace API

Backend для маркетплейса, написанный на Laravel.  
Предоставляет REST API для работы с пользователями, заказами, товарами и админ-панелью.

## Функционал:
- Регистрация и аутентификация пользователей
- Подтверждение e-mail через код
- Управление профилем пользователя (изменение данных, установка аватарки)
- Корзина покупателя
- Создание и управление заказами
- Поиск товаров
- Админ-панель:
  - Добавление, обновление и удаление товаров
  - Изменение статуса заказов
  - Просмотр списка заказов и деталей

 ## Технологии
- PHP 8.x
- Laravel Framework
- PostgreSQL — база данных
- Redis — кэш и хранение временных данных
- JWT (JSON Web Token) — для аутентификации
- Cron — планировщик задач
- Laravel Jobs (воркеры) — обработка фоновых задач
- PHPMailer — отправка email-сообщений
- Winzou State Machine — управление состояниями
- Swagger (OpenAPI) — документация API
- PHPUnit — юнит-тестирование


## Установка 
- клонировать репозиторий
  ```bash
  https://github.com/Artyr2828/Pet-project-in-laravel
- перейти в папку проекта
  ```bash
  cd myshop-api
  
- Установить зависимости
  ```bash 
  composer install
  
- Скопировать .env.example в .env и настройть
  ```bash
  cp .env.example .env
  
(настроить параметры базы данных, Redis и JWT
  
- Запустить Миграции
  ```bash
  php artisan migrate
  
- Запустить Сервер php(обязательно)
  ```bash
  php -S 127.0.0.1:8000 -t public
  
- Запустить Базу данных(обязательно)
  ```bash
  pg_ctl -D $PREFIX/var/lib/postgresql -l $PREFIX/var/lib/postgresql/logfile start

- Запустить Redis сервер(обязательно)
  ```bash
  redis-cli

- Запустить Cron(опционально)
  ```bash
  Crond

- Запустить Воркера(опционально)
  ```bash
  php artisan queue:work


## Просмотр Проекта
Важно!
Перед началом просмотра запустите PostgreSql, Redis, Php сервер (
```bash
pg_ctl -D $PREFIX/var/lib/postgresql -l $PREFIX/var/lib/postgresql/logfile start

php -S 127.0.0.1:8000 -t public
```
)

- Документация
  ```bash
  http://localhost:8000/api/documentation

- curl запросы
  curl.txt в папке pet(главная папка)

- внешний просмотр
  Откройте папку frontend (pet/frontend) и запустите сервер на 3000 порту (php -S localhost:3000), далее откройте любой браузер и зайдите по ссылке (http://localhost:3000)
  
Рекомендуемое(Документация, внешний просмотр)
  






