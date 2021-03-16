@section('main_section')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="addlot__start">
    <form method="POST">
        @csrf
        <div class="subcategory__input">Категория: <select name="category">@foreach ($categories as $category) <option value="{{$category->id}}">{{$category->category}}</option>@endforeach</select></div>
        <div class="submit__input"><input type="submit" name="submit" value="Дальше"></div>
    </form>
</div>
@endsection
@include('layout')