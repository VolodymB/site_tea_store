<div class="container">
    <p>Оберіть товар</p>
    <form action="/add_product_name?order_id=<?=$data['order_id']?>" method='POST' id='addName'>
    <input type="hidden" name='order_id' value='<?=$data['order_id']?>'>
    <tr>
        <td>
        <select class="form-select" id='update_products' name='name'> 
      <?php foreach($data['products'] as $product): ?>     
        <option value="<?=$product['id']?>"><?=$product['name'].', '.$product['year']?></option>
        <?php endforeach; ?>
        </select>
        </td>
        
    </tr>
    <td><button type="submit" form="addName" name='next' class="btn btn-primary btn-sm">Додати інформацію</button></td>
    </form>
</div>