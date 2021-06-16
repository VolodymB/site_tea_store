<?php
class StatusProductAdmin extends Model{

    public function getList(){
        $sql="SELECT * FROM `status_product`";
        $select=$this->db->query($sql);
        $result=$select->fetchAll();
        return $result;
        
    }

}

?>