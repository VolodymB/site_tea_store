<?php
class CommentsAdmin extends Model{

    public function getCommetsByProductId($product_id){
        $sql="SELECT CONCAT(`user`.`name`,' ',`user`.`surname`) as 'name',`comment`.`user_id`,`comment`.`comment`,`comment`.`raiting` FROM `comment` LEFT JOIN `user` ON `comment`.`user_id`=`user`.`id` WHERE `comment`.`product_id`=:product_id";
        $data=array(
            'product_id'=>$product_id
        );
        $select=$this->db->prepare($sql);
        $select->execute($data);
        return $result=$select->fetchAll();
    }


}
?>