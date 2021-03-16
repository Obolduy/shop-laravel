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
<div class="addlot__cont">
    <form method="POST">
        @csrf
        <div class="subcategory__input">Подкатегория: <select name="subcategory">@foreach ($subcategories as $subcategory) <option value="{{$subcategory->id}}">{{$subcategory->subcategory}}</option>@endforeach</select></div>
        <div class="submit__input"><input type="submit" name="submit" value="Еще дальше"></div>
    </form>
</div>
@endsection
@include('layout')