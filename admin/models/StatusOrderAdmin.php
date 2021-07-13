<?php

class StatusOrderAdmin extends Model{

    // перелік статусів замовлення
    public function getList(){
        $sql="SELECT * FROM `status_order`";
        $select=$this->db->query($sql);
        $result=$select->fetchAll();
        return $result;
    }

}

?>