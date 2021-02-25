@section('main_section')
<p>@if($message) {{$message}} @endif</p>
@if($lots)
@foreach($lots as $lot)
<p><a href="/catalog/{{$lot->category_id}}/{{$lot->subcategory_id}}/{{$lot->id}}">{{$lot->lot_name}}</a></p>
<p>{{$lot->lot_price}}</p>
<p><a href="/cart/delete/{{$lot->id}}">Удалить из корзины</a></p>
@endforeach
@endif
@endsection
@include('layout')