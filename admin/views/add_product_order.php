<div class="container">
<form action="/add_product_order?id=<?=$data['order_id']?>&product_id=<?=$data['product_id']?>" id="update_products" method="POST">
<table class="table">
  <thead>
    <tr>
      <th scope="col">Назва</th>
      <th scope="col">Кількість</th>
      <th scope="col">Одиниця виміру, ціна(,грн) </th>      
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><?=$data['product'][0]['product_name'].', '.$data[0]['product']['year']?></td>
      <td><input type="number" name='quantity' value='<?=(isset($data['info']['quantity']))?$data['info']['quantity']:''?>' min='1'  max="<?=$data['info']['total_quantity']?>"></td>
      </td>
      <td>
      <select class="form-select" id='update_products' name='unit_id'> 
      <?php foreach($data['units'] as $unit): ?>     
        <option value="<?=$unit['unit_id']?>" ><?=$unit['unit_name'].', '.$unit['price']?></option>
        <?php endforeach; ?>
        </select>        
      </td>
    </tr>        
  </tbody>
</table>
<input type="submit" name='save' value='Зберегти' class="btn btn-primary btn-sm">
</form>
<a href="/order?id=<?=$data['order_id']?>"  class="btn btn-primary btn-sm">Повернутись до попереднього меню</a>
</div>