

<div class="container">
<!-- Номер замовлення, дата замовлення -->
<h1>№ <?=$data['order']['id'].' від ' .$data['order']['date_add']?></h1>
<!-- кнопка для збереження -->
   <div class="row">
        <div class="call-md-12">
            <div class="call-mb-8">
                <!-- кнопка для запису -->
                <!-- Таблиця з даними по покупцю -->
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Імя</th>
                        <th scope="col">Пошта</th>
                        <th scope="col">Телефон</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">1</th>
                        <td><?=$data['order']['customer']['name'].' '.$data['order']['customer']['surname']?></td>
                        <td><?=$data['order']['customer']['email']?></td>
                        <td><?=$data['order']['customer']['telephone']?></td>
                        </tr>
                    </tbody>
                    </table>
            </div>
            <div class="call-mb-6"> 
                <!-- форма для статусу, оплати, доставки -->                
                <form action="/order_update" method='POST' id='order_form'>
                <!-- форма для статусу -->
                <input type="hidden" name='order_id' value="<?=$data['order']['id']?>">
                <p>Статус замовлення</p>
                <select class="form-select" name='status_order'>
                        <?php foreach($data['status_order'] as $order_status): ?>
                        <option value="<?=$order_status['id']?>" <?=($order_status['id']==$data['order']['status_id'])?'selected':''?>><?=$order_status['name']?></option>
                        <?php endforeach; ?>
                    </select>
                    <!-- форма для доставки -->
                    <p>Форма доставки</p>
                        <select class="form-select" name='delivery'>
                        <?php foreach($data['delivery'] as $order_delivery): ?>
                        <option value="<?=$order_delivery['id']?>" <?=($order_delivery['id']==$data['order']['delivery_id'])?'selected':''?>><?=$order_delivery['name']?></option>
                        <?php endforeach; ?>
                    </select>
                    <!-- форма для оплати -->
                    <p>Форма оплати</p>
                        <select class="form-select" name='payment'>
                        <?php foreach($data['payment'] as $order_payment): ?>
                        <option value="<?=$order_payment['id']?>" <?=($order_payment['id']==$data['order']['payment_id'])?'selected':''?>><?=$order_payment['name']?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" name='save' form='order_form' class="btn btn-primary btn-lg">Зберегти</button>
                    </form>
                    <!-- таблиця з товарами -->
                    <!-- загальна сумма -->
                    <h2>Загальна сумма: <?=$data['order']['total_sum']?> грн.</h2>
                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Назва</th>
                        <th scope="col">Кількість</th>
                        <th scope="col">Одиниця вииміру</th>
                        <th scope="col">Ціна</th>
                        <th scope="col">Сумма по товару</th>
                        </tr>                        
                    </thead>
                    <form action="/edit_product_order?order_id=<?=$data['order']['id']?>" method='POST' id="updateProductOrder">
                    <tbody>                           
                        <?php $i=1 ?>
                        <?php foreach($data['order']['products'] as $product): ?>
                        <tr>
                        <th scope="row"><?=$i++?></th>
                        <td><?=$product['name']?></td>
                        <td>
                        <input type="number" name='quantity' value='<?=(isset($product['quantity']))?$product['quantity']:''?>' min='1' ?>
                        </td>
                        <td><select class="form-select" id='update_products' name='unit_id'> 
                            <?php foreach($product['units'] as $unit): ?>     
                                <option value="<?=$unit['unit_id']?>" <?=($product['unit_id']==$unit['unit_id'])?'selected':''?>><?=$unit['unit_name'].', '.$unit['price']?></option>
                                <?php endforeach; ?>
                                </select>
                        </td>
                        <input type="hidden" name='product_id' value="<?=$product['product_id']?>"> 
                        <input type="hidden" name='old_unit_id' value='<?=$product['unit_id']?>'>
                        <td><?=$product['price']?></td>       
                        <td><?=$product['total']?></td>
                        <td><li class="list-inline-item">
                      <a class="btn btn-danger btn-sm rounded-0" href="/delete_product_order?product_id=<?=$product['product_id']?>&order_id=<?=$data['order']['id']?>&unit_id=<?=$unit['unit_id']?>" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                      </li></td>
                      <td><li class="list-inline-item">
                      <button class="btn btn-success btn-sm rounded-0" type="submit" name='updateProductOrder' form='updateProductOrder' data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>
                      </li></td>
                        <?php endforeach; ?>
                        </tr>
                        </form>
                        </tbody>
                    </table>
            </div>
            <a href="/add_product_name?order_id=<?=$data['order']['id']?>" class="btn btn-primary">Додати</a>  
            </div>
        </div>
   </div>
</div>