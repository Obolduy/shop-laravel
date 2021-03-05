@section('main_section')
@foreach($info as $elem)
<p>Логин: {{$elem->login}}</p>
<p>Аватар: <img src="{{asset('storage/avatars/'.Auth::user()->photo)}}" alt="Аватар отсутствует" width="189" height="255"></p>
<p>Email: {{$elem->email}} @if (!Auth::user()->email_verified_at) <i>(Не подтвержден)</i> @endif</p>
<p>Имя: {{$elem->name}}</p>
<p>Фамилия: {{$elem->surname}}</p>
<p>Страна: {{$elem->country_name}}</p>
<p>Округ\республика\etc: {{$elem->region_name}}</p>
<p>Город: {{$elem->city_name}}</p>
<p>Район: {{$elem->district}}</p>
<p>Улица: {{$elem->street}}</p>
<p>Дом: {{$elem->house}}</p>
<p>Магазин: @if (Auth::user()->shop_id) {{$elem->shop_name}} @else <i>Отсутствует</i> @endif</p>
@endforeach
@if (Auth::user()->status_id !== 1) <p><a href="/admin">Панель администратора</a></p >@endif
<p><a href="/profile/change">Изменить данные</a></p>
<p><a href="/profile/delete">Удалить профиль</a></p>
@if (Auth::user()->shop_id == null) <p><a href="/create-shop">Создать магазин</a></p> @endif
<p><a href="/profile/my_shop">Мой магазин</a></p>
<p><a href="/profile/my_reviews">Мои отзывы</a></p>
@endsection
@include('layout')