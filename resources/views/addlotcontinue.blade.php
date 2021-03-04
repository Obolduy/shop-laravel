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
    <p>Подкатегория: <select name="subcategory">@foreach ($subcategories as $subcategory) <option value="{{$subcategory->id}}">{{$subcategory->subcategory}}</option>@endforeach</select></p>
    <p><input type="submit" name="submit" value="Еще дальше"></p>
</form>
@endsection
@include('layout')