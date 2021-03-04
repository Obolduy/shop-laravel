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
@foreach($user_info as $user)
<form method="POST">
    @csrf
    <p>Страна: <input type="text" name="country" value="{{$user->country_name}}"></p>
    <p>Округ\область\штат\республика\etc: <input type="text" name="state" value="{{$user->region_name}}"></p>
    <p>Город: <input type="text" name="city" value="{{$user->city_name}}"></p>
    <p>Район: <input type="text" name="district" value="{{$user->district}}"></p>
    <p>Улица: <input type="text" name="street" value="{{$user->street}}"></p>
    <p>Дом: <input type="text" name="house" value="{{$user->house}}"></p>
    <p>Номер банковской карты: <input type="text" name="credit_card"></p>
    <p>CVC2\CVV2 код: <input type="text" name="code"></p>
    <p>Имя держателя: <input type="text" name="name" value="{{$user->name}}"></p>
    <p>Фамилия держателя: <input type="text" name="surname" value="{{$user->surname}}"></p>
    <p>Месяц и год окончания действия: <input type="text" name="month"> / <input type="text" name="year"></p>
    <p><input type="submit" name="submit"></p>
</form>
@endforeach
@endsection
@include('layout')