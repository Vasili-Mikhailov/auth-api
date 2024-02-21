
# Тестовое задание

Реализация авторизации и регистрации в приложении 


## Deployment

Клонируйте репозиторий любым удобным способом, например:

```bash
  git clone https://github.com/Vasili-Mikhailov/auth-api.git auth-api
```

Перейдите в папку приложения

Разместите файл конфигурации используя комманду

```bash
  cp .env.example .env
```

Запустите Docker контейнеры

```bash
  docker compose build app

  docker compose up -d
```

Установите все необходимые пакеты через composer

```bash
  docker exec -u root laravel-container composer install
```
Запустите миграции

```bash
  docker exec -u root laravel-container php artisan migrate
```
Дайте необходимые доступы папке storage

```bash
  docker exec -u root laravel-container chmod -R 775 storage
```

**Примечание**: laravel-container - имя контейнера с приложением указанное по умолчанию


## API Reference

#### Авторизация и регистрация в приложении

```http
  GET /api/user_auth
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `id` | `integer` | **Required**. Идентификатор пользователя |
| `access_token` | `string` | **Required**. Токен |
| `first_name` | `string` | **Required**. Имя пользователя |
| `last_name` | `string` | **Required**. Фамилия |
| `city` | `string` | **Required**. Город |
| `country` | `string` | **Required**. Страна |
| `sig` | `string` | **Required**. |

## Переменные коружения

Для запуска этого приложения, необходимо наличие следующих переменных в вашем .env файле

`APP_SECRET_KEY`
