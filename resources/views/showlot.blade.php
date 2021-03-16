@section('main_section')
@foreach($lot as $elem)
<p><b>{{$elem->lot_name}}</b></p>
@foreach($picture as $pic)
<p><img src="{{asset('storage/lots_images/'.$pic->picture)}}" alt="Картинки отсутствуют" width="189" height="255"></p>
@endforeach
<p>@php echo nl2br($elem->lot_description) @endphp</p>
<p>{{$elem->price}}</p>
<p>{{$elem->count}}</p>
<p><i>{{$elem->created_at}}</i></p>
<p><a href="/cart/add/{{$elem->id}}">Добавить в корзину</a></p><br>

<div class="addreview__form">
    <form method="POST" action="/add_review/{{$elem->id}}">
        @csrf
        <div class="lotname__input">Название отзыва:<input type="text" name="title"></div>
        <div class="lottext__input"><textarea name="text"></textarea></div>
        <div class="submit__input"><input type="submit" name="submit"></div>
    </form>
</div>
@endforeach
@foreach($reviews as $review)
<p><b>{{$review->title}}</b></p>
<p><b><i>{{$review->login}}</b></i></p>
<p>{{$review->text}}</p>
<p><i>{{$review->created_at}}</i></p>
@endforeach
@endsection
@include('layout')