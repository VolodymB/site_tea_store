<?php 
    require_once 'models/User.php';
    require_once 'models/ProductAdmin.php';
    // require_once './catalog/controllers/ProductController.php';

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

    public function view($data){
        $product=new ProductAdmin();
       return $product->view($data['id']);

    }

    public function create(){
        $product=new ProductAdmin();
       return $product->create();

    }

    public function update(){
        $product=new ProductAdmin();
       return $product->update();
    }

    public function delete(){
        $product=new ProductAdmin();
        $product->delete();
    }


}

?>