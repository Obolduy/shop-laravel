@section('main_section')
@foreach($info as $elem)
<p>Логин: {{$elem->login}}</p>
<p>Аватар: {{$elem->photo}}</p>
<p>Email: {{$elem->email}} @if(!Auth::user()->email_verified_at) <i>(Не подтвержден)</i> @endif</p>
<p>Имя: {{$elem->name}}</p>
<p>Фамилия: {{$elem->surname}}</p>
<p>Страна: {{$elem->country}}</p>
<p>Округ\республика\etc: {{$elem->state}}</p>
<p>Город: {{$elem->city}}</p>
<p>Район: {{$elem->district}}</p>
<p>Улица: {{$elem->street}}</p>
<p>Дом: {{$elem->house}}</p>
<p>Магазин: @if(Auth::user()->shop_id) {{$elem->shop}} @else <i>Отсутствует</i> @endif</p>
@endforeach
@endsection
@include('layout')