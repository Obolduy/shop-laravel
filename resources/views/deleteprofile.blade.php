<form method="POST">
    @csrf
    <p>Подтвердите пароль, чтобы удалить аккаунт: <input type="password" name="password"></p>
    <p><input type="submit" name="submit"></p>
</form>