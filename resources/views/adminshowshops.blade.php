@section('main_section')
<table>
    <colgroup>
      <col span="2" style="background:Khaki">
      <col style="background-color:rgb(74, 194, 74)">
    </colgroup>
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