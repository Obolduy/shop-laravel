@section('main_section')
@foreach($info as $elem)
<div class="user__info">
    <div>Логин: <span>{{$elem->login}}</span></div>
    <div>Аватар: <img src="{{asset('storage/avatars/'.Auth::user()->photo)}}" alt="Аватар отсутствует"></div>
    <div>Email: <span>{{$elem->email}}</span> @if (!Auth::user()->email_verified_at) <i>(Не подтвержден)</i> @endif</div>
    <div>Имя: <span>{{$elem->name}}</span></div>
    <div>Фамилия: <span>{{$elem->surname}}</span></div>
    <div>Страна: <span>{{$elem->country_name}}</span></div>
    <div>Округ\республика\etc: <span>{{$elem->region_name}}</span></div>
    <div>Город: <span>{{$elem->city_name}}</span></div>
    <div>Район: <span>{{$elem->district}}</span></div>
    <div>Улица: <span>{{$elem->street}}</span></div>
    <div>Дом: <span>{{$elem->house}}</span></div>
    <div>Магазин: @if (Auth::user()->shop_id) <span>{{$elem->shop_name}}</span> @else <i>Отсутствует</i> @endif</div>
</div>
@endforeach
<div class="userchange">
    @if (Auth::user()->status_id !== 1) <div><a href="/admin">Панель администратора</a></p >@endif
    <div><a href="/profile/change">Изменить данные</a></div>
    <div><a href="/profile/delete">Удалить профиль</a></div>
    @if (Auth::user()->shop_id == null) <div><a href="/create-shop">Создать магазин</a></div> @endif
    <div><a href="/profile/my_shop">Мой магазин</a></div>
    <div><a href="/profile/my_reviews">Мои отзывы</a></div>
</div>
@endsection
@include('layout')