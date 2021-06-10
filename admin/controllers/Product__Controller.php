<?php 
    require_once 'models/User.php';

class ProductController extends Controller{
    // public $user;

    // public function __construct(){
    //     $this->view=new View();
    //     $this->model=new Model();
    //     $this->user=new User();

        
    // }
    public function __call($method,$arguments){
        $user=new User();
        if($user->admin()){
            $this->$method($arguments);
        }else{
            header('Location:/login');
        }
        
    
    }
    
    private function index(){
        echo 'peoducts';
    }

    private function view(){
        echo 'view';
    }

    public function create(){

    }

    public function update(){

    }

    public function delete(){

    }


}

?>