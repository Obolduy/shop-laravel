<table border="1" width="100%" cellpadding="5">
   <tr>
    <th>Название лота</th>
    <th>Цена лота</th>
    <th>Количество</th>
    <th>Добавить в корзину</th>
   </tr>
   @foreach($lots as $elem)
   <tr>
    <td><a href="/catalog/{{$elem->category_id}}/{{$elem->subcategory_id}}/{{$elem->id}}">{{$elem->lot_name}}</a></td>
    <td>{{$elem->price}}</td>
    <td>{{$elem->count}}</td>
    <td><a href="/cart/add/{{$elem->id}}">Добавить в корзину</a></td>
   </tr>
  @endforeach
</table>