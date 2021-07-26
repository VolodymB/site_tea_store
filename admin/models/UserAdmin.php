<?php  
class UserAdmin extends Model{
    public function getList(){
        $sql="SELECT `user`.`id`,`user`.`name`,`user`.`surname`,`user`.`email`,`user`.`login`,`role`.`name` as 'role_name' FROM `user` lEFT JOIN `user_role` ON `user`.`id`=`user_role`.`user_id` LEFT JOIN `role` ON `user_role`.`role_id`=`role`.`id` ORDER BY `user`.`id`";
        $select=$this->db->query($sql);
        $result=$select->fetchAll();
        return $result;

    }

    // визначення чи є у користувача роль
    public function getRole($user_id){
        $sql="SELECT `role_id` FROM `user_role` WHERE `user_id`=:r_user_id";
        $data=array(
            'r_user_id'=>$user_id
        );
        $select=$this->db->prepare($sql);
        $select->execute($data);
        $result=$select->fetchColumn();
        return $result;
    }

    // визначення переліку ролей
    public function getListRole(){
        $sql="SELECT * FROM `role` ";
        $select=$this->db->query($sql);
        $select=$this->db->query($sql);
        $result=$select->fetchAll();
        return $result;
    }

    public function saveRole($user_id,$role_id){
        $sql="INSERT INTO `user_role`(`user_id`, `role_id`) VALUES (:r_user_id,:role_id)";
        $data=array(
            'r_user_id'=>$user_id,
            'role_id'=>$role_id
        );
        $select=$this->db->prepare($sql);
        if($select->execute($data)){
            return true;
        }else{
            return false;
        }

    }

    public function deleteRole($user_id,$role_id){
        $sql="DELETE FROM `user_role` WHERE `user_id`=:r_user_id AND `role_id`=:role_id";
        $data=array(
            'r_user_id'=>$user_id,
            'role_id'=>$role_id
        );
        $select=$this->db->prepare($sql);
        if($select->execute($data)){
            return true;
        }else{
            return false;
        }
    }



    


}
?>