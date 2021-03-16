@section('main_section')
@foreach($review as $elem)
<div class="adminchangereview">
    <form method="POST">
        @csrf
        <div class="reviewname__input">Название: <input type="text" name="title" value="{{$elem->title}}"></div>
        <div class="reviewdesc__input">Описание: <textarea name="text">{{$elem->text}}</textarea></div>
        <div class="submit__input"><input type="submit" name="submit"></div>
    </form>
    <div><a href="/admin/delete/review/{{$elem->id}}">Удалить обзор</a></div>
</div>
@endforeach
@endsection
@include('layout')