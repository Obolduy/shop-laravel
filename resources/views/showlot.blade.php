@section('main_section')
@foreach($lot as $elem)
<p>{{$elem->lot_name}}</p>
<p>{{$elem->lot_description}}</p>
<p>{{$elem->price}}</p>
<p>{{$elem->count}}</p>
<p>{{$elem->created_at}}</p><br>
@endforeach
<p>Тут место для комментариев:</p>
@foreach($reviews as $review)
<p>{{$elem->title}}</p>
<p>{{$elem->text}}</p>
<p>{{$elem->created_at}}</p>
<p>{{$elem->login}}</p>
@endforeach
@endsection
@include('layout')