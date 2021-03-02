@section('main_section')
@foreach($shop as $elem)
<form method="POST">
    @csrf
    <p>Название: <input type="text" name="shop_name" value="{{$elem->shop_name}}"></p>
    <p>Описание: <textarea name="shop_description">{{$elem->shop_description}}</textarea></p>
    <p><input type="submit" name="submit"></p>
</form>
<p><a href="/admin/delete/shop/{{$elem->id}}">Удалить магазин</a></p>
@endforeach
@endsection
@include('layout')