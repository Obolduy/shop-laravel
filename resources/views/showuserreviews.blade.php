<table border="1" width="100%" cellpadding="5">
   <tr>
    <th>Название лота</th>
    <th>Цена лота</th>
    <th>Количество</th>
    <th>Дата создания</th>
   </tr>
   @foreach($reviews a $elem)
   <tr>
    <td><a href="/catalog/{{$elem->category_id}}/{{$elem->subcategory_id}}/{{$elem->id}}">{{$elem->lot_name}}</a></td>
    <td><b>{{$elem->title}}</b></td>
    <td>{{$elem->text}}</td>
    <td>{{$elem->created_at}}</td>
  </tr>
  @endforeach
</table>
<p><a href="/myshop/{{$shop_name}}/change">Изменить</a></p>