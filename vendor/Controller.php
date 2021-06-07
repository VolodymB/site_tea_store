<?php
require_once 'Basket.php';
// клас Controller
class Controller{

    // публічні властивості
    public $view;
    public $model;

    // магічний метод __construct(перед словом ставиться __)
    public function __construct(){
        $this->view=new View();
        $this->model=new Model();
    }

}
?>