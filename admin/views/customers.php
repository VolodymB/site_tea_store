<div class="container">
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Імя</th>
      <th scope="col">Фамілія</th>
      <th scope="col">email</th>
      <th scope="col">Телефон</th>
      <th scope="col">Адреса</th>

    </tr>
  </thead>
  <tbody>
  <?= $i=1 ?>
  <?php foreach($data['customers'] as $customer): ?>
    <tr>
      <th scope="row"><?=$i++ ?></th>
      <td><?=$customer['name']?></td>
      <td><?=$customer['surname']?></td>
      <td><?=$customer['email']?></td>
      <td><?=$customer['telefone']?></td>
      <?php if(!empty($customer['adress'])){ ?>
      <td><?=$customer['adress']?></td>
      <?php }else{ ?>
      <td>Без адреси</td>
      <?php } ?>
      <td><a class="btn btn-success btn-sm rounded-0" href="/update_customer?id=<?=$customer['id']?>" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a></td>
      <td><a class="btn btn-danger btn-sm rounded-0" href="/delete_customer?id=<?=$customer['id']?>" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a></td>
      <?php endforeach; ?>      
    </tr>
  </tbody>
</table>
	
</div>