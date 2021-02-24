@section('main_section')
@foreach($lots as $lot)
<p><a href="/catalog/{{ $lot->category_id }}/{{ $lot->subcategory_id }}/{{ $lot->id }}">{{ $lot->lot_name }}</a></p>
@endforeach
@endsection
@include('layout')