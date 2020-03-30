## О проекте
Данный проект сделан для решения задания:
https://docs.google.com/document/d/1iiGK6jpxBsyf28oO374yZCLg6x8E5XfnXQdTnbFK9YY/edit#

Разработан на Laravel 7.0 (локально, OpenServer) 
Версия php не ниже 7.3.12

Скриншоты с локальной машины - здесь: 
https://drive.google.com/drive/folders/1Z81El3Yz_prnhiYrKYx3RF_8H3hrLL0c?usp=sharing

## Особенности

- CRUD реализован через стандарные Route и контроллер PostsController
- Используются 3 таблицы БД:  посты (модель Posts), просмотры постов (модель PostsViews) и авторы (без модели, таблица authors)
- Для первоначальной генерации демо-данных (авторы и посты) надо один раз вызвать команду $php artisan db:seed 
- Каждые 5 минут имитируется приращение просмотров через стандартный TaskSheduling (при настроеном cron).   Метод реализован в app/Console/Kernel.php
