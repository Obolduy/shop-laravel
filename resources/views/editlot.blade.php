@section('main_section')
@foreach($lot as $elem)
<form method="POST">
    @csrf
    <p>Название товара: <input type="text" name="country" value="{{$elem->lot_name}}"></p>
    <p>Количество товара: <input type="text" name="name" value="{{$elem->count}}"></p>
    <p>Описание товара: <input type="text" name="surname" value="{{$elem->lot_description}}"></p>
    <p>Цена товара: <input type="text" name="country" value="{{$elem->price}}"></p>
    <p>Отметьте, если хотите удалить товар: <input type="checkbox" name="delete" value="1"></p>
    <p>Подтвердите пароль при изменении товара: <input type="password" name="password"></p>
    <p><input type="submit" name="submit"></p>
</form>
@endforeach
@endsection
@include('layout')