<?php 
    require_once 'models/User.php';
    require_once 'models/ProductAdmin.php';
    require_once 'models/StatusProductAdmin.php';
    require_once 'models/CategoryAdmin.php';
    require_once 'models/UnitAdmin.php';
    require_once 'models/CommentsAdmin.php';
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
        
        if(isset($data['id']) && !empty($data['id'])){
            $info=array();
            $product_id=$data['id'];
            $product=new ProductAdmin();
            $info['product']=$product->getItem($product_id);
            // array(1) {
            //     [0]=>
            //     array(5) {
            //       ["product_id"]=>
            //       int(2)
            //       ["product_name"]=>
            //       string(28) "Дзюнь Дзюнь Мей"
            //       ["year"]=>
            //       int(2020)
            //       ["description"]=>
            //       NULL
            //       ["status"]=>
            //       string(21) "в наявності"



            $units=new UnitAdmin();
            $info['unit']=$units->getUnitById($product_id);
            // foreach($units->getUnitById($product_id) as $unit){
            //     $info['unit']=$unit;            
            // }

            // array(2) {
            //     [0]=>
            //     array(5) {
            //       ["product_id"]=>
            //       int(2)
            //       ["unit_id"]=>
            //       int(2)
            //       ["price"]=>
            //       float(300)
            //       ["quantity"]=>
            //       int(5)
            //       ["unit_name"]=>
            //       string(8) "0,1 кг"
            //     }

            
                $category=new CategoryAdmin();
                $info['category']=$category->getCategoryById($product_id);
                // array(2) {
                //     [0]=>
                //     array(1) {
                //       ["name"]=>
                //       string(23) "Червоний чай"
            
                // Коментарі
                $comments=new CommentsAdmin();
                $info['comments']=$comments->getCommetsByProductId($product_id);
                // array(4) {
            //     ["name"]=>
            //     string(10) "Rita Homer"
            //     ["user_id"]=>
            //     int(2)
            //     ["comment"]=>
            //     string(9) "Very Good"
            //     ["raiting"]=>
            //     int(5)
            // }



                // echo '<pre>'; 
                // var_dump($info['comments']);
                // echo '</pre>';
                // die;
            


           
        
       
        
        
       return $this->view->render('view',$info);

        
        }
    }


    public function create(){        
        $product=new ProductAdmin();
        $info=$this->infoForm();
        // array(6) { ["name"]=> string(7) "dsfgjgk" ["year"]=> string(4) "2019" ["status"]=> string(1) "1" ["unit"]=> string(1) "1" ["price"]=> string(4) "34.5" ["categories"]=> array(3) { [0]=> string(1) "3" [1]=> string(1) "6" [2]=> string(2) "10" } }
        $product->save($_POST);
        // var_dump($product);
        return $this->view->render('form',$info);

    }

    public function update(){;
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