<div class="container">
<h1>Категорії</h1>
<!-- Форма початок -->
<form action="" method='POST'>
<input type="hidden" name='id'>
<input type="text" name='name' placeholder='name'>Назва
<select name="parent_id" >
<?php foreach($data['categories'] as $parent_category): ?>
<option value="<?=$parent_category['id']?>"><?=$parent_category['name']?></option>
<?php endforeach; ?>
</select>
<input type="number" name='sort_order'>
<input type="submit" name='send'>
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