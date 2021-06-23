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
<table>
<?php $i=1 ?>
<?php foreach($data['categories'] as $category): ?>
<tr>
<td><?=$i++?></td>
<td><?=$category['name']?></td>
<td><?=$category['parent_id']?></td>
<td><?=$category['sort_order']?></td>
</tr>
<?php endforeach; ?>

</table>
</div>