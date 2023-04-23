# car-dealer-crm
### Локальное развертывание
1. ``cp .env.example .env`` (можно поменять на свои значения)
2. ``cd laravel && cp .env.example .env``
3. Тут в ``.env`` вводим данные для подключения к БД (из ``.env`` в пункте 1)
4. ``docker-compose up``
5. Проваливаемся в php контейнер ``docker exec -it dealer-php bash``, устанавливаем зависимости ``composer i``, генерируем APP_KEY ``php artisan key:generate`` и запускаем миграции ``php artisan migrate``