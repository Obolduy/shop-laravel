@section('main_section')
<table>

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