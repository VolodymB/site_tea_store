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
                    'unit'=>$unit_info[0]['name'],
                    'price'=>$item['price'],
                    'total'=>$item['quantity']*$item['price']
                );
            }
            

            $status_order=new StatusOrderAdmin();
            $order_info['status_order']=$status_order->getList();

            $delivery=new DeliveryAdmin();
            $order_info['delivery']=$delivery->getList();
            
            $payment=new PaymentAdmin();
            $order_info['payment']=$payment->getList();
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
    
    public function deleteProducts($data){
        if(isset($data['order_id']) && !empty($data['order_id'])){
            if(isset($data['product_id']) && !empty($data['product_id'])){
                $order=new OrderAdmin();
                if($order->deleteProducts($data)){
                    header('location:/order?id='.$data["order_id"]);
                }
               
            }
        }
    }

    public function addProduct($data){
        if(isset($data['order_id']) && !empty($data['order_id'])){
            return $this->view->render('add_product_order',$data_page);
        }
    }

    public function updateOrder($data){
        $data_page=$this->infoFormOrder($data);
        if(!empty($_POST)){
            $data_page['info']['quantity']=$_POST['quantity'];            
            $data_page['total']=$_POST['quantity']*$_POST['price'];

            if(isset($_POST['save'])){
                // array(7) { ["order_id"]=> string(2) "38" ["product_id"]=> string(1) "2" ["price"]=> string(3) "250" ["quantity"]=> string(1) "1" ["unit"]=> string(1) "3" ["total"]=> string(3) "250" ["save"]=> string(16) "Зберегти" 
                
                $order=new OrderAdmin();
                // видалення старого запису
                if($order->deleteProducts($data)){
                    if($order->saveOrderProduct($_POST)){
                        header('location:/order?id='.$_POST["order_id"]);
                    }
                }
                
            }
            
        }    
         
        
      return $this->view->render('update_order_product_form',$data_page);  
    }
    

    //інформація для форми (осоновна інфо, інфо про одиниці виміру,)    
    public function infoFormOrder($data){
        if(isset($data['product_id']) && !empty($data['product_id'])){
            if(isset($data['order_id']) && !empty($data['order_id'])){
                $data_page=array();
                $order=new OrderAdmin();
                $data_page['info']=$order->getOrderProduct($data);
            }

            $data_page['order_id']=$data['order_id'];
            $data_page['product_id']=$data['product_id'];

            $product=new ProductAdmin();
            $data_page['product_units']=$product->getUnitsById($data['product_id']);
            
            // echo '<pre>';
            // var_dump($data_page);
            // echo '</pre>';
            // die;
            return $data_page;

        }
    }

    


}
?>