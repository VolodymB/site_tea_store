<div class="container">
<h1>Одниця виміру</h1>
<!-- table begin -->

<hr>
<a class="btn btn-primary" href="/add_unit" data-toggle="tooltip" data-placement="top" title="Додати одиницю виміру">Додати <i class="fas fa-plus"></i></a>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Назва</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1 ?>
    <?php foreach($data['units'] as $unit): ?>
    <tr>
      <th scope="row"><?=$i++?></th>
        <td><?=$unit['name']?></td>
        <td>
<ul class="list-inline m-0">
                      <li class="list-inline-item">
                      <a class="btn btn-success btn-sm rounded-0" href="/update_unit?id=<?=$unit['id']?>" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                      </li>
                      <li class="list-inline-item">
                      <a class="btn btn-danger btn-sm rounded-0" href="/delete_unit?id=<?=$unit['id']?>" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                      </li>
                </ul>
</td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<!-- table end -->
</div>