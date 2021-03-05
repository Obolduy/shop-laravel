@section('main_section')
@foreach($lot as $elem)
<p><b>{{$elem->lot_name}}</b></p>
@foreach($picture as $pic)
<p><img src="{{asset('storage/lots_images/'.$pic->picture)}}" alt="Картинки отсутствуют" width="189" height="255"></p>
@endforeach
<p>{{$elem->lot_description}}</p>
<p>{{$elem->price}}</p>
<p>{{$elem->count}}</p>
<p><i>{{$elem->created_at}}</i></p>
<p><a href="/cart/add/{{$elem->id}}">Добавить в корзину</a></p><br>

<form method="POST" action="/add_review/{{$elem->id}}">
    @csrf
    <p>Название отзыва:<input type="text" name="title"></p>
    <p><textarea name="text"></textarea></p>
    <p><input type="submit" name="submit"></p>
</form>
@endforeach
@foreach($reviews as $review)
<p><b>{{$review->title}}</b></p>
<p><b><i>{{$review->login}}</b></i></p>
<p>{{$review->text}}</p>
<p><i>{{$review->created_at}}</i></p>
@endforeach
@endsection
@include('layout')