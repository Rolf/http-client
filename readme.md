# Установка 
``composer require rolf/http-client``  
## Использование
1. Для работы инициируем класс ``$api = new Rolf\HttpClient\Client()``  
2. Для работы с комментариями вызываем ``$api->comments()``

| Метод | Результат запроса |
| ------ | ------ |
| ``$api->comments()->all()`` | ``[['id' => 1, 'name' => 'Статья 1', 'text' => 'Текст статьи']]`` |
| ``$api->comments()->create('Новая статья', 'Текст')`` | ``['id' => 2, 'name' => 'Новая статья', 'text' => 'Текст']`` |
| ``$api->comments()->create(1, 'Статья 1', 'Текст')`` | ``['id' => 1, 'name' => 'Статья 1', 'text' => 'Текст']`` |