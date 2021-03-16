@section('main_section')
<form method="POST">
    @csrf
    <div class="city__input">Город: <select name="city">@foreach ($cities as $city) <option value="{{$city->id}}">{{$city->city_name}}</option>@endforeach</select></div>
    <div class="district__input">Район: <input type="text" name="district"></div>
    <div class="street__input">Улица: <input type="text" name="street"></div>
    <div class="house__input">Дом: <input type="text" name="house"></div>
    <div class="submit__input"><input type="submit" name="submit"></div>
</form>
@endsection
@include('layout')