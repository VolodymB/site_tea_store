<div class="container">
<h1>Категорії</h1>
<!-- Форма початок -->

<!-- form -->
<form action="" method='POST'>
<input type="hidden" name='id'>   
        <div class="mb-3">
            <label for="" class="form-label">Назва</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Назва">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Категорії</label>
            <select id="parent_name" name='parent_name' class="form-select">
            <?php foreach($data['categories'] as $parent_category): ?>
                <option value="<?=$parent_category['id']?>"><?=$parent_category['name']?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Назва</label>
            <input type="number" id="sort_order" name="sort_order" class="form-control" placeholder="Сортування" min=0>
        </div>
    </div>
    <button type="submit" class="btn btn-primary" name='send'>Зберегти</button>
  <!-- form -->
</form>
<!-- форма кінець -->
<!-- table begin -->
<hr>
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
                      <a class="btn btn-success btn-sm rounded-0" href="/edit_category?id=<?=$category['id']?>" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
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