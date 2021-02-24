@section('main_section')
@foreach($categories as $category)
<p><a href="/catalog/{{ $category->id }}">{{ $category->category }}</a></p>
@endforeach
@endsection
@include('layout')