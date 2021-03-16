@section('main_section')
@foreach($lot as $elem)
<div class="editlot">
    <form method="POST">
        @csrf
        <div class="lotname__input">Название товара: <input type="text" name="name" value="{{$elem->lot_name}}"></div>
        <div class="lotcount__input">Количество товара: <input type="text" name="count" value="{{$elem->count}}"></div>
        <div class="lotdesc__input">Описание товара: <textarea name="description">{{$elem->lot_description}}</textarea></div>
        <div class="lotprice__input">Цена товара: <input type="text" name="price" value="{{$elem->price}}"></div>
        <div class="checkbox__input">Отметьте, если хотите удалить товар: <input type="checkbox" name="delete" value="1"></div>
        <div class="password__input">Подтвердите пароль при изменении товара: <input type="password" name="password"></div>
        <div class="submit__input"><input type="submit" name="submit"></div>
    </form>
</div>
@endforeach
@endsection
@include('layout')