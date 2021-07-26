<?php  
class UserAdmin extends Model{
    public function getList(){
        $sql="SELECT `user`.`id`,`user`.`name`,`user`.`surname`,`user`.`email`,`user`.`login`,`role`.`name` as 'role_name' FROM `user` lEFT JOIN `user_role` ON `user`.`id`=`user_role`.`user_id` LEFT JOIN `role` ON `user_role`.`role_id`=`role`.`id` ORDER BY `user`.`id`";
        $select=$this->db->query($sql);
        $result=$select->fetchAll();
        return $result;

    }

    

    


}
?>