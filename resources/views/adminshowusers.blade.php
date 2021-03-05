@section('main_section')
<table>
    <colgroup>
      <col span="2" style="background:Khaki">
      <col style="background-color:rgb(74, 194, 74)">
    </colgroup>
    <tr>
      <th>Логин</th>
      <th>Email</th>
      <th>Имя</th>
      <th>Фамилия</th>
      <th>Страна</th>
      <th>Регион</th>
      <th>Город</th>
      <th>Район</th>
      <th>Улица</th>
      <th>Дом</th>
      <th>Дата регистрации</th>
    </tr>
    @foreach($users as $user)
    <tr>
        <td><a href="/admin/change/user/{{ $user->id }}">{{ $user->login }}</a></td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->surname }}</td>
        <td>{{ $user->country_name }}</td>
        <td>{{ $user->region_name }}</td>
        <td>{{ $user->city_name }}</td>
        <td>{{ $user->district }}</td>
        <td>{{ $user->street }}</td>
        <td>{{ $user->house }}</td>
        <td>{{ $user->registration_time }}</td>
      </tr>
    @endforeach
</table>
@endsection
@include('layout')