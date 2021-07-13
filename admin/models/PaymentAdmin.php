<?php 

class PaymentAdmin extends Model{

    public function getList(){
        $sql="SELECT * FROM `payment`";
        $select=$this->db->query($sql);
        $result=$select->fetchAll();
        return $result;
    }

}

?>