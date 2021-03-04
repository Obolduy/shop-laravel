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
Указывайте Ваш Адрес корректно, его нельзя будет изменить
<form enctype="multipart/form-data" method="POST">
    @csrf
    <p>Логин: <input type="text" name="login"></p>
    <p>Email: <input type="text" name="email"></p>
    <p>Загрузите Ваш аватар (Необязательно): <input type="file" accept="image/*" name="photo"></p>
    <p>Пароль: <input type="password" name="password"></p>
    <p>Подтвердите пароль: <input type="password" name="confirm_password"></p>
    <p>Имя: <input type="text" name="name"></p>
    <p>Фамилия: <input type="text" name="surname"></p>
    <p>Страна: <select name="country">@foreach ($countries as $country) <option value="{{$country->id}}">{{$country->country_name}}</option>@endforeach</select></p>
    <p><input type="submit" name="submit" value="Дальше"></p>
</form>
@endsection
@include('layout')