# Сервис по созданию коротких адресов

## Техническое задание
Используя последнюю версию Laravel создать простой сервис по сокращению ссылок.
На главной странице выводим форму для ввода ссылки и кнопка "сократить".

Сервис отдает сокращенный вариант. При этом, сокращенный вариант - это не просто набор символов, а по такому принципу:
первая сокращенная ссылка станет site.ru/a

вторая site.ru/b

третья site.ru/c

.....

потом site.ru/aa ... site.ru/ab ... site.ru/ac и т.д.

Ниже формы выводим последние 10 сокращенных ссылок.

Сокращение ссылок и обновление последних 10 сокращенных ссылок должны происходить через AJAX запросы (без перезагрузки страницы).

Результат задания необходимо залить на GitHub и прислать ссылку на репозиторий.

## Описание выполнения
Для выполнения была использована последняя версия Laravel

Для JS на фронте был использован JQuery

Для упрощения работы бэк отдает готовую вьюху.

## Файлы с кодом
- /app/Http/Controllers/IndexController.php
- /app/Http/Requests/GenerateLinkRequest.php
- /app/Http/Requests/StoreLinkRequest.php
- /app/Models/Link.php
- /database/factories/LinkFactory.php
- /database/migrations/2023_12_11_121540_create_links_table.php
- /resources/views/index.blade.php
- /resources/views/results.blade.php

## Установка
- https://github.com/torkvi-po/shrt-lnk.git
- в файле **.env** прописать доступ к БД
- запустить **composer update**
- запустить миграцию: **php artisan migrate**
- запустить сервер: **php artisan serve**
- перейти http://127.0.0.1:8000
