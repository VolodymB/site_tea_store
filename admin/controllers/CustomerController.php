<?php 

require_once "models/CustomerAdmin.php";

class CustomerController extends Controller{

    public function index(){
       $data_page=array();
       $customer=new CustomerAdmin();
       $data_page['customers']=$customer->getCustomers();
       
       $this->view->render('customers',$data_page);
    }

    public function update($data){
        if(isset($data)){
            $data_page=array();
            $customer=new CustomerAdmin(); 
            
            $data_page['customer']=$this->findOne($data['id']);
            $data_page['delivery']=$customer->getListDelivery();
            $data_page['payment']=$customer->getListPayment();
            $data_page['city']=$customer->getListCity();

            // echo '<pre>';
            // var_dump($data_page);
            // echo '</pre>';
        }
        
        
        $this->view->render('customer_form',$data_page);
    }

    public function findOne($id){
        if(isset($id)){
            $info=array();
            $customer=new CustomerAdmin;
            $info=$customer->getCustomerByCustomId($id);
            return $info;
        }
        

        
    }




    



}
?>