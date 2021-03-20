@section('main_section')
<nav>
    <ul>
        @foreach($categories as $category)
        <li><a href="/catalog/{{ $category->id }}/">{{$category->category}}</a></li>
        @endforeach
        <div class="showall__cat">
            <a href="/catalog/all">Открыть весь каталог</a>
        </div>
    </ul>
</nav>
<div class="last-lots">
    <ul>
    @foreach($lots as $lot)
    <div><li><h2><a href="/catalog/{{ $lot->category_id }}/{{ $lot->subcategory_id }}/{{ $lot->id }}">{{ $lot->lot_name }}</a></h2></li></div>
    @endforeach
    </ul>
</div>
@endsection
@include('layout')