@section('main_section')
<form method="POST">
    @csrf
    <p>Город: <select name="city">@foreach ($cities as $city) <option value="{{$city->id}}">{{$city->city_name}}</option>@endforeach</select></p>
    <p>Район: <input type="text" name="district"></p>
    <p>Улица: <input type="text" name="street"></p>
    <p>Дом: <input type="text" name="house"></p>
    <p><input type="submit" name="submit"></p>
</form>
@endsection
@include('layout')