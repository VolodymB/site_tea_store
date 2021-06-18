<?php 
$product=$data['product'];
?>
<!-- Основна інформація про товар:
- Назва, рік, опис товару
- одниця виміру, ціна, кількість
- визначити статус наяності товару (по замовчуванню при 0 не має)
- фото, зображення 
- категорія товару(мінімально 1 категорія)
 -->
<div class="container">
  <form action="<?=$data['action']?>" method="POST" class="needs-validation" novalidate>
    <div class="row g-3" >
      <div class="col-sm-8">
        <label for="name" class="form-label">Назва товару</label>
        <div class="input-group has-validation">
          <input
            type="text" class="form-control" id="name" name='name' required minlength=3 value='<?=(isset($product['product_name']))?$product['product_name']:''?>'/>
          <div class="invalid-feedback">Введіть назву</div>
        </div>
        </div>
        <div class="col-sm-4">
        <label for="year" class="form-label">Рік</label>
        <div class="input-group has-validation">
          <input
            type="number" class="form-control" id="year" name='year' required min='1980' value='<?=(isset($product['year']))?$product['year']:''?>'/>
          <div class="invalid-feedback">Введіть рік</div>
          </div>
        </div>
        <div class="col-12">
        <label for="status" class="form-label">Наявність</label>
        <div class="input-group has-validation">         
          <select name="status" id="status" class="form-select"> 
              <?php foreach($data['status'] as $item_status): ?>      
              <option value="<?=$item_status['id']?>" <?=($product['status_id']==$item_status['id'])?'selected':false?>><?=$item_status['name']?></option>                     
              <?php endforeach; ?>
          </select>          
          <div class="invalid-feedback">Введіть статус</div>
        </div>
        </div>
        <div class="col-12">
          <label for="description" class="form-label">Опис товару</label>
          <textarea class="form-control" name='description' id="description" rows="5" ><?=(isset($product['description']))?$product['description']:''?></textarea>
        </div>
    
    <!-- початок одниця виміру з ціною -->
    <?php $row=0 ?>
    <?php if(isset($product['units'])): ?>
    <?php foreach($product['units'] as $unit): ?>
    <div class="col-sm-5">
        <label for="unit" class="form-label">Одиниця виміру</label>
        <div class="input-group has-validation">
          <select name="units[<?=$row?>][id]" id="unit" class="form-select">
              <?php foreach($data['units'] as $item_unit): ?>
              <option value="<?=$item_unit['id']?>" <?=($unit['unit_id']==$item_unit['id'])?'selected':false?>><?=$item_unit['name']?></option>
              <?php endforeach; ?>             
          </select>
          <div class="invalid-feedback">Оберіть одиницю виміру</div>
        </div>
        </div>
        <div class="col-sm-4">
          <label for="price" class="form-label">Вартість</label>
          <div class="input-group has-validation">
            <input type="number" class="form-control" id="price" name='units[<?=$row?>][price]' min='0' step='0.50' value='<?=(isset($unit['price']))?$unit['price']:''?>'/> грн
            <div class="invalid-feedback">Введіть ціну</div>
          </div>
        </div>
        <div class="col-sm-3">
          <label for="quantity" class="form-label">Кількість</label>
          <div class="input-group has-validation">
            <input type="number" class="form-control" id="quantity" name='units[<?=$row?>][quantity]' min='0' value='<?=(isset($unit['quantity']))?$unit['quantity']:''?>'/> 
            <div class="invalid-feedback">Введіть кількість</div>
          </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
        <!-- кінець одиниця виміру з ціною -->
    <br>
    <p>Оберіть категорію</p>
    <?php foreach($data['categories'] as $category): ?>
    <div class="form-check">
  <input class="form-check-input" name='categories[]' type="checkbox" value="<?=$category['id']?>" id='<?=$category['id']?>' <?=(in_array($category['id'],$product['categories_id']))?'checked':false?> >
  <label class="form-check-label" for="<?=$category['id']?>">
  <?=$category['name'] ?>
  </label>
</div>                           
    <?php endforeach ?>
    <hr>
    <input class="w-100 btn btn-primary btn-lg" name='save' type="submit" value='Зберегти'>
  </form>
</div>
