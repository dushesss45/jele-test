# Laravel API: Регистрация и показ пользователя

REST API на Laravel с регистрацией, авторизацией по токену и показ пользователя.

## Требования

* PHP 8.1+
* Composer
* Laravel 10+
* SQLite (по умолчанию)

## Установка

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
```

## Запуск

```bash
php artisan serve --port=8086
```

## Тестовые данные

После `php artisan db:seed` создаются:

* Админ: `admin@example.com / admin123`
* 5 пользователей (сгенерированы фабрикой)

## API

### POST /api/registration

```json
{
  "name": "Test",
  "email": "user@example.com",
  "password": "secret",
  "gender": "male"
}
```

Ответ:

```json
{
  "token": "..."
}
```

### GET /api/profile

Header:

```
Authorization: Bearer <token>
```

### PUT /api/profile

```json
{
  "name": "Updated Name",
  "password": "newpass",
  "gender": "female"
}
```
## Авторизация

Авторизация реализована через Laravel Sanctum.
Токен возвращается при регистрации и используется как Bearer токен в заголовках.

## Политики доступа

Пользователь может управлять только своим профилем, либо если он администратор (`is_admin = true`).
