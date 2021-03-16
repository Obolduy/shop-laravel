@section('main_section')
<form method="POST">
    @csrf
    <div class="regin__input">Регион: <select name="state">@foreach ($regions as $region) <option value="{{$region->id}}">{{$region->region_name}}</option>@endforeach</select></div>
    <div class="submit__input"><input type="submit" name="submit"></div>
</form>
@endsection
@include('layout')