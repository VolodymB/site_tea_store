<?php 

class CategoryAdmin extends Model{

    public function getListCategories(){
        $sql="SELECT * FROM `category`";
        $select=$this->db->query($sql);
        $result=$select->fetchAll();
        return $result;
        
    }

    // public function getCategoryById($product_id){
    //   $sql="SELECT `category`.`name`,`product_category`.`category_id` FROM `product_category`LEFT JOIN `category` ON `product_category`.`category_id`=`category`.`id` WHERE `product_id`=:product_id";
    //   $data=array(
    //     'product_id'=>$product_id
    //   );
    //   $select=$this->db->prepare($sql);
    //   $select->execute($data);
    //   return $result=$select->fetchAll();
    // //   return $result=$select->fetchAll();

    // }

}


?>