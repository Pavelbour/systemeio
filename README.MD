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

## Примеры запросов.
- /calculate-price endpoin.
```
curl --location 'localhost:8337/calculate-price' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data '{
    "product": 1,
    "taxNumber": "IT22222222222",
    "couponCode": "P10"
}'
```

- /purchase endpoint
```
curl --location 'localhost:8337/purchase' \
--header 'Content-Type: application/json' \
--data '{
    "product": 1,
    "taxNumber": "IT22222222222",
    "couponCode": "P10",
    "paymentProcessor": "stripe"
}'
```

## Тесты.
1. Переименовать env.test.example и env.tast.local.example в env.test и env.test.local соответсвенно. Присвоить значения переменным.
2. Выполнить комманду:
```
docker compose exec app php bin/phpunit
```

## Комментарии.
- Цены хранятся в виде integer чтобы избежать проблем при вычислениях с плавующей точкой.
- В конечном итоге было решено отказаться от индексов в бд, так как комманда EXPLAIN показала что они не используются при выборке.
- Добавить новую платёжную систему можно создав соответсвующий класс NewPaymentSystemeProcessorClass и добавив его в PaymentProcessorPool. Аналогичным образом можно добавить новые виды купонов.
- Правила для валидации tax number хранятся в бд в таблице tax_number_validator в виде regex. Доьавить новый формат tax number можно путём добавления новой записи в данную таблицу.
