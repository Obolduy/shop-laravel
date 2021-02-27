@section('main_section')
@foreach($user as $elem)
<form method="POST">
    @csrf
    <p>Логин: <input type="text" name="login" value="{{$elem->login}}"></p>
    <p>Email: <input type="text" name="email" value="{{$elem->email}}"></p>
    <p>Имя: <input type="text" name="name" value="{{$elem->name}}"></p>
    <p>Фамилия: <input type="text" name="surname" value="{{$elem->surname}}"></p>
    <p>Страна: <input type="text" name="country" value="{{$elem->country}}"></p>
    <p>Округ\область\штат\республика\etc: <input type="text" name="state" value="{{$elem->state}}"></p>
    <p>Город: <input type="text" name="city" value="{{$elem->city}}"></p>
    <p>Район: <input type="text" name="dictrict" value="{{$elem->district}}"></p>
    <p>Улица: <input type="text" name="street" value="{{$elem->street}}"></p>
    <p>Дом: <input type="text" name="house" value="{{$elem->house}}"></p>
    <p><input type="submit" name="submit"></p>
</form>
<p><a href="/admin/delete/user/{{$elem->id}}">Удалить пользователя</a></p>
@endforeach
@endsection
@include('layout')