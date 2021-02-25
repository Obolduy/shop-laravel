@section('main_section')
<p>@if($message) {{$message}} @endif</p>
@if($lots)
@foreach($lots as $lot)
<p>{{$lot->lot_name}}</p>
<p>{{$lot->lot_price}}</p>
@endforeach
@endif
@endsection
@include('layout')