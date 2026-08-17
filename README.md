# Blog API

Backend для мобильного приложения-блога на Laravel.

## Стек

- PHP / Laravel
- Laravel Sanctum
- Filament
- MySQL
- Eloquent ORM

## Установка

Клонировать проект:

```bash
git clone <repository-url>
cd blog
```

Установить зависимости:

```bash
composer install
npm install
```

Создать `.env`:

```bash
cp .env.example .env
```

Настроить подключение к БД в `.env`.

Запустить миграции и заполнить БД тестовыми данными:

```bash
php artisan migrate:fresh --seed
```

Запустить приложение:

```bash
php artisan serve
```

Приложение будет доступно по адресу:

```text
http://127.0.0.1:8000
```

## Проверка API

### Регистрация

```http
POST /api/register
```

```json
{
    "name": "Alex",
    "email": "alex@example.com",
    "password": "password123"
}
```

В ответе будет `token`.

### Авторизация

```http
POST /api/login
```

```json
{
    "email": "alex@example.com",
    "password": "password123"
}
```

### Получение общей ленты

```http
GET /api/posts
```

Поддерживаются параметры:

- `limit`
- `offset`
- `sort_by=created_at|title`
- `sort_direction=asc|desc`
- `date_from`
- `date_to`

Пример:

```http
GET /api/posts?limit=10&sort_by=title&sort_direction=asc
```

### Создание публикации

Требуется авторизация:

```http
POST /api/posts
Authorization: Bearer <token>
```

```json
{
    "title": "Test post",
    "text": "Post text"
}
```

### Получение своих публикаций

Требуется авторизация:

```http
GET /api/my-posts
Authorization: Bearer <token>
```

Поддерживаются те же параметры фильтрации, сортировки и пагинации.

### Получение текущего пользователя

```http
GET /api/user
Authorization: Bearer <token>
```

### Logout

```http
POST /api/logout
Authorization: Bearer <token>
```

## Админ-панель

Админ-панель:

```text
http://127.0.0.1:8000/admin
```

Доступна только пользователям с ролью `admin`.

В панели доступны:

- управление пользователями;
- управление публикациями.
