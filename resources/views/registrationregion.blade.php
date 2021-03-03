@section('main_section')
<form method="POST">
    @csrf
    <p>Регион: <select name="state">@foreach ($regions as $region) <option value="{{$region->id}}">{{$region->region_name}}</option>@endforeach</select></p>
    <p><input type="submit" name="submit"></p>
</form>
@endsection
@include('layout')