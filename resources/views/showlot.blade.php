@section('main_section')
@foreach($lot as $elem)
<p>{{$elem->lot_name}}</p>
<p>{{$elem->lot_description}}</p>
<p>{{$elem->price}}</p>
<p>{{$elem->count}}</p>
<p>{{$elem->created_at}}</p>
@endforeach
@endsection
@include('layout')