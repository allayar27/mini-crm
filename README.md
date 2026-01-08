Установка и запуск
1. Клонировать репозиторий

```bash
git clone https://github.com/allayar27/mini-crm.git
```

2. Установить зависимости

```bash
composer install

npm install

npm run build
```

3. Настроить .env

Скопировать файл окружения:

```bash
cp .env.example .env
```

Сгенерировать ключ приложения:

```bash
php artisan key:generate
```

Миграции и сидеры

Запустить миграции и сидеров:

```bash
php artisan migrate --seed
```

Тестовые пользователи

После запуска сидеров доступны следующие аккаунты:

```bash
Email: user1@example.com
Password: password

Email: user2@example.com
Password: password
```

Запуск сервера

```bash
php artisan serve
```

Приложение будет доступно по адресу:

```bash
http://127.0.0.1:8000
```

Тесты

Запуск feature-тестов:

```bash
php artisan test
```
