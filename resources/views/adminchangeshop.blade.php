@section('main_section')
@foreach($shop as $elem)
<div class="adminchangeshop">
    <form method="POST">
        @csrf
        <div class="shopname__input">Название: <input type="text" name="shop_name" value="{{$elem->shop_name}}"></div>
        <div class="shopdesc__input">Описание: <textarea name="shop_description">{{$elem->shop_description}}</textarea></div>
        <div class="submit__input"><input type="submit" name="submit"></div>
    </form>
    <div><a href="/admin/delete/shop/{{$elem->id}}">Удалить магазин</a></div>   
</div>
@endforeach
@endsection
@include('layout')