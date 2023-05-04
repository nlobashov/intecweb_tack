<h1>Тестовое задание на PHP Backend Developer</h1>
<p>Решение сделано на чистом PHP без использования фреймворка и сторонних библиотек.</p>
<h2>Текст задания</h2>
<p>1. Создать в базе данных MySQL таблицу product со следующими полями:
<ul>
<li>id</li>
<li>name</li>
<li>name_trans</li>
<li>price</li>
<li>small_text</li>
<li>big_text</li>
<li>user_id</li>
</ul>
</p>

<p>2. Заполнить таблицу демо данными.<br>Создать класс для подключения к БД. Создать класс для работы с импортом/экспортом из 
файла CSV в БД. Во время импорта при совпадении ID записей, записи этого товара в 
базе должны обновляться иначе создать новый товар.<br><br>В таблице должны быть товары разных пользователей.<br>Предположим что в сессии есть ключ user_id, в котором лежит iD авторизованного 
пользователя, который совершает импорт.И при импорте, товары одного пользователя не должны затронуть товары другого пользователя, даже если ID товаров совпали.</p>

<p>3. Создать форму выбора файла и кнопку запуска импорта.<br>
По завершению сообщить пользователю о результатах импорта (добавлено 12/обновлено 43).
<br>В поле small_text не должны попадать теги и максимальная длина текста не должна превышать 30 символов.
А если оно отсутствует, то взять 30 символов из поля big_text. Создать класс обработчик 
основных полей формы.</p>