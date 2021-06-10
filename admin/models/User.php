<?php
class User extends Model{

    //пошук user_id,role_id по email
    public function findByEmail($email,$password){
        $sql="SELECT `user`.`id` as 'user_id',`user_role`.`role_id` FROM `user` LEFT JOIN `user_role` ON `user`.`id`=`user_role`.`user_id` WHERE `email`=:email AND `password`=:user_password AND `user_role`.`role_id`=1 ";
        $data=array(
            'email'=>$email,
            'user_password'=>$password
        );
        $select=$this->db->prepare($sql);
        $select->execute($data);
        $result=$select->fetchAll();
        return $result;
    }

    public function login($email,$password){
        if($user=$this->findByEmail($email,$password)){
            session_start();
            $_SESSION['user']=$user[0]['user_id'];
            $_SESSION['role']=$user[0]['role_id'];
            return true;
        }
        return false;
    }

    public function logout(){
        session_start();
        unset($_SESSION['user']);
        unset($_SESSION['role']);
        return true;
    }

    public function admin(){
        session_start();
        if(isset($_SESSION['user']) && isset($_SESSION['role'])){
            if($_SESSION['role']==1){
                return true;
            }
        }
        return;
    }
}
?>