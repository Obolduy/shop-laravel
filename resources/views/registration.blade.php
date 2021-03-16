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
    <div class="login__input">Логин: <input type="text" name="login"></div>
    <div class="email__input">Email: <input type="text" name="email"></div>
    <div class="avatar__input">Загрузите Ваш аватар (Необязательно): <input type="file" accept="image/*" name="photo"></div>
    <div class="password__input">Пароль: <input type="password" name="password"></div>
    <div class="confirmpassword__input">Подтвердите пароль: <input type="password" name="confirm_password"></div>
    <div class="name__input">Имя: <input type="text" name="name"></div>
    <div class="lastname__input">Фамилия: <input type="text" name="surname"></div>
    <div class="country__input">Страна: <select name="country">@foreach ($countries as $country) <option value="{{$country->id}}">{{$country->country_name}}</option>@endforeach</select></div>
    <div class="submit__input"><input type="submit" name="submit" value="Дальше"></div>
</form>
@endsection
@include('layout')