<?php 
class UnitAdmin extends Model{

    public function getListUnits(){
        $sql="SELECT `id`,`name` FROM `unit`";
        $select=$this->db->query($sql);
        $result=$select->fetchAll();
        return $result;
        
    }

    public function getUnitById($product_id){
        $sql="SELECT `product_id`,`unit_id`,`price`,`quantity`,`unit`.`name` as 'unit_name' FROM `product_unit` LEFT JOIN `unit` ON `product_unit`.`unit_id`=`unit`.`id` WHERE `product_id`=:product_id";
        $data=array(
            'product_id'=>$product_id
        );
        $select=$this->db->prepare($sql);
        $select->execute($data);
        $result=$select->fetchAll();
            return $result;
        }
        

    

}


?>