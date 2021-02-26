@section('main_section')
<table>
    <colgroup>
      <col span="2" style="background:Khaki">
      <col style="background-color:rgb(74, 194, 74)">
    </colgroup>
    <tr>
      <th>Заголовок комментария</th>
      <th>Название товара</th>
      <th>Название магазина</th>
      <th>Логин автора</th>
      <th>Дата создания</th>
    </tr>
    @foreach($reviews as $review)
    <tr>
        <td><a href="/admin/change/review/{{ $review->id }}">{{ $review->title }}</a></td>
        <td><a href="/catalog/{{ $review->category_id }}/{{ $review->subcategory_id }}/{{ $review->lot_id }}">{{ $review->lot_name }}</a></td>
        <td>{{ $review->shop_name }}</td>
        <td>{{ $review->login }}</td>
        <td>{{ $review->created_at }}</td>
      </tr>
    @endforeach
</table>
@endsection
@include('layout')