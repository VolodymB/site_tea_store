<!-- Основна інформація про товар:
- Назва, рік, опис товару
- одниця виміру, ціна, кількість
- визначити статус наяності товару (по замовчуванню при 0 не має)
- фото, зображення 
- категорія товару(мінімально 1 категорія)
 -->
<div class="container">
  <form action="/add_product" method="POST" class="needs-validation" novalidate>
    <div class="row g-3" >
      <div class="col-sm-8">
        <label for="name" class="form-label">Назва товару</label>
        <div class="input-group has-validation">
          <input
            type="text" class="form-control" id="name" name='name' required minlength=3/>
          <div class="invalid-feedback">Введіть назву</div>
        </div>
        </div>
        <div class="col-sm-4">
        <label for="year" class="form-label">Рік</label>
        <div class="input-group has-validation">
          <input
            type="number" class="form-control" id="year" name='year' required min='1980'/>
          <div class="invalid-feedback">Введіть рік</div>
          </div>
        </div>
        <div class="col-12">
        <label for="status" class="form-label">Наявність</label>
        <div class="input-group has-validation">         
          <select name="status" id="status" class="form-select"> 
              <?php foreach($data['status'] as $item_status): ?>      
              <option value="<?=$item_status['id']?>"><?=$item_status['name']?></option>                     
              <?php endforeach; ?>
          </select>          
          <div class="invalid-feedback">Введіть статус</div>
        </div>
        </div>
        <div class="col-12">
          <label for="description" class="form-label">Опис товару</label>
          <textarea class="form-control" name='description' id="description" rows="5"></textarea>
        </div>
    </div>
    <br>
    <!-- початок одниця виміру з ціною -->
    <?php $row=0 ?>
    <div class="col-sm-5">
        <label for="unit" class="form-label">Одиниця виміру</label>
        <div class="input-group has-validation">
          <select name="units[<?=$row?>][id]" id="unit" class="form-select">
              <?php foreach($data['units'] as $item_unit): ?>
              <option value="<?=$item_unit['id']?>"><?=$item_unit['name']?></option>
              <?php endforeach; ?>             
          </select>
          <div class="invalid-feedback">Оберіть одиницю виміру</div>
        </div>
        </div>
        <div class="col-sm-4">
          <label for="price" class="form-label">Вартість</label>
          <div class="input-group has-validation">
            <input type="number" class="form-control" id="price" name='units[<?=$row?>][price]' min='0' step='0.50'/> грн
            <div class="invalid-feedback">Введіть ціну</div>
          </div>
        </div>
        <div class="col-sm-3">
          <label for="quantity" class="form-label">Кількість</label>
          <div class="input-group has-validation">
            <input type="number" class="form-control" id="quantity" name='units[<?=$row?>][quantity]' min='0' /> 
            <div class="invalid-feedback">Введіть кількість</div>
          </div>
        </div>
        <!-- кінець одиниця виміру з ціною -->
    <br>
    <p>Оберіть категорію</p>
    <?php foreach($data['categories'] as $category): ?>
    <div class="form-check">
  <input class="form-check-input" name='categories[]' type="checkbox" value="<?=$category['id']?>" id='<?=$category['id']?>'>
  <label class="form-check-label" for="<?=$category['id']?>">
  <?=$category['name'] ?>
  </label>
</div>                           
    <?php endforeach ?>
    <hr>
    <button class="w-100 btn btn-primary btn-lg" type="submit">Зберегти</button>
  </form>
</div>
