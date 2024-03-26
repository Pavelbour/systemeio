# Тестовое задание для systeme.io

## Как запустить.

1. Переименовать .env.example в .env и присвоить значения переменным.
2. Выполнить docker compose up --build -d
3. Выполнить docker compose exec app composer install
4. Выполнить docker compose exec app php bin/console -n doctrine:migrations:migrate
5. Выполнить docker compose exec app php bin/console -n doctrine:fixtures:load
