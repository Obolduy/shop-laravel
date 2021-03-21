<p>This is one of my firsts (Actually second) pet-projects in Laravel. It tried to kill my pc two times in a row, but it`s still standing:)</p>
<p>The idea is that "Magazine" is kind of aggregator of shops. If you want to buy something, you shouldn`t have to register, but if you want to open your own shop, after the registration you need to click 'Create shop' in user`s profile. Then you can add lots and sell it</p>

# PHP: 7.3;
# Server: Apache;
# Laravel 8;
# DB: MySQL;
# Mail: MailTrap;
# Cache: Redis;
# No JavaScript, no AJAX;
# No payment or pay-systems, only fiction payform;
# Page 404 and errors on russian coming up next...

<p>
Отдельно хочу заметить: <br>
Форма оплаты - фикция, которая после валидации данных выкидывает пользователя с сообщением, что все оплачено, и декременирует количество "купленных" товаров в БД.<br>
Аякс планируется добавить для счетчика товаров в корзине в шапке и регистрации (Не дело, что для выбора страны\региона\города или добавления товара используется 3 разных представления). Так же в планах есть: тестирование, небольшая починка верстки (В том числе добавление уникальной для писем), рейтинг и капча.<br>
При попытке зарегистрироваться, скачав этот репозиторий, возникнет казус: БД, из которых магазин берёт страну, регион и город в миграции присутствуют лишь номинально, потому что одних лишь регионов несколько тысяч, чего уж говорить про города. Базы данных с ними были взяты из интернета и слегка урезаны (до ~8000 наименований, ибо на большее компьютер оказывался не способен). Регистрация работает, можете поверить на слово, а можете просто попробовать заполнить таблицы самостоятельно для проверки. <br>
Есть условность со статусом (группой пользователей), заключающаяся в том, что обычный пользователь имеет индекс 1, а админстратор - 3.
</p>
