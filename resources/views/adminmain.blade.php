@section('main_section')
<div class="admin__main">
    <div><a href="/admin/users">Список пользователей</a></div>
    <div><a href="/admin/shops">Список магазинов</a></div>
    <div><a href="/admin/lots">Список товаров</a></div>
    <div><a href="/admin/reviews">Список отзывов</a></div>
</div>
<div class="go__to__main"><a href="/">На главную</a></div>
@endsection
@include('layout')