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

    // public function view($data){
        
    //     if(isset($data['id']) && !empty($data['id'])){
    //         $data_page=array();
    //         $product_id=$data['id'];
    //         $product=new ProductAdmin();
    //         $data_page['product']=$product->getItem($product_id);
    //         // var_dump($data_page['product']);
    //         // die;
    //         // array(1) {
    //         //     [0]=>
    //         //     array(5) {
    //         //       ["product_id"]=>
    //         //       int(2)
    //         //       ["product_name"]=>
    //         //       string(28) "Дзюнь Дзюнь Мей"
    //         //       ["year"]=>
    //         //       int(2020)
    //         //       ["description"]=>
    //         //       NULL
    //         //       ["status"]=>
    //         //       string(21) "в наявності"



    //         // $units=new UnitAdmin();
    //         $data_page['unit']=$product->getUnitById($product_id);
    //         // foreach($units->getUnitById($product_id) as $unit){
    //         //     $info['unit']=$unit;            
    //         // }

    //         // array(2) {
    //         //     [0]=>
    //         //     array(5) {
    //         //       ["product_id"]=>
    //         //       int(2)
    //         //       ["unit_id"]=>
    //         //       int(2)
    //         //       ["price"]=>
    //         //       float(300)
    //         //       ["quantity"]=>
    //         //       int(5)
    //         //       ["unit_name"]=>
    //         //       string(8) "0,1 кг"
    //         //     }

            
    //             // $category=new CategoryAdmin();
    //             $data_page['category']=$product->getCategoryById($product_id);
    //             // array(2) {
    //             //     [0]=>
    //             //     array(1) {
    //             //       ["name"]=>
    //             //       string(23) "Червоний чай"
            
    //             // Коментарі
    //             // $comments=new CommentsAdmin();
    //             $data_page['comments']=$product->getCommetsByProductId($product_id);
    //             // array(4) {
    //         //     ["name"]=>
    //         //     string(10) "Rita Homer"
    //         //     ["user_id"]=>
    //         //     int(2)
    //         //     ["comment"]=>
    //         //     string(9) "Very Good"
    //         //     ["raiting"]=>
    //         //     int(5)
    //         // }                                                   
    //    return $this->view->render('view',$data_page);        
    //     }
    // }

    public function view($data){
        
        if(isset($data['id']) && !empty($data['id'])){
            $data_page=array();
            $product_id=$data['id'];
            // $product=new ProductAdmin();
            $data_page['product']=$this->findOne($product_id);
            // var_dump($data_page);
            // die;                                                  
       return $this->view->render('view',$data_page);        
        }
    }


    public function create(){        
        $product=new ProductAdmin();
        $info=$this->infoForm();
        // array(6) { ["name"]=> string(7) "dsfgjgk" ["year"]=> string(4) "2019" ["status"]=> string(1) "1" ["unit"]=> string(1) "1" ["price"]=> string(4) "34.5" ["categories"]=> array(3) { [0]=> string(1) "3" [1]=> string(1) "6" [2]=> string(2) "10" } }
        $product->save($_POST);
        // var_dump($product);
        $info['action']='/add_product';

        return $this->view->render('form',$info);

    }

    public function update($data){
        $data_page=array();
        $data_page=$this->infoForm();
        $data_page['product']=$this->findOne($data['id']);
        $data_page['action']='/edit_product?id='.$data['id'];
        // echo '<pre>';
        // var_dump($data_page);
        // echo '</pre>';

        if(isset($_POST['save'])){
            $product=new ProductAdmin();
            if($product->save($_POST,$data['id'])){
                header("Location:/product?id=".$data['id']);
            }

        }
        return $this->view->render('form',$data_page);

    }

    public function delete($data){
        if(isset($data['id'])){
            $product_id=$data['id'];
            $product=new ProductAdmin();
            $product_info=$this->findOne($product_id);
            if(!empty($product_info)){
                if($product->delete($product_info)){
                header("Location:/products"); 
                }
            // echo '<pre>';
            // var_dump($product);
            // echo '</pre>';
            // die;            
            }
        }
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

    private function findOne($product_id){
        $product_info=array();
        $product=new ProductAdmin();
            foreach($product->getItem($product_id) as $item){
                $product_info=array(
                    "product_id"=>$item['product_id'],
                    "product_name"=>$item['product_name'],
                    "year"=>$item['year'],
                    "description"=>$item['description'],
                    "status"=>$item['status'],
                    'status_id'=>$item['status_id']
                );
            }

            
            // var_dump($data_page['product']);
            // die;
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



            // $units=new UnitAdmin();
            $product_info['units']=$product->getUnitsById($product_id);
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

            
                // $category=new CategoryAdmin();
                $product_info['categories']=$product->getCategoriesById($product_id);
                $product_info['categories_id']=array();
                foreach($product_info['categories'] as $category){
                    $product_info['categories_id'][]=$category['category_id'];
                }
                // array(2) {
                //     [0]=>
                //     array(1) {
                //       ["name"]=>
                //       string(23) "Червоний чай"
                
            
                // Коментарі
                // $comments=new CommentsAdmin();
                $product_info['comments']=$product->getCommetsByProductId($product_id);
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

            

        return $product_info;
    }


}

?>