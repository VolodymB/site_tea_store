<?php

class ProductAdmin extends Model{

    public function getList(){
        $sql="SELECT `product`.`id`,`product`.`name`,`product`.`year`,`status_product`.`name` as 'status' FROM `product` LEFT JOIN `status_product` ON `product`.`status_id`=`status_product`.`id`";
        $select=$this->db->query($sql);
        $result=$select->fetchAll();
        return $result;
    }

    public function view($id){
        echo 'view';
    }

    public function create(){
        echo 'create';
    }

    public function update($id){
        echo 'update';
    }

    public function delete($id){
        echo 'delete';
    }





}
?>