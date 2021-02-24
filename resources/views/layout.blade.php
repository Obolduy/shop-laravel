<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Магазинчик</title>
</head>
<body>
    <header> @if (session('auth'))<p><a href="/logout">Выйти</a></p><p><a href="/users/{{Auth::user()->login}}">{{ Auth::user()->login }}</a></p>@else <p><a href="/registration">Зарегистрируйтесь</a> или <a href="/login">Войдите</a></p> @endif </header>
    
    @yield('main_section')
    
    <footer><p>Футер</p></footer>
</body>
</html>