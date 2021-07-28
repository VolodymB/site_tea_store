<?php 

require_once "models/CustomerAdmin.php";

class CustomerController extends Controller{

    public function index(){
       $data_page=array();
       $customer=new CustomerAdmin();
       $data_page['customers']=$customer->getCustomers();
    //    echo '<pre>';
    //    var_dump($data_page['customers']);
    //    echo '</pre>';
    //    die;
       $this->view->render('customers',$data_page);
    }

    public function update($data){
        if(isset($data['id']) && !empty($data['id'])){
            $custom_id=$data['id'];
        }

            $data_page=array();
            $customer=new CustomerAdmin(); 
            
            $data_page['customer']=$this->findOne($custom_id);
        //    var_dump($data_page['customer']);
        //    die;

            if(isset($_POST['save'])){
                $form_info=$_POST;                 
                   $customer->save($form_info); 
                               
            }             

        $this->view->render('customer_form',$data_page);
    }

    public function findOne($id){
        if(isset($id)){
            $info=array();
            $customer=new CustomerAdmin();
            $info=$customer->getCustomerByCustomId($id);
            
            return $info;
        }        
    }

    public function delete($data){
        if(isset($data['id'])){
            $customer=new CustomerAdmin();
            if($this->findOne($data['id'])){
               if($customer->delete($data['id'])){
                   header("Location:/customers");
               }
            }
        }
        
    }




    



}
?>