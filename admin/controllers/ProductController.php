<?php 
    require_once 'models/User.php';
    require_once 'models/ProductAdmin.php';

class ProductController extends Controller{
    public $user;

    public function __construct(){
        $this->view=new View();
        $this->model=new Model();
        $this->user=new User();

        if(!$this->user->admin()){
            header('Location:/login');
        }
    }

    public function index(){
        $data_page=array();

        $product=new ProductAdmin();
        $data_page['products']=$product->getList();
        $this->view->render('catalog',$data_page);

    }

    public function view(){

    }

    public function create(){

    }

    public function update(){

    }

    public function delete(){

    }


}

?>