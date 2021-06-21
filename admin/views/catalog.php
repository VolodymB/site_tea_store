<div class='container'>
<a class="btn btn-primary" href="/add_product" data-toggle="tooltip" data-placement="top" title="Додати товар">Додати <i class="fas fa-plus"></i></a>
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
    <?php $i=1; ?>
    <?php foreach($data['products'] as $product): ?>
    <tr>
      <th scope="row"><?=$i++?></th>
      <td><?=$product['name']?></td>
      <td><?=$product['year']?></td>
      <td><?=$product['status']?></td>
      <td>      
                <ul class="list-inline m-0"> 
                <li class="list-inline-item">
                <a class="btn btn-primary btn-sm rounded-0" href="/product?id=<?=$product['id']?>" data-toggle="tooltip" data-placement="top" title="Детальніше"><i class="fas fa-eye"></i></a>      
                      </li>
                      <li class="list-inline-item">
                      <a class="btn btn-success btn-sm rounded-0" href="/edit_product?id=<?=$product['id']?>" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                      </li>
                      <li class="list-inline-item">
                      <a class="btn btn-danger btn-sm rounded-0" href="/delete_product?id=<?=$product['id']?>" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                      </li>
                </ul>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>