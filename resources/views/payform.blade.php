@section('main_section')
<form method="POST">
    @csrf
    <p>Страна: <input type="text" name="country"></p>
    <p>Округ\область\штат\республика\etc: <input type="text" name="state"></p>
    <p>Город: <input type="text" name="city"></p>
    <p>Район: <input type="text" name="dictrict"></p>
    <p>Улица: <input type="text" name="street"></p>
    <p>Дом: <input type="text" name="house"></p>
    <p>Номер банковской карты: <input type="text" name="credit_card"></p>
    <p>CVC2\CVV2 код: <input type="text" name="code"></p>
    <p>Имя держателя: <input type="text" name="name"></p>
    <p>Фамилия держателя: <input type="text" name="surname"></p>
    <p>Месяц и год окончания действия: <input type="text" name="month"> / <input type="text" name="year"></p>
    <p><input type="submit" name="submit"></p>
</form>
@endsection
@include('layout')