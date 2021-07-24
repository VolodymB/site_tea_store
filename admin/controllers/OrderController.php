<?php 
require_once 'models/OrderAdmin.php';
require_once 'models/CustomerAdmin.php';
require_once 'models/ProductAdmin.php';
require_once 'models/StatusOrderAdmin.php';
require_once 'models/DeliveryAdmin.php';
require_once 'models/PaymentAdmin.php';
require_once 'models/UnitAdmin.php';

class OrderController extends Controller{

    public function index(){
        session_start();
 
        if(isset($_SESSION['user'])){
            $user_id=$_SESSION['user'];            
        }
        $data_page=array();
        $order=new OrderAdmin();
        $data_page['orders']=$order->getListOrders($user_id);
        // echo '<pre>';
        // var_dump($data_page['orders']);
        // echo '</pre>';
        // die;
        return $this->view->render('orders',$data_page);
    }

    public function view($data){
        $data_page=array();
        if(isset($data['id']) && !empty($data['id'])){
        $data_page['order']=$this->findOne($data['id']);
        
        // var_dump( $data_page['order']);
        // die;
        
        $status_order=new StatusOrderAdmin();
            $data_page['status_order']=$status_order->getList();

            $delivery=new DeliveryAdmin();
            $data_page['delivery']=$delivery->getList();
            
            $payment=new PaymentAdmin();
            $data_page['payment']=$payment->getList(); 
            // echo '<pre>';
            // var_dump($data_page['order']);
            // echo '</pre>';
            // die;       
    }
        return $this->view->render('order',$data_page);
    }

    private function findOne($order_id){ 
        /**
         * чи існує замовлення
         * інфо про замовдлення: таблиця Order
         * інфо прозамовлення: Customer
         * інформація про товар: product_order, product
         * інфо про оплату
         * про доставку
         * про місто
         * інфо про статус
         */     
        $order_info=array();
        $order=new OrderAdmin();
        if($order_info=$order->getOrder($order_id)){
            // array(9) { ["id"]=> int(18) ["customer_id"]=> int(44) ["date_add"]=> string(19) "2021-07-11 20:50:13" ["status_id"]=> int(5) ["worker_id"]=> NULL ["delivery_id"]=> int(3) ["payment_id"]=> int(2) ["city_id"]=> int(4) ["adress"]=> string(5) "hhhhh" }
            $customer=new CustomerAdmin();
            $order_info['customer']=$customer->getCustomer($order_info['customer_id']);
            // array(6) { ["id"]=> int(44) ["user_id"]=> int(1) ["name"]=> string(4) "Mark" ["surname"]=> string(4) "Solo" ["email"]=> string(14) "emar@gmail.com" ["telephone"]=> string(15) "555555555555555" }
            $product=new ProductAdmin();
            // загальна сумма замовлень
            $order_info['total_sum']=$product->getOrderTotalSum($order_info['id']);
            
            
            $products_order=$product->getProductsByOrderId($order_info['id']);
            foreach($products_order as $item){
                $product_item=new ProductAdmin();                
                // array(2) { [0]=> array(5) { ["order_id"]=> int(33) ["product_id"]=> int(5) ["price"]=> float(250) ["quantity"]=> int(2) ["unit_id"]=> int(3) } [1]=> array(5) { ["order_id"]=> int(33) ["product_id"]=> int(7) ["price"]=> float(450) ["quantity"]=> int(1) ["unit_id"]=> int(5) } }
                // array(5) { ["order_id"]=> int(33) ["product_id"]=> int(5) ["price"]=> float(250) ["quantity"]=> int(2) ["unit_id"]=> int(3) }
                
                // array(1) { [0]=> array(6) { ["product_id"]=> int(5) ["product_name"]=> string(15) "Лун Цзин" ["year"]=> int(2020) ["description"]=> NULL ["status"]=> string(34) "лише на замовлення" ["status_id"]=> int(3) } } array(1) { [0]=> array(6) { ["product_id"]=> int(7) ["product_name"]=> string(20) "Шен Пуер 2051" ["year"]=> int(2012) ["description"]=> NULL ["status"]=> string(21) "в наявності" ["status_id"]=> int(1) } }
                $product_info=$product_item->getItem($item['product_id']);
                $unit=new UnitAdmin();
                $unit_info=$unit->getUnitByUnitId($item['unit_id']);                
                $order_info['products'][]=array(
                    'product_id'=>$product_info[0]['product_id'],
                    'name'=>$product_info[0]['product_name'].', '.$product_info[0]['year'],
                    'quantity'=>$item['quantity'],
                    'unit_id'=>$unit_info[0]['id'],
                    'units'=>$product_item->getUnitsById($product_info[0]['product_id']),
                    'price'=>$item['price'],
                    'total'=>$item['quantity']*$item['price']
                );
            }
            

            
            // echo '<pre>';
            // var_dump($order_info);
            // echo '</pre>';
            // die;

            return $order_info;


            
        }     
    }

    
    
