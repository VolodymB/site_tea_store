
<div class="container">
<div class="card" >
  <img src="..." class="card-img-top" alt="...">
  <div class="card-body">
  <tr>
<ul class="list-inline m-0">
                      <li class="list-inline-item">
                      <a class="btn btn-success btn-sm rounded-0" href="/edit_product?id=<?=$data['product']['product_id']?>" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                      </li>
                      <li class="list-inline-item">
                      <a class="btn btn-danger btn-sm rounded-0" href="/delete_product?id=<?=$data['product']['product_id']?>" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                      </li>
                </ul>
</tr>
    <h2 class="card-title"><?=$data['product']['product_name'].', '.$data['product']['year'].'-'.'наявність'.'-'.$data['product']['status']?></h2>
    <hr>
    <!-- Категорії Товару -->
    <p>Категорії товару</p>
    <ul>
    <?php foreach($data['product']['categories'] as $category): ?>
    <!-- створити посилання на фільтр?  -->
    <li><?=$category['name']?></li>
    <?php endforeach; ?>
    </ul>
    <!-- опис товару -->
    <?php if($data['product']['description']){?>
        <p class="card-text"><?=$data['product']['description']?></p>
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
    <?php foreach($data['product']['units'] as $unit): ?>
  <tr>
  <td><?=$unit['unit_name']?></td>
  <td><?=$unit['price']?></td>
  <td><?=$unit['quantity']?></td>
  </tr>
  <?php endforeach; ?>
  </tbody>
</table>
    <!--коментарі для товару  -->
    <?php if(!empty($data['product']['comments'])){ ?>   
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
  <?php foreach($data['product']['comments'] as $comment):?>  
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