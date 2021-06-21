<?php

    require_once "./models/CategoryAdmin.php";

 class CategoryController extends Controller{

    public function index(){
        $data_page=array();
        if(isset($_POST)){
            var_dump($_POST);
        }
        $category=new CategoryAdmin();
        $data_page['categories']=$category->getListCategories();
        // echo '<pre>';
        // var_dump($data_page['categories']);
        // echo '</pre>';
        return $this->view->render('category',$data_page);
    }

 }
?>