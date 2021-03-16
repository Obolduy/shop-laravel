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
<div class="pay__form">
    <form method="POST">
        @csrf
        <div class="country__input">Страна: <input type="text" name="country" value="{{$user->country_name}}"></div>
        <div class="region__input">Округ\область\штат\республика\etc: <input type="text" name="state" value="{{$user->region_name}}"></div>
        <div class="city__input">Город: <input type="text" name="city" value="{{$user->city_name}}"></div>
        <div class="district__input">Район: <input type="text" name="district" value="{{$user->district}}"></div>
        <div class="street__input">Улица: <input type="text" name="street" value="{{$user->street}}"></div>
        <div class="house__input">Дом: <input type="text" name="house" value="{{$user->house}}"></div>
        <div class="creditcard__input">Номер банковской карты: <input type="text" name="credit_card"></div>
        <div class="paycode__input">CVC2\CVV2 код: <input type="text" name="code"></div>
        <div class="name__input">Имя держателя: <input type="text" name="name" value="{{$user->name}}"></div>
        <div class="surname__input">Фамилия держателя: <input type="text" name="surname" value="{{$user->surname}}"></div>
        <div class="mmyy__input">Месяц и год окончания действия: <input type="text" name="month"> / <input type="text" name="year"></div>
        <div class="submit__input"><input type="submit" name="submit"></div>
    </form>
</div>
@endforeach
@endsection
@include('layout')