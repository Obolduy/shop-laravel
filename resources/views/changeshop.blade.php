@section('main_section')
@foreach($shop as $elem)
<div class="changeshop">
    <form method="POST">
        @csrf
        <div class="lotname__input">Название магазина: <input type="text" name="shop_name" value="{{$elem->shop_name}}"></div>
        <div class="lotdesc__input">Описание магазина: <textarea name="shop_description">{{$elem->shop_description}}</textarea></div>
        <div class="radio__input"><input type="radio" name="showing" value="0" @if($elem->showing == 0) checked @endif>Не отображать</div>
        <div class="checkbox__input"><input type="radio" name="showing" value="1" @if($elem->showing == 1) checked @endif>Отображать</div>
        <div class="submit__input"><input type="submit" name="submit"></div>
    </form>
    <div>
        <a href="/myshop/{{$elem->shop_name}}/delete">Вы можете удалить Ваш магазин</a>
    </div>
</div>
@endforeach
@endsection
@include('layout')