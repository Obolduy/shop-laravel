@section('main_section')
<div class="lot__page">
    <div class="show__lot">
        @foreach($lot as $elem)
        <div class="lot__name">
            <b>{{$elem->lot_name}}</b>
        </div>
        <div class="picture_img">
        @foreach($picture as $pic)
            <a href="{{asset('storage/lots_images/'.$pic->picture)}}"><img src="{{asset('storage/lots_images/'.$pic->picture)}}" alt="Картинки отсутствуют"></a>
        @endforeach
        </div>
        <div class="lot__desc">
            @php echo nl2br($elem->lot_description) @endphp
        </div>
        <div class="lot__price">
            <b>Цена:</b> {{$elem->price}}₽
        </div>
        <div class="lot__count">
            <b>Осталось:</b> {{$elem->count}} шт.
        </div>
        <div class="lot__createdat">
            <b>Добавлено:</b> <i>{{$elem->created_at}}</i>
        </div>
    </div>
    <div class="lot__addtocart">
        <a href="/cart/add/{{$elem->id}}">Добавить в корзину</a>
    </div>
    <br>
    <div class="addreview__form">
        <form method="POST" action="/add_review/{{$elem->id}}">
            @csrf
            <div class="lotname__input">
                <b>Название отзыва:</b> <input type="text" name="title" placeholder="Введите название отзыва">
            </div>
            <div class="lottext__input">
                <textarea name="text" placeholder="Содержание отзыва"></textarea>
            </div>
            <div class="submit__input">
                <input type="submit" name="submit">
            </div>
        </form>
    </div>
    @endforeach
    <b>Отзывы:</b>
    <div class="reviews">
        @foreach($reviews as $review)
        <div class="review">
            <div class="review__name">
                <div>Заголовок:</div>
                <b>{{$review->title}}</b>
            </div>
            <div class="review__login">
                Логин: <b><i>{{$review->login}}</b></i>
            </div>
            <div class="review__text">
                {{$review->text}}
            </div>
            <div class="review__createdat">
                <i>{{$review->created_at}}</i>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
@include('layout')