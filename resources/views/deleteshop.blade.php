@section('main_section')
<form method="POST">
    @csrf
    <p>Название магазина: <input type="password" name="password"></p>
    <p><input type="submit" name="submit"></p>
</form>
@endsection
@include('layout')