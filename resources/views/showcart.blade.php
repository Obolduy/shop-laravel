@section('main_section')

    <div class="cart__empty">
        @if(isset($message))
        {{$message}} 
        @endif
    </div>
    @if(isset($lots))
    <div class="cart__list">
        @foreach($lots as $lot)
        <div class="lot">
            <div><img src="{{asset('storage/lots_images/'.$lot->picture)}}" alt="Изображение отсутствует"></div>
            <div>Название товара: <a href="/catalog/{{$lot->category_id}}/{{$lot->subcategory_id}}/{{$lot->id}}">{{$lot->lot_name}}</a></div>
            <div>Стоимость: {{$lot->price}}₽</div>
            <div><a href="/cart/delete/{{$lot->id}}">Удалить из корзины</a></div>
        </div>
        @endforeach
        <div class="cart__buy"><a href="/cart/buy/payment">Купить</a></div>
    </div>
    @endif

@endsection
@include('layout')