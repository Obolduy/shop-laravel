@section('main_section')
<p>@if(isset($message)) {{$message}} @endif</p>
@if(isset($lots))
@foreach($lots as $lot)
<p><a href="/catalog/{{$lot->category_id}}/{{$lot->subcategory_id}}/{{$lot->id}}">{{$lot->lot_name}}</a></p>
<p>{{$lot->price}}</p>
<p><a href="/cart/delete/{{$lot->id}}">Удалить из корзины</a></p>
@endforeach
<p><a href="/cart/buy/payment">Купить</a></p>
@endif
@endsection
@include('layout')