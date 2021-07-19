<div class="container">
<form action="/edit_product_order?product_id=<?=$data['product_id']?>&order_id=<?=$data['order_id']?>" id="update_products" method="POST">
<input type="hidden" name='order_id' value="<?=$data['order_id']?>">
<input type="hidden" name='product_id' value="<?=$data['product_id']?>">
<table class="table">
  <thead>
    <tr>
      <th scope="col">Назва</th>
      <th scope="col">Кількість</th>
      <th scope="col">Одиниця виміру, ціна </th>
      <th scope="col">Сумма, грн</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><?=$data['info']['name']?></td>
      <td>
      <input type="number" name='quantity' value='<?=(isset($data['info']['quantity']))?$data['info']['quantity']:''?>' min='1'  max="<?=$data['info']['total_quantity']?>">
      </td>
      <td>
      <select class="form-select" id='update_products' name='unit'> 
      <?php foreach($data['product_units'] as $unit): ?>     
        <option value="<?=$unit['unit_id']?>" <?=($data['info']['unit_id']==$unit['unit_id'])?'selected':''?>><?=$unit['unit_name'].', '.$unit['price']?></option>
        <?php endforeach; ?>
        </select>        
      </td>
      <input type="hidden" name="price" value='<?=$unit['price']?>'>
      <td><input type="text" name='total' value="<?=$data['total']?>"></td>
      <td><button type="submit" form="update_products" name='update' class="btn btn-primary btn-sm">Оновити</button></td>
    </tr>        
  </tbody>
</table>
<input type="submit" name='save' value='Зберегти' class="btn btn-primary btn-sm">
</form>
<a href="/order?id=<?=$data['order_id']?>"  class="btn btn-primary btn-sm">Повернутись до попереднього меню</a>
</div>