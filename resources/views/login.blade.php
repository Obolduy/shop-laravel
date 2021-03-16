@section('main_section')
<div class="login__form">
    <form method="POST">
        @csrf
        <div class="email__input">Email: <input type="text" name="email"></div>
        <div class="password__input">Пароль: <input type="password" name="password"></div>
        <div class="checkbox__input"><input type="checkbox" name="remember" value="1"> Запомнить меня</div>
        <div class="submit__input"><input type="submit" name="submit"></div>
    </form>
    <div class="password__reset"><a href="/reset-password">Забыли пароль?</a></div>
</div>
@endsection
@include('layout')