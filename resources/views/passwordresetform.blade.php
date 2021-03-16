@section('main_section')
<div class="reset__form">
    <form method="POST">
        @csrf
        <div class="email__input">Введите email: <input type="email" name="email"></div>
        <div class="password__input">Введите новый пароль: <input type="password" name="password"></div>
        <div class="newpassword__input">Подтвердите новый пароль: <input type="password" name="password_confirmation"></div>
        <input type="hidden" name="token" value="{{$token}}"></div>
        <div class="submit__input"><input type="submit" name="submit" value="Восстановить пароль"></div>
    </form>
</div>
@endsection
@include('layout')