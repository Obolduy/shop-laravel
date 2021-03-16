@section('main_section')
<div class="deleteshop__form">
    <form method="POST">
        @csrf
        <div class="password__input">Введите пароль для подтверждения удаления <input type="password" name="password"></div>
        <div class="submit__input"><input type="submit" name="submit"></div>
    </form>
</div>
@endsection
@include('layout')