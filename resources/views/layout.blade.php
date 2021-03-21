<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('style/style.css') }}"/>
    <title>Магазинчик</title>
</head>
<body>
    <header>
        <div class="cart">
            <div class="cart-btn">
                <form action="/cart">
                    <button>Корзина</button>
                </form>
            </div>
        </div>
        <div class="auth">
        @if (session('auth'))
            <div class="logout">
                <form action="/logout">
                    <button>Выйти</button>
                </form>
            </div>
            <div class="profile">
                <form action="/profile">
                    <button>{{ Auth::user()->login }}</button>
                </form>
            </div>
        @else
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
        @endif
        </div>
    </header>
    
    <div class="main">
        @yield('main_section')
    </div>
    
    <footer>
        <div class="footer-text">Copyright ne-copyrightera @php echo date('Y') @endphp©</div>
    </footer>
</body>
</html>