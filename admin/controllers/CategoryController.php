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
            if($category->save($_POST,$category_id)){
                header("Location:/categories");
            }
        }
        
        // echo '<pre>';
        // var_dump($data_page);
        // echo '</pre>';
        return $this->view->render('category_form',$data_page);
    }
    
    
 }
?>