    public function update(){
        if(isset($_POST['order_id'])){
            $order=new OrderAdmin();
            if($order->orderUpdate($_POST)){
                header('location:/order?id='.$_POST["order_id"]);
            }
        }
    }
    
    // Видалення товару із замовлення
    public function deleteProducts($data){
        // перевірка чи передалася інформація 
        // чи передався order_id
        if(isset($data['order_id']) && !empty($data['order_id'])){
            // створення змінної order_id із значенням $data['order_id']
            $order_id=$data['order_id'];
            }else{
            return false;
        }
        // Чи передався product_id
        if(isset($data['product_id']) && !empty($data['product_id'])){
            // створення змінної product_id із значенням $data['product_id']
            $product_id=$data['product_id'];
            }else{
            return false;
        }
        // Чи передався Unit id
        if(isset($data['unit_id']) && !empty($data['unit_id'])){
            // створення змінної product_id із значенням $data['product_id']
            $unit_id=$data['unit_id'];
            }else{
            return false;
        }
        // якщо все нормально, видалення продукту із замовлення
        $order=new OrderAdmin();
        if($order->deleteProductUnit( $order_id,$product_id,$unit_id)){
            // перенесення на сторінку 
            header('location:/order?id='.$order_id);
        }
        
    }
    // для вибору назви і id товару
    public function addProductName($data){
        // чи правильно передалось order_id
        if(isset($data['order_id']) && !empty($data['order_id'])){            
            $order_id=$data['order_id'];
            $data_page['order_id']=$order_id;
            $product=new ProductAdmin();
            // виведення переліку всіх товарів
        $data_page['products']=$product->getList();
        }
        // якщо натиснута кнопка 
        if(isset($_POST['next'])){
            // перевірка чи існує і чи має цифрове значення product_id
             if(isset($_POST['name']) && $product_id=filter_var($_POST['name'],FILTER_VALIDATE_INT)){
                // перевірка чи існує товар по даному номеру
                if($product->getItem($product_id)){
                    // перехід на другу форму з показниками order_id & product_id                
                    header("Location:/add_product_order?id=$order_id&product_id=$product_id");                
                }                
             }
        }
        
        

        return $this->view->render('add_product_name',$data_page);
    }

