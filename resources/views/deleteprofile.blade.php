<div class="deleteprofile__form">
    <form method="POST">
        @csrf
        <div class="password__input">Подтвердите пароль, чтобы удалить аккаунт: <input type="password" name="password"></div>
        <div class="submit__input"><input type="submit" name="submit"></div>
    </form>
</div>
@include('layout')