@section('main_section')
@foreach($lot as $elem)
<form method="POST">
    @csrf
    <p>Название: <input type="text" name="lot_name" value="{{$elem->lot_name}}"></p>
    <p>Название: <input type="text" name="count" value="{{$elem->count}}"></p>
    <p>Название: <input type="text" name="price" value="{{$elem->price}}"></p>
    <p>Описание: <textarea name="lot_description">{{$elem->lot_description}}</textarea></p>
    <p><input type="submit" name="submit"></p>
</form>
<p><a href="/admin/delete/lot/{{$elem->id}}">Удалить товар</a></p>
@endforeach
@endsection
@include('layout')