    public function addProduct($data){
        // Перевірка чи передався order_id
        if(isset($data['id']) && !empty($data['id'])){
            $order_id=$data['id'];
        }
        // Перевірка чи передався product_id
        if(isset($data['product_id']) && !empty($data['product_id'])){
            $product_id=$data['product_id'];
        }

        $data_page=array();
        $product=new ProductAdmin();
        
        // $data_page['product']=$product->getItem($product_id);        
        // $data_page['units']=$product->getUnitsById($product_id);

        $data_page=array(
            'order_id'=>$order_id,
            'product_id'=>$product_id,
            // основна інформація про товар(назва)
            'product'=>$product->getItem($product_id),
            // інфорамція про одиниці виміру
            'units'=>$product->getUnitsById($product_id)
        );
        
        // echo '<pre>';
        // var_dump($data_page);
        // echo '</pre>';
        // die;
        if(isset($_POST['save'])){
            // початок валідаціїї
            // валідація кількості
            if(isset($_POST['quantity']) && $_POST['quantity']>0){
                $quantity=$_POST['quantity'];
            }else{
                $quantity=1;
            }
            // перевірка одинці виміру на тип int
            if(isset($_POST['unit_id']) && $unit_id=filter_var($_POST['unit_id'],FILTER_VALIDATE_INT)){ 
                               
                // перевірка на кількість товару
                //  - чи існує $unit_id у даного продукту 
                if(!empty($unit_info=$product->getProductUnitByUnitId($unit_id,$product_id))){
                    // чи є потрібна кількість товару
                    if($quantity>$unit_info['quantity']){
                        $quantity=$unit_info['quantity'];
                    }
                    // пошук ціни по product_id і unit_id
                    $price=$unit_info['price'];
                }else{
                    return false;
                } 
            }else{
                return false;
            }
            // кінець валідації
            // перевірка на дублювання
            
            if($order_quantity=$product->getQuantityByIdPrIdUnId($order_id, $product_id, $unit_id)){
                // дублювання є
                var_dump($order_quantity);
                die;
                // Дублювання не має
            }else{
                $info=array(
                    'order_id'=>$order_id,
                    'product_id'=>$product_id,
                    'price'=>$price,
                    'quantity'=>$quantity,
                    'unit_id'=>$unit_id
                );
                $order=new OrderAdmin();
                if($order->createProductOrder($info)){
                    header("Location:/order?id=$order_id");
                }
            }
                
            
            


            
        }

         return $this->view->render('add_product_order',$data_page);
    }

    //формування масиву значень для заповлення інформації про товар
    /**
     * назва
     * одниця виміру
     * кількості фактичної 
     * 
     *  */   
    

    public function updateOrder($data){
         
        //  Валідація:
        //  - чи передався $data['order_id'] і не пустий
        if(isset($data['order_id']) && !empty($data['order_id'])){
            $order_id=$data['order_id'];
        }else{
            return false;
        }
        // перевірка валідності дааних які були передані через форму методом POST
        if(isset($_POST['updateProductOrder'])){
            //  - чи передався product_id
            if(isset($_POST['product_id']) && !empty($_POST['product_id'])){
                $product_id=$_POST['product_id'];
            }else{
                return false;
            }
           //  - чи передалася кількість і якого типу дані передались
           if(isset($_POST['quantity']) && $_POST['quantity']>0 ){
                $quantity=$_POST['quantity'];
            }else{
                $quantity=1;
            }
            $product=new ProductAdmin();
        //  - чи передався $unit_id        
            if(isset($_POST['unit_id']) && $unit_id=filter_var($_POST['unit_id'],FILTER_VALIDATE_INT)){
                //  - чи існує $unit_id у даного продукту 
                if(!empty($unit_info=$product->getProductUnitByUnitId($unit_id,$product_id))){
                    // чи є потрібна кільеість товару
                    if($quantity>$unit_info['quantity']){
                        $quantity=$unit_info['quantity'];
                    }
                    // пошук ціни по product_id і unit_id
                    $price=$unit_info['price'];
                }else{
                    return false;
                }             
            }else{
                return false;
            }
            // end validation  
            if(isset($_POST['old_unit_id']) && $old_unit_id=filter_var($_POST['old_unit_id'],FILTER_VALIDATE_INT)){
                // перевірка чи змінився unit_id
            // не змінився
                if($unit_id==$old_unit_id){
                    // оновити інформацію по product_id and unit_Id
                    $order=new OrderAdmin();
                    // заповнити масив з данними
                    $data_info=array(
                        'order_id'=>$order_id,
                        'product_id'=>$product_id,
                        'price'=>$price,
                        'quantity'=>$quantity,
                        'unit_id'=>$unit_id
                    );
                    // видалити цей запис по order_id,unit_id,product_id
                    if($order->deleteProductUnit( $order_id,$product_id,$unit_id)){
                        // Додати новий
                        if($order->saveOrderProduct($data_info)){
                            header("Location:/order?id=$order_id");
                        }
                    }
                    
                }
            // змінився
            }
            
            
        }
        
        
        
        

            
        var_dump($data);
        echo '<hr>';
        var_dump($_POST);


    }

