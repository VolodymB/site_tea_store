<div class='container'>
<table class="table table-hover">
<thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Назва</th>
      <th scope="col">Рік</th>
      <th scope="col">Статус</th>
      <th scope="col">Дії</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($data['products'] as $product): ?>
    <tr>
      <th scope="row">1</th>
      <td><?=$product['name']?></td>
      <td><?=$product['year']?></td>
      <td><?=$product['status']?></td>
      <td>@mdo</td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>