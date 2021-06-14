<!-- Основна інформація про товар:
- Назва, рік, опис товару
- одниця виміру, ціна, кількість
- визначити статус наяності товару (по замовчуванню при 0 не має)
- фото, зображення 
- категорія товару(мінімально 1 категорія)
 -->
<div class="container">
  <form action="" method="POST" class="needs-validation" novalidate>
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
              <option value="1">В наявності</option>
              <option value="2">Товар відсутній</option>
              <option value="3">Під замовлення</option>              
          </select>
          <div class="invalid-feedback">Введіть статус</div>
        </div>
        <div class="col-12">
          <label for="description" class="form-label">Опис товару</label>
          <textarea class="form-control" id="description" rows="5"></textarea>
        </div>
      </div>
    </div>
    <hr>
    <button class="w-100 btn btn-primary btn-lg" type="submit">Зберегти</button>
  </form>
</div>