    public function orderProductValidation(){
        if(isset($_POST['product_id']) && !empty($_POST['product_id'])){
            $product_id=$_POST['product_id'];
        }else{
            return false;
        }
       //  - чи передалася кількість і якого типу дані передались
       if(isset($_POST['quantity']) && $_POST['quantity']>0 ){
            $quantity=$_POST['quantity'];
        }else{
            $quantity=1;
        }
        $product=new ProductAdmin();
    //  - чи передався $unit_id        
        if(isset($_POST['unit_id']) && $unit_id=filter_var($_POST['unit_id'],FILTER_VALIDATE_INT)){
            //  - чи існує $unit_id у даного продукту 
            if(!empty($unit_info=$product->getProductUnitByUnitId($unit_id,$product_id))){
                // чи є потрібна кільеість товару
                if($quantity>$unit_info['quantity']){
                    $quantity=$unit_info['quantity'];
                }
                // пошук ціни по product_id і unit_id
                $price=$unit_info['price'];
            }else{
                return false;
            }             
        }else{
            return false;
        }
        return true;
    }
     
    
    public function update_Order($data){
        $product_id=$data['product_id'];
        $order_id=$data['order_id'];
        $unit_id=$data['unit_id'];
        $data_page=$this->infoFormOrder($data);
        $data_info=array();
        $product=new ProductAdmin(); 
        $price=$product->getPriceByProductIdUnitId($product_id,$unit_id);

        if(isset($_POST['updateProductOrder'])){
            
            if(isset($_POST['quantity']) && $_POST['quantity']>0 ){
                $quantity=$_POST['quantity'];
            }else{
                $quantity=1;
            }
                        
            
            if(isset($_POST['unit']) && $unit_id=filter_var($_POST['unit'],FILTER_VALIDATE_INT)){
                if(!empty($unit_info=$product->getProductUnitByUnitId($unit_id,$product_id))){
                    if($quantity>$unit_info['quantity']){
                        $quantity=$unit_info['quantity'];
                    }
                }             
            }            
                $data_page['quantity']=$price;           
                $data_page['total']=$quantity*$price;
        }
            if(isset($_POST['save'])){
                // array(7) { ["order_id"]=> string(2) "38" ["product_id"]=> string(1) "2" ["price"]=> string(3) "250" ["quantity"]=> string(1) "1" ["unit"]=> string(1) "3" ["total"]=> string(3) "250" ["save"]=> string(16) "Зберегти" 
                
                $order=new OrderAdmin();
                
                $data_info=array(
                    'order_id'=>$_POST['order_id'],
                    'product_id'=>$_POST['product_id'],
                    'price'=>$price,
                    'quantity'=>$_POST['quantity'],
                    'unit_id'=>$_POST['unit']
                );
                var_dump($data_info);
                die;
                // видалення старого запису
                if($order->deleteProducts($data)){
                    // створення нового
                    if($order->saveOrderProduct($data_info)){
                        header('location:/order?id='.$_POST["order_id"]);
                    }
                }
                
            }
            
            
          
         
        
      return $this->view->render('order',$data_page);  
    }
    

    

     

    


}
?>