@section('main_section')
@foreach($user as $elem)
<div class="changeprofile">
    <form enctype="multipart/form-data" method="POST">
        @csrf
        <div class="login__input">Логин: <input type="text" name="login" value="{{$elem->login}}"></div>
        <div class="newpassword__input">Новый пароль: <input type="password" name="new_password"></div>
        <div class="email__input">Email: <input type="text" name="email" value="{{$elem->email}}"></div>
        <div class="avatar__input">Загрузите Ваш аватар (Необязательно): <input type="file" accept="image/*" name="photo"></div>
        <div class="name__input">Имя: <input type="text" name="name" value="{{$elem->name}}"></div>
        <div class="surname__input">Фамилия: <input type="text" name="surname" value="{{$elem->surname}}"></div>
        <div class="district__input">Район: <input type="text" name="district" value="{{$elem->district}}"></div>
        <div class="street__input">Улица: <input type="text" name="street" value="{{$elem->street}}"></div>
        <div class="house__input">Дом: <input type="text" name="house" value="{{$elem->house}}"></div>
        <div class="password__input">Подтвердите свой текущий пароль: <input type="password" name="password"></div>
        <div class="submit__input"><input type="submit" name="submit"></div>
    </form>
</div>
@endforeach
<div><a href="/profile/delete">Вы можете удалить Ваш профиль</a></div>
@endsection
@include('layout')