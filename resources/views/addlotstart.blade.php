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
<form method="POST">
    @csrf
    <p>Категория: <select name="category">@foreach ($categories as $category) <option value="{{$category->id}}">{{$category->category}}</option>@endforeach</select></p>
    <p><input type="submit" name="submit" value="Дальше"></p>
</form>
@endsection
@include('layout')