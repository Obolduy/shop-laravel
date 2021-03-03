@section('main_section')
<form method="POST">
    @csrf
    <p>Email: <input type="text" name="email"></p>
    <p>Пароль: <input type="password" name="password"></p>
    <p><input type="checkbox" name="remember" value="1">Запомнить меня</p>
    <p><input type="submit" name="submit"></p>
</form>
<p><a href="/reset-password">Забыли пароль?</a></p>
@endsection
@include('layout')