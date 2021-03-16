@section('main_section')
@foreach($user as $elem)
<div class="adminchangeuser__form">
    <form method="POST">
        @csrf
        <div class="login__input">Логин: <input type="text" name="login" value="{{$elem->login}}"></div>
        <div class="email__input">Email: <input type="text" name="email" value="{{$elem->email}}"></div>
        <div class="name__input">Имя: <input type="text" name="name" value="{{$elem->name}}"></div>
        <div class="surname__input">Фамилия: <input type="text" name="surname" value="{{$elem->surname}}"></div>
        <div class="country__input">Страна: <input type="text" name="country" value="{{$elem->country}}"></div>
        <div class="region__input">Округ\область\штат\республика\etc: <input type="text" name="state" value="{{$elem->state}}"></div>
        <div class="city__input">Город: <input type="text" name="city" value="{{$elem->city}}"></div>
        <div class="district__input">Район: <input type="text" name="district" value="{{$elem->district}}"></div>
        <div class="street__input">Улица: <input type="text" name="street" value="{{$elem->street}}"></div>
        <div class="house__input">Дом: <input type="text" name="house" value="{{$elem->house}}"></div>
        <div class="submit__input"><input type="submit" name="submit"></div>
    </form>
    <div><a href="/admin/delete/user/{{$elem->id}}">Удалить пользователя</a></div>    
</div>
@endforeach
@endsection
@include('layout')