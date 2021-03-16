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
<div class="completelot__form"><form enctype="multipart/form-data" method="POST">
    @csrf
    <div class="lotname__input">Название товара: <input type="text" name="lot_name"></div>
    <div class="lotdesc__input">Описание товара: <textarea name="lot_description"></textarea></div>
    <div class="lotprice__input">Цена: <input type="text" name="price"></div>
    <div class="lotpic__input">Изображения товара: <input type="file" accept="image/*" name="photo[]" multiple></div>
    <div class="lotcount__input">Количество товара: <input type="text" name="count"></div>
    <div class="submit__input"><input type="submit" name="submit" value="Опубликовать"></div>
</form>
</div>
    
@endsection
@include('layout')