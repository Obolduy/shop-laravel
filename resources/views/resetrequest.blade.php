@section('main_section')
<div class="reset__request">
    <form method="POST">
        @csrf
        <div class="email__input">Введите email, с помощью которого вы регистрировались на сайте: <input type="email" name="email"></div>
        <div class="submit__input"><input type="submit" name="submit" value="Восстановить пароль"></div>
    </form>
</div>
@endsection
@include('layout')