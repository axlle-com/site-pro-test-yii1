<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>
<div>
    <div class="media">
        <img src="https://www.yiiframework.com/image/logo.svg" class="mr-3 logo">
        <div class="media-body-f">
            <h1 class="mt-0">Yii 1.1 Framework</h1>
        </div>
    </div>
    <hr>
    <ol>
        <li>Добавлен композер</li>
        <li>Добавлен и настроен Webpack</li>
        <li>Отключены все дефолтные скрипты и валидация</li>
        <li>Сделана своя AJAX валидация</li>
    </ol>
    <hr>
    <h3 id="первый-запуск">Первый запуск</h3>
    <ol start="0">
        <li>В консоли command <code>git clone https://github.com/axlle-com/site-pro-test-yii1.git .</code> скачиваем репозиторий в текущую директорию</li>
        <li>В консоли command <code>yiic firstdump up</code> создаем базу, на хосте это пропустить</li>
        <li>В консоли command <code>yiic migrate</code> запускаем миграции - создаем таблицу пользователей</li>
        <li>В консоли command <code>composer update</code> скачиваем все приложения</li>
        <li>В консоли command <code>npm install</code> скачиваем и устанавливаем node_modules</li>
        <li>В консоли command <code>npm run prod</code> собираем и упаковываем js скрипты</li>
    </ol>
    <hr>
    <h3 id="формат-ответа-ajax">Формат ответа ajax</h3>
    <pre><code class="language-json">{
    &quot;status&quot;: 0|1, //Успех или нет
    &quot;error&quot;: null|array, //Массив ошибок
    &quot;message&quot;: null|string, //Сообщение
    &quot;status_code&quot;: 200|404|403 ..., //Код ответа сервера
    &quot;data&quot;: null|array //Массив данных
}
</code></pre>

    </pre>
</div>
