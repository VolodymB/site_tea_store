
<?php
$customer=$data['customer'][0];
?>
<div class="container">
    <form action="" method='POST'>
    <div class="mb-3">
  <label for="id" class="form-label"></label>
  <input type="hidden" class="form-control" id="id" placeholder="id" name='id' value="<?=($customer['id'])?$customer['id']:''?>">
</div>
    <br>
    <div class="row">
  <div class="col">
  <select class="form-select" aria-label="Default select example" name='delivery' >
  <?php foreach($data['delivery'] as $delivery): ?>
  <option value="<?=$delivery['id']?>" <?=($customer['delivery_id']==$delivery['id'])?'selected':false?>> <?=$delivery['name']?></option>
  <?php endforeach; ?>
</select>
  </div>
  <div class="col">
  <select class="form-select" aria-label="Default select example" name='payment'>
  <?php foreach($data['payment'] as $payment): ?>
  <option value="<?=$payment['id']?>" <?=($customer['payment _id']==$payment['id'])?'selected':false?>> <?=$delivery['name']?><?=$payment['name']?></option>
  <?php endforeach; ?>
</select>
  </div>
</div>
    <br>
    <div class="row">
  <div class="col">
    <input type="text" class="form-control" placeholder="name" aria-label="name" name='name' value="<?=($customer['name'])?$customer['name']:''?>">
  </div>
  <div class="col">
    <input type="text" class="form-control" placeholder="surname" aria-label="surname" name='surname' value="<?=($customer['surname'])?$customer['surname']:''?>">
  </div>
</div>
<br>
<div class="row">
  <div class="col">
    <input type="text" class="form-control" placeholder="email" aria-label="email" name='email' value="<?=($customer['email'])?$customer['email']:''?>">
  </div>
  <div class="col">
    <input type="text" class="form-control" placeholder="phone" aria-label="phone" name='phone' value="<?=($customer['telefone'])?$customer['telefone']:''?>">
  </div>
</div>
<br>
<div class="row">
  <div class="col">
  <select class="form-select" aria-label="Default select example" name='city'>
  <?php foreach($data['city'] as $city): ?>
  <option value="<?=$city['id']?>" <?=($customer['city_id']==$city['id'])?'selected':false?>><?=$city['name']?></option>
  <?php endforeach; ?>
</select>
  </div>
  <div class="col">
    <input type="text" class="form-control" placeholder="addres" aria-label="addres" name='addres' value="<?=($customer['adress'])?$customer['adress']:''?>">
  </div>
</div>
<br>
<input type="submit" class="btn btn-primary" name="save" value="Зберегти"></a>
    </form>
</div>