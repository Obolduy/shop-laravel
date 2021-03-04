@section('main_section')
@foreach($user as $elem)
<form enctype="multipart/form-data" method="POST">
    @csrf
    <p>Логин: <input type="text" name="login" value="{{$elem->login}}"></p>
    <p>Новый пароль: <input type="password" name="new_password"></p>
    <p>Email: <input type="text" name="email" value="{{$elem->email}}"></p>
    <p>Загрузите Ваш аватар (Необязательно): <input type="file" accept="image/*" name="photo"></p>
    <p>Имя: <input type="text" name="name" value="{{$elem->name}}"></p>
    <p>Фамилия: <input type="text" name="surname" value="{{$elem->surname}}"></p>
    <p>Район: <input type="text" name="district" value="{{$elem->district}}"></p>
    <p>Улица: <input type="text" name="street" value="{{$elem->street}}"></p>
    <p>Дом: <input type="text" name="house" value="{{$elem->house}}"></p>
    <p>Подтвердите свой текущий пароль: <input type="password" name="password"></p>
    <p><input type="submit" name="submit"></p>
</form>
@endforeach
<p><a href="/profile/delete">Вы можете удалить Ваш профиль</a></p>
@endsection
@include('layout')