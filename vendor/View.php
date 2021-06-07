<?php
require_once 'Basket.php';
require_once '../catalog/models/Category.php';

class View{

    public $data=array();
    /**
     * вхідний параметр $tpl назва файла відображення контента
     * data масив з параметрами, який передається
     * return підключення файла відображення
     */
    // переведння частини адреси в назву файла
    public function renderPart($tpl,$data=array()){
        $path='views/'.$tpl.'.php';        
        include_once $path;
        
    }

    public function getParam(){
        $data_header=array();

        $data_header['total_count']=Basket::totalCount();
        $category=new Category();
        $data_header['menu']=$category->getMenu();
        // [0]=> array(4) { ["id"]=> int(1) ["name"]=> string(6) "Чай" ["parent_id"]=> NULL ["sort_order"]=> int(1)
        $this->data['header']=$this->renderPart('header',$data_header);
        $this->data['footer']=$this->renderPart('footer');

    }

    public function render($tpl,$data=array()){
        $this->getParam();
        $this->data['content']=$this->renderPart($tpl,$data);
        return $this->renderPart('layout',$this->data);
    }

}
?>