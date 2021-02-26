@section('main_section')
@foreach($lot as $elem)
<form method="POST">
    @csrf
    <p>Название магазина: <input type="text" name="shop_name" value="{{$elem->lot_name}}"></p>
    <p>Описание магазина: <input type="text" name="shop_description" value="{{$elem->lot_description}}"></p>
    <p><input type="submit" name="submit"></p>
</form>
<p><a href="/myshop/{{$elem->shop_name}}/delete">Вы можете удалить Ваш магазин</a></p>
@endforeach
@endsection
@include('layout')