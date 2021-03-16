@section('main_section')
@foreach($lot as $elem)
<div class="adminchangelot__form">
    <form method="POST">
        @csrf
        <div class="lotname__input">Название: <input type="text" name="lot_name" value="{{$elem->lot_name}}"></div>
        <div class="lotcount__input">Количество: <input type="text" name="count" value="{{$elem->count}}"></div>
        <div class="lotprice__input">Цена: <input type="text" name="price" value="{{$elem->price}}"></div>
        <div class="lotdesc__input">Описание: <textarea name="lot_description">{{$elem->lot_description}}</textarea></div>
        <div class="submit__input"><input type="submit" name="submit"></div>
    </form>
    <div><a href="/admin/delete/lot/{{$elem->id}}">Удалить товар</a></div>
</div>
@endforeach
@endsection
@include('layout')