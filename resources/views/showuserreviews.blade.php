<table border="1" width="100%" cellpadding="5">
   <tr>
    <th>Название лота</th>
    <th>Заголовок отзыва</th>
    <th>Текст отзыва</th>
    <th>Дата создания</th>
   </tr>
   @foreach($reviews as $elem)
   <tr>
    <td><a href="/catalog/{{$elem->category_id}}/{{$elem->subcategory_id}}/{{$elem->id}}">{{$elem->lot_name}}</a></td>
    <td><b>{{$elem->title}}</b></td>
    <td>{{$elem->text}}</td>
    <td>{{$elem->created_at}}</td>
  </tr>
  @endforeach
</table>