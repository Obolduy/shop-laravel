@section('main_section')
Новые товары:
@foreach($lots as $lot)
<p><a href="/catalog/{{ $lot->category_id }}/{{ $lot->subcategory_id }}/{{ $lot->id }}">{{ $lot->lot_name }}</a></p>
@endforeach
<p><a href="/catalog/all">Открыть весь каталог</a></p>
@endsection
@include('layout')