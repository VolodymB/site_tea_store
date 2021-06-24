<div class="container">
<h1>Категорії</h1>
<!-- table begin -->

<hr>
<a class="btn btn-primary" href="/add_category" data-toggle="tooltip" data-placement="top" title="Додати товар">Додати <i class="fas fa-plus"></i></a>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Назва</th>
      <th scope="col">Категорія</th>
      <th scope="col">Сортування</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1 ?>
    <?php foreach($data['categories'] as $category): ?>
    <tr>
      <th scope="row"><?=$i++?></th>
        <td><?=$category['name']?></td>
        <td><?=$category['parent_id']?></td>
        <td><?=$category['sort_order']?></td>
        <td>
<ul class="list-inline m-0">
                      <li class="list-inline-item">
                      <a class="btn btn-success btn-sm rounded-0" href="/update_category?id=<?=$category['id']?>" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                      </li>
                      <li class="list-inline-item">
                      <a class="btn btn-danger btn-sm rounded-0" href="/delete_category?id=<?=$category['id']?>" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                      </li>
                </ul>
</td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<!-- table end -->
</div>