<?php 

class CategoryAdmin extends Model{

    public function getListCategories(){
        $sql="SELECT `id`,`name` FROM `category`";
        $select=$this->db->query($sql);
        $result=$select->fetchAll();
        return $result;
        
    }

}


?>