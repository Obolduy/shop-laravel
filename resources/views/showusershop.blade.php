<table border="1" width="100%" cellpadding="5">
   <tr>
    <th>Название лота</th>
    <th>Цена лота</th>
    <th>Количество</th>
   </tr>
   @foreach($shop as $elem)
   <tr>
    <td><a href="/catalog/{{$elem->category_id}}/{{$elem->subcategory_id}}/{{$elem->id}}">{{$elem->lot_name}}</a></td>
    <td>{{$elem->price}}</td>
    <td>{{$elem->count}}</td>
   </tr>
  @endforeach
</table>
<!--<p><a href="/myshop/change">Изменить</a></p>-->