<div class="container">
<div class="card" >
  <img src="..." class="card-img-top" alt="...">
  <div class="card-body">
    <h2 class="card-title"><?=$data['product'][0]['product_name'].', '.$data['product'][0]['year'].'-'.'наявність'.'-'.$data['product'][0]['status']?></h2>
    <hr>
    <!-- Категорії Товару -->
    <p>Категорії товару</p>
    <ul>
    <?php foreach($data['category'] as $category): ?>
    <!-- створити посилання на фільтр?  -->
    <li><?=$category['name']?></li>
    <?php endforeach; ?>
    </ul>
    <!-- опис товару -->
    <?php if($data['product'][0]['description']){?>
        <p class="card-text"><?=$data['product'][0]['description']?></p>
    <?php }else{ ?>
        <p class="card-text">Не має опису товару</p>
    <?php } ?>
    <!-- Одниця виміру -->
    <table class="table">
  <thead>
    <tr>
      <th scope="col">Одиниця виміру</th>
      <th scope="col">Ціна, грн</th>
      <th scope="col">Кількість</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($data['unit'] as $unit): ?>
  <tr>
  <td><?=$unit['unit_name']?></td>
  <td><?=$unit['price']?></td>
  <td><?=$unit['quantity']?></td>
  </tr>
  <?php endforeach; ?>
  </tbody>
</table>
    <!--коментарі для товару  -->
    <?php if(!empty($data['comments'])){ ?>   
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Імя</th>
      <th scope="col">Коментар</th>
      <th scope="col">Рейтинг</th>
    </tr>
  </thead>
  <tbody>
  <?php $i=1 ?>
  <?php foreach($data['comments'] as $comment):?>  
    <tr>
      <th scope="row"><?=$i++?></th>
      <td><?=$comment['name']?></td>
      <td><?=$comment['comment']?></td>
      <td><?=$comment['raiting']?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
    <?php }else{ ?>
        <p>Не має коментарів</p>
        <?php } ?>
    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
  </div>
</div>
</div>