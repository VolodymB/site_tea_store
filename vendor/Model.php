<?php
class Model{

    // формування підключення до бази даних, 
    // первісне значення рівне NULL 
    public $db=NULL;

    // застосування методу connect до властивості db
    public function __construct(){
        $this->db=Db::connect(); 
    }

}
?>