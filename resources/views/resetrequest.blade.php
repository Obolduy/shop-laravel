@section('main_section')
<form method="POST">
    @csrf
    <p>Введите email, с помощью которого вы регистрировались на сайте: <input type="email" name="email"></p>
    <p><input type="submit" name="submit" value="Восстановить пароль"></p>
</form>
@endsection
@include('layout')