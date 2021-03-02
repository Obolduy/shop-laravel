@section('main_section')
@foreach($lot as $elem)
<form method="POST">
    @csrf
    <p>Название товара: <input type="text" name="name" value="{{$elem->lot_name}}"></p>
    <p>Количество товара: <input type="text" name="count" value="{{$elem->count}}"></p>
    <p>Описание товара: <textarea name="description">{{$elem->lot_description}}</textarea></p>
    <p>Цена товара: <input type="text" name="price" value="{{$elem->price}}"></p>
    <p>Отметьте, если хотите удалить товар: <input type="checkbox" name="delete" value="1"></p>
    <p>Подтвердите пароль при изменении товара: <input type="password" name="password"></p>
    <p><input type="submit" name="submit"></p>
</form>
@endforeach
@endsection
@include('layout')