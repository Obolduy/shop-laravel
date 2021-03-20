@section('main_section')
<div class="createshop__form">
    <form method="POST">
        @csrf
        <div class="shopname__input">Название магазина: <input type="text" name="shop_name"></div>
        <div class="shopdesc__input">Описание магазина: <textarea name="shop_description"></textarea></div>
        <div class="submit__input"><input type="submit" name="submit" value="Далее"></div>
    </form>
</div>
@endsection
@include('layout')