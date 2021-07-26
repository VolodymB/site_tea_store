<?php
require_once "models/UserAdmin.php";

class UserController extends Controller{

    public function index(){
        $data_page=array();

        $user=new UserAdmin();
        $data_page['users']=$user->getList();
        // var_dump($data_page['users']);

        $this->view->render('users',$data_page);

    }

    /**
     * додавання ролі користувачу
     * вхідні дані - user_id
     * вихідні - bool
     */
    public function addRole($data){
        // перевірка чи передлася інформація data
        if(isset($data['user_id']) && !empty($data['user_id'])){
            // надання змінній $user_id значення  $data['user_id']
            $user_id=$data['user_id'];
        }else{
            return false;
        }
        // перевірка чи у користувача є роль
        $user=new UserAdmin();
        if(!$role_id=$user->getRole($user_id)){
            // перелік ролей
            $role_info=$user->getListRole();
            $role_id=$role_info[0]['id'];
            // запис в таблиці user_role
            if($user->saveRole($user_id,$role_id)){
                header("Location:/users");
            }
        }else{
            if($user->deleteRole($user_id,$role_id)){
                header("Location:/users");
            }
        }
    }



}
?>