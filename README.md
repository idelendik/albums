# Albums

В данный момент проект находится в стадии `work in progress`.

## Требования

Ожидаемый результат:

- Пользователь может создавать, просматривать и редактировать альбомы.
- В альбоме пользователь может добавлять, просматривать и редактировать изображения.
- Пользователи могут ставить лайки/дизлайки и оставлять комментарии к изображениям.
- Данные должны быть сохранены в базе данных и корректно отображаться на страницах.

Реализация функционала альбомов:

- Создайте страницу, на которой пользователь может просмотреть список всех альбомов.

- Реализуйте возможность создания нового альбома:
    - Создайте форму, где пользователь может ввести название и описание нового альбома.
    - При отправке формы, новый альбом должен сохраняться в базе данных.
- При клике на альбом, пользователь должен быть перенаправлен на страницу просмотра альбома.

- Реализуйте страницу просмотра альбома:
    - На странице должны отображаться все изображения в виде миниатюр, относящиеся к данному альбому.
    - Под миниатюрами отобразите название фото, количество лайков/дизлайков, количество комментариев.
    - При клике на миниатюру, откройте полноразмерное изображение в модальном окне:
    - Создайте форму где пользователь может оставить комментарий к фото.
    - Добавьте возможность поставить лайк/дизлайк, должна быть возможность сбросить либо изменить свое решение в рамках
      сессии пользователя.
    - Отобразите название, описание, лайки/дизлайки, комментарии.
- Реализуйте функционал добавления нового изображения в альбом:
    - Создайте форму, где пользователь может выбрать файл изображения, ввести его название и описание.
    - Проверьте, что выбранный файл является изображением.
    - При отправке формы, новое изображение должно сохраняться в базе данных и быть привязано к текущему альбому.

- В файле README.md опишите инструкцию по развертке/установке.

- Задачу нужно реализовать без использования PHP-фреймворков и CMS
- Технологии: PHP 8, MySQL 5.7, Bootstrap, JS, jQuery, CSS, HTML

## Запуск

- Установить и запусить `docker`. [Инструкция](https://docs.docker.com/desktop/)
- В корневой папке проекта выполнить команду ```make up```
- В браузере открыть ```http://localhost/```
- База данных ```http://localhost:8080/``` (username: root, password: pass)

## Остановка

- В корневой папке проекта выполнить команду ```make down```