@section('main_section')
<form method="POST">
    @csrf
    <p>Название магазина: <input type="text" name="shop_name"></p>
    <p>Описание магазина: <textarea name="shop_description"></textarea></p>
    <p><input type="submit" name="submit"></p>
</form>
@endsection
@include('layout')