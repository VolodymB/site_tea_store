<?php 
    require_once 'models/User.php';
    require_once 'models/ProductAdmin.php';
    require_once 'models/StatusProductAdmin.php';
    require_once 'models/CategoryAdmin.php';
    require_once 'models/UnitAdmin.php';
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
        $info=$this->infoForm();
        // array(6) { ["name"]=> string(7) "dsfgjgk" ["year"]=> string(4) "2019" ["status"]=> string(1) "1" ["unit"]=> string(1) "1" ["price"]=> string(4) "34.5" ["categories"]=> array(3) { [0]=> string(1) "3" [1]=> string(1) "6" [2]=> string(2) "10" } }
        $product->save($_POST);
        // var_dump($product);
        return $this->view->render('form',$info);

    }

    public function update(){
        $product=new ProductAdmin();
       return $product->update();
    }

    public function delete(){
        $product=new ProductAdmin();
        $product->delete();
    }

    public function infoForm(){
        $info=array();
          // новий обєкт status
       $status=new StatusProductAdmin();       
       $info['status']=$status->getList();

       $categories=new CategoryAdmin();
       $info['categories']=$categories->getListCategories();

       $unit=new UnitAdmin();
       $info['units']=$unit->getListUnits();
    //    foreach($info as $info_form){
    //     //    var_dump($info_form);
    //     //    die;
    //    }
        

       return $info;     
    }


}

?>