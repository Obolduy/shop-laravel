@section('main_section')
@foreach($shop as $elem)
<form method="POST">
    @csrf
    <p>Название магазина: <input type="text" name="shop_name" value="{{$elem->shop_name}}"></p>
    <p>Описание магазина: <textarea name="shop_description">{{$elem->shop_description}}</textarea></p>
    <p><input type="radio" name="showing" value="0" @if($elem->showing == 0) checked @endif>Не отображать</p>
    <p><input type="radio" name="showing" value="1" @if($elem->showing == 1) checked @endif>Отображать</p>
    <p><input type="submit" name="submit"></p>
</form>
<p><a href="/myshop/{{$elem->shop_name}}/delete">Вы можете удалить Ваш магазин</a></p>
@endforeach
@endsection
@include('layout')