@section('main_section')
<table>
    <colgroup>
      <col span="2" style="background:Khaki">
      <col style="background-color:rgb(74, 194, 74)">
    </colgroup>
    <tr>
      <th>Название товара</th>
      <th>Цена</th>
      <th>Количество</th>
      <th>Категория</th>
      <th>Подкатегория</th>
      <th>Название магазина</th>
      <th>Дата создания</th>
    </tr>
    @foreach($lots as $lot)
    <tr>
        <td><a href="/admin/change/lot/{{ $lot->id }}">{{ $lot->lot_name }}</a></td>
        <td>{{ $lot->price }}</td>
        <td>{{ $lot->count }}</td>
        <td>{{ $lot->category }}</td>
        <td>{{ $lot->subcategory }}</td>
        <td>{{ $lot->shop_name }}</td>
        <td>{{ $lot->created_at }}</td>
      </tr>
    @endforeach
</table>
@endsection
@include('layout')