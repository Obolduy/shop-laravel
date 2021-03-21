@section('main_section')
<table>
    <tr>
      <th>Название магазина</th>
      <th>Дата создания</th>
    </tr>
    @foreach($shops as $shop)
    <tr>
        <td><a href="/admin/change/shop/{{ $shop->id }}">{{ $shop->shop_name }}</a></td>
        <td>{{ $shop->created_at }}</td>
      </tr>
    @endforeach
</table>
@endsection
@include('layout')