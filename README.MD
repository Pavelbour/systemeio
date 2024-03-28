# Тестовое задание для systeme.io

## Как запустить.

1. Переименовать .env.example в .env и присвоить значения переменным.
2. Выполнить комманды:

```
docker compose up --build -d
docker compose exec app composer install
docker compose exec app php bin/console -n doctrine:migrations:migrate
docker compose exec app php bin/console -n doctrine:fixtures:load
```

## Тесты.
```
docker compose exec app php bin/phpunit
```
