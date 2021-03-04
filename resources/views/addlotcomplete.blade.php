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
<form enctype="multipart/form-data" method="POST">
    @csrf
    <p>Название товара: <input type="text" name="lot_name"></p>
    <p>Описание товара: <textarea name="lot_description"></textarea></p>
    <p>Цена: <input type="text" name="price"></p>
    <p>Изображения товара: <input type="file" accept="image/*" name="photo[]" multiple></p>
    <p>Количество товара: <input type="text" name="count"></p>
    <p><input type="submit" name="submit" value="Опубликовать"></p>
</form>
@endsection
@include('layout')