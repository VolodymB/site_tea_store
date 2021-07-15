

<div class="container">
<!-- Номер замовлення, дата замовлення -->
<h1><?=$data['order']['id'].', '.$data['order']['date_add']?></h1>
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
                <form action="" method='POST'>
                <!-- форма для статусу -->
                <p>Статус замовлення</p>
                <select class="form-select" name='status_order'>
                        <?php foreach($data['order']['status_order'] as $order_status): ?>
                        <option value="<?=$order_status['id']?>" <?=($order_status['id']==$data['order']['status_id'])?'selected':''?>><?=$order_status['name']?></option>
                        <?php endforeach; ?>
                    </select>
                    <!-- форма для доставки -->
                    <p>Форма доставки</p>
                        <select class="form-select" name='delivery'>
                        <?php foreach($data['order']['delivery'] as $order_delivery): ?>
                        <option value="<?=$order_delivery['id']?>" <?=($order_delivery['id']==$data['order']['delivery_id'])?'selected':''?>><?=$order_delivery['name']?></option>
                        <?php endforeach; ?>
                    </select>
                    <!-- форма для оплати -->
                    <p>Форма оплати</p>
                        <select class="form-select" name='payment'>
                        <?php foreach($data['order']['payment'] as $order_payment): ?>
                        <option value="<?=$order_payment['id']?>" <?=($order_payment['id']==$data['order']['payment_id'])?'selected':''?>><?=$order_delivery['name']?></option>
                        <?php endforeach; ?>
                    </select>
                    <!-- таблиця з товарами -->
                    <!-- загальна сумма -->
                    <h2>Загальна сумма: <?=$data['order']['products']['total_sum']?> грн.</h2>
                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Назва</th>
                        <th scope="col">Кількість</th>
                        <th scope="col">Одиниця вииміру</th>
                        <th scope="col">Сумма по товару</th>
                        </tr>                        
                    </thead>
                    <tbody>
                        <?php $i=1 ?>
                        <?php foreach($data['order']['total_sum'] as $unit_total): ?>
                            <?php foreach($data['order']['total_sum'] as $unit_total): ?>
                        <tr>
                        <th scope="row"><?=$i++?></th>
                        <td><?=$data['order']['product'][0]['product_name'].', '.$data['order']['product'][0]['year']?></td>
                        <td>Otto</td>
                        <td>@mdo</td>        
                        <td><?=$unit_total['total']?></td>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                        </tr>
                        </tbody>
                    </table>
            </div>
                </form>    
            </div>
        </div>
   </div>
</div>