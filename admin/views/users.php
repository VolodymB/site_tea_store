<?php  
$users=$data['users'];
?>
<div class="container">
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Імя</th>
      <th scope="col">Фамілія</th>
      <th scope="col">Електронна пошта</th>
      <th scope="col">Login</th>
      <th scope="col">Роль</th>
    </tr>
  </thead>
  <tbody>
  <?=$i=1?>
  <?php foreach($users as $user): ?>    
    <tr>
      <th scope="row"><?=$i++?></th>
      <td><?=$user['name']?></td>
      <td><?=$user['surname']?></td>
      <td><?=$user['email']?></td>
      <td><?=$user['login']?></td>         
      <td><?=(!empty($user['role_name']))?$user['role_name']:''?></td>       
      <?php endforeach; ?>
    </tr>
  </tbody>
</table>
</div>