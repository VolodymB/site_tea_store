<?php 
require_once 'models/OrderAdmin.php';
class OrderController extends Controller{

    public function index(){
        session_start();
 
        if(isset($_SESSION['user'])){
            $user_id=$_SESSION['user'];            
        }
        $data_page=array();
        $order=new OrderAdmin();
        $data_page['orders']=$order->getListOrders($user_id);
        var_dump($data_page['orders']);
        die;
        return $this->view->render('orders',$data_page);
    }


}
?>