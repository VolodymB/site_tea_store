<?php

    require_once "./models/CategoryAdmin.php";

 class CategoryController extends Controller{

    public function index(){
        $data_page=array();
        
        $category=new CategoryAdmin();
        $data_page['categories']=$category->getListCategories();
        // Дістати category_id
      
        return $this->view->render('category',$data_page);
    }

    public function findOne($category_id){
        $category=new CategoryAdmin();
        $category_info=$category->getCategoryByCategoryId($category_id);
        $category_info['products']=$category->getProductIdByCategoryId($category_id);
        // echo '<pre>';
        // var_dump($category_info);
        // echo '</pre>';
        // die;
        return  $category_info;
    }

    public function create(){
        $category=new CategoryAdmin();
        if(isset($_POST)){
            $data=$_POST;
            $category->save($data);
            // var_dump($data);
        }
           
        $data_page=array();
        $data_page['categories']=$category->getListCategories(); 
        // var_dump($data_page['categories']);
        // die;        
        return $this->view->render('category_form',$data_page);
        
    }

    public function update($data){
        $category=new CategoryAdmin();
        $data_page=array();
    $data_page['category']=$this->findOne($category_id);
    $data_page['categories']=$category->getListCategories();
        if(isset($data['id']) && !empty($data['id'])){
            $category_id=$data['id'];
            $data_page['category']=$this->findOne($category_id);
        }
       
        // var_dump($data_page['categories']);
    
        if(isset($_POST['save'])){ 
            // var_dump($_POST['save']) ;
            // die;          
            if($category->save($_POST,$category_id)){
                header("Location:/categories");
            }
        }
        
        // echo '<pre>';
        // var_dump($data_page);
        // echo '</pre>';
        return $this->view->render('category_form',$data_page);
    }

    public function delete($data){
        if(isset($data['id'])){
            $category_id=$data['id'];
            $category=new CategoryAdmin();
            // array(1) { ["products"]=> array(1) { [0]=> array(4) { ["id"]=> int(8) ["name"]=> string(21) "Вязаний чай" ["parent_id"]=> int(1) ["sort_order"]=> int(8) } } }
            $category_info=$this->findOne($category_id);
            // echo '<pre>';
            // var_dump($category_info);
            // echo '</pre>';
            if(!empty($category_info)){
                if($category->delete($category_info)){
                    header("Location:/categories");
                }
                return false;
            }
        }
        }
    

    
    
 }
?>