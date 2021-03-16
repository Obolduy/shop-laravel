<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('style/style.css') }}"/>
    <title>Магазинчик</title>
</head>
<body>
    <header>
        @if (session('auth'))
        <div class="logout">
            <a href="/logout">Выйти</a>
        </div>
            <div class="profile">
                <a href="/profile">{{ Auth::user()->login }}</a>
            </div>
        @else
        <div class="auth">
            <div class="reg-btn">
                <form action="/registration">
                    <button>Зарегистрироваться</button>
                </form>
            </div>
            <div class="login-btn">
                <form action="/login">
                    <button>Войти</button>
                </form>
            </div>
        </div>
        @endif
        <div class="title">
            Магазин «Magazine»
        </div>
        <div class="cart">
            <div class="cart-btn">
                <form action="/cart">
                    <button>Корзина</button>
                </form>
            </div>
        </div>
    </header>
    
    <div class="main">
        @yield('main_section')
    </div>
    
    <footer>
        <div class="footer-text">Copyright ne-copyrightera 2021©</div>
    </footer>
</body>
</html>