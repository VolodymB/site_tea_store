<?php
$category=$data['category'][0];
?>

<div class="container">
<!-- Форма початок -->

<!-- form -->
<form action="" method='POST'> 
        <input type="hidden" name='id' value='<?=(isset($category['id']))?$category['id']:''?>'>
        <div class="mb-3">
            <label for="" class="form-label">Назва</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Назва" value='<?=(isset($category['name']))?$category['name']:''?>'>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Категорії</label>
            <select id="parent_name" name='parent_name' class="form-select">
            <?php foreach($data['categories'] as $parent_category): ?>
                <option value="<?=$parent_category['id']?>"<?=$parent_category['name']?><?=($category['id']==$parent_category['id'])?'selected':false?>><?=$parent_category['name']?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Показник сортування</label>
            <input type="number" id="sort_order" name="sort_order" class="form-control" placeholder="Сортування" min=0 value='<?=(isset($category['sort_order']))?$category['sort_order']:''?>'>
        </div>
    </div>
    <input type="submit"  name='save' value="Продовжти" class="btn btn-primary">
    <!-- <button type="submit"  class="btn btn-primary" name='save'>Зберегти</button> -->
  <!-- form -->
</form>
<!-- форма кінець -->
</div>