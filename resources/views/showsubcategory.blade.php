@section('main_section')
@foreach($subcategory as $elem)
<p><a href="/catalog/{{ $elem->category_id }}/{{ $elem->id }}">{{ $elem->subcategory }}</a></p>
@endforeach
@endsection
@include('layout')