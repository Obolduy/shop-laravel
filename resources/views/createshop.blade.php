@section('main_section')
<form method="POST">
    @csrf
    <p>Название товара: <input type="text" name="title"></p>
    <p>Количество товара: <textarea name="description"></textarea></p>
    <p><input type="submit" name="submit"></p>
</form>
@endsection
@include('layout')