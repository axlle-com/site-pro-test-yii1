---
1. Добавлен композер
2. Добавлен и настроен Webpack
3. Отключены все дефолтные скрипты и валидация
4. Сделана своя AJAX валидация
---
### Первый запуск
0. В консоли command `git clone https://github.com/axlle-com/site-pro-test-yii1.git .` скачиваем репозиторий в текущую директорию
1. В консоли command `yiic firstdump up` создаем базу, на хосте это пропустить
2. В консоли command `yiic migrate` запускаем миграции - создаем таблицу пользователей
3. В консоли command `composer update` скачиваем все приложения
4. В консоли command `npm install` скачиваем и устанавливаем node_modules
5. В консоли command `npm run prod` собираем и упаковываем js скрипты
---
### Формат ответа ajax
```php
{
    "status": 0|1, //Успех или нет
    "error": null|array, //Массив ошибок
    "message": null|string, //Сообщение
    "status_code": 200|404|403 ..., //Код ответа сервера
    "data": null|array //Массив данных
}
```
