<div class="container">
<h1>Замовлення</h1>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Дата створення</th>
      <th scope="col">Імя, Фамілія</th>
      <th scope="col">Статус</th>
      <th scope="col">Тип оплати</th>
      <th scope="col">Тип доставки</th>
      <th scope="col">Загальна сумма, грн</th>      
      <th scope="col">Телефон</th>     
    </tr>
  </thead>
  <tbody>
  <?php $i=1?>
  <?php foreach($data['orders'] as $order): ?>
    <tr>
      <th scope="row"><?=$i++?></th>
      <td><?=$order['date_add']?></td>
      <td><?=$order['custom_name']?></td>
      <td><?=$order['status']?></td>
      <td><?=$order['payment']?></td>
      <td><?=$order['delivery']?></td>
      <td><?=$order['total_sum']?></td>
      <td><?=$order['telephone']?></td> 
      <td>
      <ul class="list-inline m-0"> 
                <li class="list-inline-item">
                <a class="btn btn-primary btn-sm rounded-0" href="/order?id=<?=$order['order_id']?>" data-toggle="tooltip" data-placement="top" title="Детальніше"><i class="fas fa-eye"></i></a>      
                      </li>                      
                </ul>
      </td>    
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>