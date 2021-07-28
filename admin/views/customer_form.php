
<?php
$customer=$data['customer'];
?>
<div class="container">
    <form action="" method='POST'>
    <div class="mb-3">
  <label for="id" class="form-label"></label>
  <input type="hidden" class="form-control" id="id" placeholder="id" name='id' value="<?=($customer['id'])?$customer['id']:''?>">
  <input type="hidden" class="form-control" id="user_id" placeholder="user_id" name='user_id' value="<?=($customer['user_id'])?$customer['user_id']:''?>">
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
    <input type="text" class="form-control" placeholder="phone" aria-label="phone" name='phone' value="<?=($customer['telephone'])?$customer['telephone']:''?>">
  </div>
</div>
<br>

  
<br>
<input type="submit" class="btn btn-primary" name="save" value="Зберегти"></a>
    </form>
</div>