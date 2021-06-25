<?php
$unit=$data['unit'][0];
?>

<div class="container">
<!-- Форма початок -->

<!-- form -->
<form action="" method='POST'> 
        <input type="hidden" name='id' value='<?=(isset($unit['id']))?$unit['id']:''?>'>
        <div class="mb-3">
            <label for="" class="form-label">Назва</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Назва" value='<?=(isset($unit['name']))?$unit['name']:''?>'>
        </div>
    </div>
    <input type="submit"  name='save'>
    <!-- <button type="submit"  class="btn btn-primary" name='save'>Зберегти</button> -->
  <!-- form -->
</form>
<!-- форма кінець -->
</div>