@section('main_section')
<form method="POST">
    @csrf
    <p>Введите email: <input type="email" name="email"></p>
    <p>Введите новый пароль: <input type="password" name="password"></p>
    <p>Подтвердите новый пароль: <input type="password" name="password_confirmation"></p>
    <input type="hidden" name="token" value="{{$token}}"></p>
    <p><input type="submit" name="submit" value="Восстановить пароль"></p>
</form>
@endsection
@include('layout')