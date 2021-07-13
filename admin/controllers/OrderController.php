<?php 
require_once 'models/OrderAdmin.php';
require_once 'models/CustomerAdmin.php';
require_once 'models/ProductAdmin.php';
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
            $customer->getCustomer($order_info['customer_id']);
            // array(6) { ["id"]=> int(44) ["user_id"]=> int(1) ["name"]=> string(4) "Mark" ["surname"]=> string(4) "Solo" ["email"]=> string(14) "emar@gmail.com" ["telephone"]=> string(15) "555555555555555" }
            $product=new ProductAdmin();
            var_dump($customer->getCustomer($order_info['customer_id']));
        }
        
        
        
        
    } 


}
?>