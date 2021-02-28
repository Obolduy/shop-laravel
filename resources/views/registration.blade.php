@section('main_section')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST">
    @csrf
    <p>Логин: <input type="text" name="login"></p>
    <p>Email: <input type="text" name="email"></p>
    <p>Пароль: <input type="password" name="password"></p>
    <p>Подтвердите пароль: <input type="password" name="confirm_password"></p>
    <p>Имя: <input type="text" name="name"></p>
    <p>Фамилия: <input type="text" name="surname"></p>
    <p>Страна: <input type="text" name="country"></p>
    <p>Округ\область\штат\республика\etc: <input type="text" name="state"></p>
    <p>Город: <input type="text" name="city"></p>
    <p>Район: <input type="text" name="district"></p>
    <p>Улица: <input type="text" name="street"></p>
    <p>Дом: <input type="text" name="house"></p>
    <p><input type="submit" name="submit"></p>
</form>
@endsection
@include('layout')