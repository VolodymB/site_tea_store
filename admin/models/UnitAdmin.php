<?php 
class UnitAdmin extends Model{

    public function getListUnits(){
        $sql="SELECT `id`,`name` FROM `unit`";
        $select=$this->db->query($sql);
        $result=$select->fetchAll();
        return $result;
        
    }

}


?>