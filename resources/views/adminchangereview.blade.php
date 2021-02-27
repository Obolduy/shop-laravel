@section('main_section')
@foreach($review as $elem)
<form method="POST">
    @csrf
    <p>Название: <input type="text" name="title" value="{{$elem->title}}"></p>
    <p>Описание: <textarea name="text">{{$elem->text}}</textarea></p>
    <p><input type="submit" name="submit"></p>
</form>
<p><a href="/admin/delete/review/{{$elem->id}}">Удалить обзор</a></p>
@endforeach
@endsection
@include('layout')