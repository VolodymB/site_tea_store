<?php

class DeliveryAdmin extends Model{

    public function getList(){
        $sql="SELECT * FROM `delivery`";
        $select=$this->db->query($sql);
        $result=$select->fetchAll();
        return $result;
    }

}

?>