<?php
class ProductAdmin extends Model{

    public function getList(){
        $sql="SELECT `product`.`id`,`product`.`name`,`product`.`year`,`status_product`.`name` as 'status' FROM `product` LEFT JOIN `status_product` ON `product`.`status_id`=`status_product`.`id`";
        $select=$this->db->query($sql);
        $result=$select->fetchAll();
        return $result;
    }



}
?>